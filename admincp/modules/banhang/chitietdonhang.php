<?php
session_start();
include('../../config/config.php');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2, h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin: 10px 0;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        body > div {
            max-width: 600px;
            width: 100%;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <h2>Thông Tin Chi Tiết Đơn Hàng #<?php echo $row_donhang['id_donhang']; ?></h2>
        <p>Ngày Mua: <?php echo $row_donhang['ngaymua']; ?></p>
        <p>Hình Thức Thanh Toán: <?php echo $row_donhang['payment_method']; ?></p>

        <h3>Chi Tiết Sản Phẩm</h3>
        <table>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
            <?php
            $tongtien_donhang = 0;
            while ($row_chi_tiet_don_hang = mysqli_fetch_assoc($query_chi_tiet_don_hang)) {
                $tongtien_donhang += $row_chi_tiet_don_hang['thanhtien'];
            ?>
            <tr>
                <td><?php echo $row_chi_tiet_don_hang['tensanpham']; ?></td>
                <td><?php echo number_format($row_chi_tiet_don_hang['gia']); ?> VNĐ</td>
                <td><?php echo $row_chi_tiet_don_hang['soluong']; ?></td>
                <td><?php echo number_format($row_chi_tiet_don_hang['thanhtien']); ?> VNĐ</td>
            </tr>
            <?php
            }
            ?>
        </table>

        <p>Tổng Tiền Đơn Hàng: <?php echo number_format($tongtien_donhang); ?> VNĐ</p>


<form method="post">
    <input type="submit" name="quaylai" value="Quay lại Đơn Hàng">
</form>

<?php
// Xử lý sự kiện khi nút thoát được nhấn
if (isset($_POST['quaylai'])) {
    header('Location:../../index.php?action=quanlydonhang&query=quanly');
    exit();
}
?>
    </div>
</body>
</html>


<?php
    } else {
        echo "<p>Không tìm thấy đơn hàng.</p>";
    }
} else {
    echo "<p>Thiếu thông tin đơn hàng.</p>";
}
?>
