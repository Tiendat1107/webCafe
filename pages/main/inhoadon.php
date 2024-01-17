<?php
session_start();
include('../../admincp/config/config.php');
require('../../TCPDF-main/TCPDF-main/tcpdf.php');

if (isset($_GET['id_donhang']) && $_GET['id_donhang']) {
    $id_donhang = $_GET['id_donhang'];

    // Truy vấn thông tin đơn hàng
    $sql_donhang = "SELECT * FROM tbl_donhang WHERE id_donhang = '$id_donhang'";
    $query_donhang = mysqli_query($mysqli, $sql_donhang);
    $row_donhang = mysqli_fetch_assoc($query_donhang);

    if ($row_donhang) {
        // Truy vấn chi tiết đơn hàng
        $sql_chi_tiet_don_hang = "SELECT sp.tensanpham, ctdh.gia, ctdh.soluong, ctdh.gia * ctdh.soluong AS thanhtien
                                 FROM tbl_chi_tiet_don_hang ctdh
                                 INNER JOIN tbl_sanpham sp ON ctdh.id_sanpham = sp.id_sanpham
                                 WHERE ctdh.id_donhang = '$id_donhang'";
        $query_chi_tiet_don_hang = mysqli_query($mysqli, $sql_chi_tiet_don_hang);

        // Bắt đầu bộ đệm đầu ra
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Chi Tiết Đơn Hàng</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        </head>
        <body class="text-center"  style= "display: flex; justify-content:center; align-items:center;">
            
          <div  style= "width:800px"; class="container_print_card d-flex flex-column justify-content-center align-items-center mt-5">
            <div>
            <h2 class="fs-1">Thông Tin Chi Tiết Đơn Hàng #<?php echo $row_donhang['id_donhang']; ?></h2>
                <b>Ngày Mua: <?php echo $row_donhang['ngaymua']; ?></b>
                <br>
                <b>Hình Thức Thanh Toán: <?php echo $row_donhang['payment_method']; ?></b>
            </div>
            <div style= "width:100%;padding-top:15px;"> 
                <h2 class="fs-1">Chi Tiết Sản Phẩm</h2>
                <table style="width: 100%;" class="table border="1">
                    <tr>
                        <th style= "width:30%">Tên Sản Phẩm</th>
                        <th style= "width:25%">Giá</th>
                        <th style= "width:20%">Số Lượng</th>
                        <th style= "width:25%">Thành Tiền</th>
                    </tr>
                    <?php
                    $tong_tien_don_hang = 0;
                    while ($row_chi_tiet_don_hang = mysqli_fetch_assoc($query_chi_tiet_don_hang)) {
                        ?>
                        <tr>
                            <td><?php echo $row_chi_tiet_don_hang['tensanpham']; ?></td>
                            <td><?php echo number_format($row_chi_tiet_don_hang['gia']); ?></td>
                            <td><?php echo $row_chi_tiet_don_hang['soluong']; ?></td>
                            <td><?php echo number_format($row_chi_tiet_don_hang['thanhtien']); ?></td>
                        </tr>
                        <?php
                        $tong_tien_don_hang += $row_chi_tiet_don_hang['thanhtien'];
                    }
                    ?>
                </table>
                
                <p style="font-size: 24px; font-weight:500; float: left; margin-left:10px;">Tổng Tiền Đơn Hàng: <?php echo number_format($tong_tien_don_hang); ?> VNĐ</p>

                <!-- Thêm nút "In Đơn Hàng" -->
                <button class="btn btn-primary float-end" onclick="printInvoice(<?php echo $id_donhang; ?>)">In Đơn Hàng</button>
            </div>
          </div>
            
            <script>
    function printInvoice(idDonHang) {
        // Mở một cửa sổ hoặc tab mới đến trang 'in.php'
        var newWindow = window.open('in.php?id_donhang=' + idDonHang, '_blank');

        // Chuyển hướng đến trang khác (ví dụ: trang header) sau một khoảng thời gian ngắn
        setTimeout(function() {
            window.location.href = '../../index.php?quanly=sanpham';
        }, 1000); // Điều chỉnh khoảng thời gian trễ (tính bằng mili giây) theo nhu cầu
    }
</script>
        </body>
        </html>
        <?php
        // Kết thúc bộ đệm đầu ra và gửi đến trình duyệt
        ob_end_flush();

    } else {
        echo "<p>Không tìm thấy đơn hàng.</p>";
    }
} else {
    echo "<p>Thiếu thông tin đơn hàng.</p>";
}
?>
