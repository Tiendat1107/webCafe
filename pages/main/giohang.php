<?php
use Carbon\Carbon;
require('Carbon/autoload.php');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_TmnCode = "KMO2OYPL"; // Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "PBOGEJHNKVAHCTDYPKREHPPLVZMQNYQX"; // Khóa bí mật
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/web_mysql/pages/main/thanhtoanvnpay.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

// Cấu hình định dạng đầu vào
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+90 minutes', strtotime($startTime)));


if (session_status() == PHP_SESSION_NONE) {
    session_start();
    require_once("config_vnpay.php");
}

if (isset($_SESSION['cart']) && isset($_POST['payment_method'])) {
    $tongtien = 0;
    $id_donhang = rand(0,99999);

    foreach ($_SESSION['cart'] as $cart_item) {
        $tongtien += $cart_item['soluong'] * $cart_item['giasanpham'];
    }

    $payment_method = $_POST['payment_method'];

    if ($payment_method == 'Tiền Mặt' || $payment_method == 'Chuyển Khoản') {
        $ngaymua = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s'); 
        $payment_method = $_POST['payment_method'];
        $sql_them_donhang = "INSERT INTO tbl_donhang (ngaymua, tongtien, payment_method) 
            VALUES ('$ngaymua', '$tongtien', '$payment_method')";
        mysqli_query($mysqli, $sql_them_donhang);

        // Lấy id_donhang mới sau khi thêm vào cơ sở dữ liệu
        $id_donhang = mysqli_insert_id($mysqli);

        foreach ($_SESSION['cart'] as $cart_item) {
            $id_sanpham = $cart_item['id'];
            $soluong = $cart_item['soluong'];
            $gia = $cart_item['giasanpham'];
            $sql_them_chi_tiet = "INSERT INTO tbl_chi_tiet_don_hang (id_donhang, id_sanpham, soluong, gia) 
                                VALUES ('$id_donhang', '$id_sanpham', '$soluong', '$gia')";
            mysqli_query($mysqli, $sql_them_chi_tiet);
        }

        //xulythongke
        $sql_donhang = "SELECT * FROM tbl_donhang WHERE id_donhang = '$id_donhang'";
        $query_donhang = mysqli_query($mysqli, $sql_donhang);

        // Lặp qua từng đơn hàng
        while ($row_donhang = mysqli_fetch_assoc($query_donhang)) {
            $ngaymua = Carbon::parse($row_donhang['ngaymua'])->toDateTimeString();
            $tongtien = $row_donhang['tongtien'];

            // Lấy thông tin chi tiết đơn hàng từ bảng tbl_chi_tiet_don_hang
            $sql_chi_tiet_don_hang = "SELECT * FROM tbl_chi_tiet_don_hang WHERE id_donhang = '$id_donhang'";
            $query_chi_tiet_don_hang = mysqli_query($mysqli, $sql_chi_tiet_don_hang);

            $soluongban = 0;
            $doanhthu = 0;

            // Lặp qua từng chi tiết đơn hàng để tính tổng số lượng và doanh thu
            while ($row_chi_tiet_don_hang = mysqli_fetch_assoc($query_chi_tiet_don_hang)) {
                $soluongban += $row_chi_tiet_don_hang['soluong'];
                $doanhthu += $row_chi_tiet_don_hang['gia'] * $row_chi_tiet_don_hang['soluong'];
            }

            // Kiểm tra xem ngày đã tồn tại trong bảng tbl_thongke hay chưa
            $sql_check_exist = "SELECT * FROM tbl_thongke WHERE DATE(ngaydat) = DATE('$ngaymua')";
            $query_check_exist = mysqli_query($mysqli, $sql_check_exist);

            if (mysqli_num_rows($query_check_exist) == 0) {
                // Nếu ngày chưa tồn tại, thêm dữ liệu mới vào tbl_thongke
                $sql_insert_thongke = "INSERT INTO tbl_thongke (ngaydat, soluongban, doanhthu, donhang) 
                                    VALUES ('$ngaymua', $soluongban, $doanhthu, 1)";
                mysqli_query($mysqli, $sql_insert_thongke);
            } else {
                // Nếu ngày đã tồn tại, cập nhật dữ liệu trong tbl_thongke nếu giờ phút giây không trùng
                $sql_update_thongke = "INSERT INTO tbl_thongke (ngaydat, soluongban, doanhthu, donhang) 
                                    SELECT '$ngaymua', $soluongban, $doanhthu, 1
                                    FROM dual
                                    WHERE NOT EXISTS (
                                        SELECT 1 
                                        FROM tbl_thongke 
                                        WHERE ngaydat = '$ngaymua' 
                                        AND TIME(ngaydat) = TIME('$ngaymua')
                                    )";
                mysqli_query($mysqli, $sql_update_thongke);
            }
        }

        // Chuyển hướng về trang cần thiết hoặc hiển thị thông báo thành công
        //echo 'id_donhang mới: ' . $id_donhang;


        header('location: pages/main/inhoadon.php?id_donhang=' . $id_donhang);

    } elseif ($payment_method == 'VNPay') {
        $vnp_TxnRef = $id_donhang; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $tongtien; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'QR'; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount*100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00', 'message' => 'success', 'data' => $vnp_Url);

        if (isset($_POST['redirect'])) {
           $_SESSION['id_hang']= $id_donhang;
           $ngaymua = $startTime;
            $payment_method = $_POST['payment_method'];
            $sql_them_donhang = "INSERT INTO tbl_donhang (ngaymua, tongtien, payment_method, id_donhang) 
                    VALUES ('$ngaymua', '$tongtien', '$payment_method', '$id_donhang')";
            mysqli_query($mysqli, $sql_them_donhang);

            foreach ($_SESSION['cart'] as $cart_item) {
                $id_sanpham = $cart_item['id'];
                $soluong = $cart_item['soluong'];
                $gia = $cart_item['giasanpham'];
                $sql_them_chi_tiet = "INSERT INTO tbl_chi_tiet_don_hang (id_donhang, id_sanpham, soluong, gia) 
                                    VALUES ('$id_donhang', '$id_sanpham', '$soluong', '$gia')";
                mysqli_query($mysqli, $sql_them_chi_tiet);
            }
        //xulythongke
        $sql_donhang = "SELECT * FROM tbl_donhang";
        $query_donhang = mysqli_query($mysqli, $sql_donhang);

        // Lặp qua từng đơn hàng
        while ($row_donhang = mysqli_fetch_assoc($query_donhang)) {
            $id_donhang = $row_donhang['id_donhang'];
            $ngaymua = Carbon::parse($row_donhang['ngaymua'])->toDateTimeString();
            $tongtien = $row_donhang['tongtien'];

            // Lấy thông tin chi tiết đơn hàng từ bảng tbl_chi_tiet_don_hang
            $sql_chi_tiet_don_hang = "SELECT * FROM tbl_chi_tiet_don_hang WHERE id_donhang = '$id_donhang'";
            $query_chi_tiet_don_hang = mysqli_query($mysqli, $sql_chi_tiet_don_hang);

            $soluongban = 0;
            $doanhthu = 0;

            // Lặp qua từng chi tiết đơn hàng để tính tổng số lượng và doanh thu
            while ($row_chi_tiet_don_hang = mysqli_fetch_assoc($query_chi_tiet_don_hang)) {
                $soluongban += $row_chi_tiet_don_hang['soluong'];
                $doanhthu += $row_chi_tiet_don_hang['gia'] * $row_chi_tiet_don_hang['soluong'];
            }

            // Kiểm tra xem ngày đã tồn tại trong bảng tbl_thongke hay chưa
            $sql_check_exist = "SELECT * FROM tbl_thongke WHERE DATE(ngaydat) = DATE('$ngaymua')";
            $query_check_exist = mysqli_query($mysqli, $sql_check_exist);

            if (mysqli_num_rows($query_check_exist) == 0) {
                // Nếu ngày chưa tồn tại, thêm dữ liệu mới vào tbl_thongke
                $sql_insert_thongke = "INSERT INTO tbl_thongke (ngaydat, soluongban, doanhthu, donhang) 
                                    VALUES ('$ngaymua', $soluongban, $doanhthu, 1)";
                mysqli_query($mysqli, $sql_insert_thongke);
            } else {
                // Nếu ngày đã tồn tại, cập nhật dữ liệu trong tbl_thongke nếu giờ phút giây không trùng
                $sql_update_thongke = "INSERT INTO tbl_thongke (ngaydat, soluongban, doanhthu, donhang) 
                                    SELECT '$ngaymua', $soluongban, $doanhthu, 1
                                    FROM dual
                                    WHERE NOT EXISTS (
                                        SELECT 1 
                                        FROM tbl_thongke 
                                        WHERE ngaydat = '$ngaymua' 
                                        AND TIME(ngaydat) = TIME('$ngaymua')
                                    )";
                mysqli_query($mysqli, $sql_update_thongke);
            }
        }
        //Quay về trang thanh toán của vnpay
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }


    unset($_SESSION['cart']);

    
    exit;
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .shop-cart-img {
            width: 100px;
            height: 100px;
        }
        .payment_container {
            display: flex;
            flex-direction: column;
            width: 30%;
            margin-top: 50px;

        }
        .container_payment_card_shopping {
            width: 70%;
        }
        .total_price_product {
            padding-top: 15px;
        }
        td {
            line-height:100px;
        }
        .container_payment_card {
            width: 100%;
        }

    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    ?>
    <div class="container_payment_card d-flex">
        <div class="container_payment_card_shopping shadow">
        <h2 class="text-danger">Giỏ hàng của bạn</h2>
        <table class="table table-bordered ">
            <tr>
                <th style="width: 20%">Tên sản phẩm</th>
                <th style="width: 15%;">Giá</th>
                <th style="width: 20%;">Số lượng</th>
                <th style="width: 15%;">Hình ảnh</th>
                <th style="width: 15%;">Thành tiền</th>
                <th style="width: 15%;">Thao tác</th>
            </tr>
            <?php
            $tongtien = 0;
            foreach ($_SESSION['cart'] as $cart_item) {
                $thanhtien = $cart_item['soluong'] * $cart_item['giasanpham'];
                $tongtien += $thanhtien;
            ?>
            <tr>
                <td style= "height: 100px" class="d-flex justify-content-center align-items-center"><?php echo $cart_item['tensanpham']; ?></td>
                <td style= "height: 100px"><?php echo number_format($cart_item['giasanpham']); ?> VNĐ</td>
                <!-- Trong vòng lặp hiển thị giỏ hàng -->
                <td style= "height: 100px"class="d-flex justify-content-center align-items-center">
                    <form style="height:100px" method="get" action="pages/main/themgiohang.php">
                        <input type="hidden" name="tru" value="<?php echo $cart_item['id']; ?>">
                        <button type="submit" class="btn btn-primary">-</button>
                    </form>
                    <b class = "px-3"><?php echo $cart_item['soluong']; ?></b>
                    <form style="height:100px" method="get" action="pages/main/themgiohang.php">
                        <input type="hidden" name="cong" value="<?php echo $cart_item['id']; ?>">
                        <button type="submit" class="btn btn-primary">+</button>
                    </form>
                </td>
                <td style= "height: 100px"><img src="admincp/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh']; ?>" class="shop-cart-img"></td>
                <td style= "height: 100px"><?php echo number_format($thanhtien); ?> VNĐ</td>
                <td style= "height: 100px"><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>        
            </tr>
            <?php
            }
            ?>
        </table>
        <div class ="deleteAll_shopping_cart">
             <a style ="float:right; margin-right:10px; margin-bottom:10px" href="pages/main/themgiohang.php?xoatatca=1" class="btn btn-danger deleteAll_shopping_cart_link">Xóa tất cả</a>
        </div>
        </div>
        <div class="payment_container shadow">
            <div class="total_price_product pb-3">
                <b class="fs-3">Tổng tiền: <?php echo number_format($tongtien); ?> VNĐ</b>
            </div>
            <div>
                <form class="pb-3" action="" method="post">
                                <!-- Thêm phần chọn phương thức thanh toán -->
                    <label for="payment_method"><b>Chọn phương thức thanh toán</b>:</label>
                    <div class="form-check">
                        <input type="radio" id="cash" name="payment_method" value="Tiền Mặt" checked>
                        <label for="cash">Tiền mặt</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" id="bank_transfer" name="payment_method" value="Chuyển Khoản">
                        <label for="bank_transfer">Chuyển khoản</label><br>
                    </div>

                    <div class="form-check">
                        <input type="radio" id="vnpay" name="payment_method" value="VNPay">
                        <img src="img/vnpay.png" height="38" width="63">
                        <label for="vnpay">VNPay</label><br>
                    </div>

                    <!-- Hiển thị thông tin liên quan đến từng phương thức -->
                    <div id="cash_info">
                    </div>

                    <div id="bank_transfer_info" style="display: none;">
                    </div>

                    <div id="vnpay_info" style="display: none;">
                    </div>
                    <input type="submit" name="redirect" class="btn btn-primary" value="Thanh toán">
                </form>
            </div>
        </div>
        </div>
    <?php
    } else {
        // Giỏ hàng trống
        echo "<p>Giỏ hàng của bạn trống. Hãy thêm sản phẩm vào giỏ hàng trước khi thanh toán.</p>";
    }
    ?>

<script>
    // Hiển thị thông tin phương thức thanh toán tương ứng
    document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var paymentMethod = this.value;

            document.getElementById('cash_info').style.display = (paymentMethod === 'cash') ? 'block' : 'none';
            document.getElementById('bank_transfer_info').style.display = (paymentMethod === 'bank_transfer') ? 'block' : 'none';
            document.getElementById('vnpay_info').style.display = (paymentMethod === 'vnpay') ? 'block' : 'none';
        });
    });
</script>
</body>
</html>
