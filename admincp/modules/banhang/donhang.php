<?php

// Truy vấn danh sách các đơn hàng đã bán
$sql_donhang = "SELECT * FROM tbl_donhang ORDER BY ngaymua DESC";
$query_donhang = mysqli_query($mysqli, $sql_donhang);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng đã bán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <h2>Danh sách đơn hàng đã bán</h2>
    <table>
        <tr>
            <th>ID Đơn Hàng</th>
            <th>Ngày Mua</th>
            <th>Tổng Tiền</th>
            <th>Phương Thức Thanh Toán</th>
            <th>Chi Tiết</th>
        </tr>
        <?php
        while ($row_donhang = mysqli_fetch_assoc($query_donhang)) {
        ?>
        <tr>
            <td><?php echo $row_donhang['id_donhang']; ?></td>
            <td><?php echo $row_donhang['ngaymua']; ?></td>
            <td><?php echo number_format($row_donhang['tongtien']); ?> VNĐ</td>
            <td><?php echo $row_donhang['payment_method']; ?></td>
            <td><a href="modules/banhang/chitietdonhang.php?id_donhang=<?php echo $row_donhang['id_donhang']; ?>">Chi tiết</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
