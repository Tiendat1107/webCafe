<?php

// Lấy danh sách nhân viên từ cơ sở dữ liệu
$sql_select_all = "SELECT * FROM tbl_nhanvien ORDER BY id_nhanvien DESC";
$query_select_all = mysqli_query($mysqli, $sql_select_all);

?>

<body>
    <h3 class="panel-title fs-1 text-primary">Danh sách nhân viên</h3>
    <table border="1">
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Năm sinh</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Tên đăng nhập</th>
            <th>Action</th>
        </tr>

        <?php
        $i=0;
        while ($row = mysqli_fetch_array($query_select_all)) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['hoten'] ?></td>
            <td><?php echo $row['namsinh'] ?></td>
            <td><?php echo $row['gioitinh'] ?></td>
            <td><?php echo $row['diachi'] ?></td>
            <td><?php echo $row['sodienthoai'] ?></td>
            <td><?php echo $row['tendangnhap'] ?></td>
            <td>
            <a class="btn btn-danger" href ="modules/quanlynhanvien/xuly.php?idnhanvien=<?php echo $row['id_nhanvien'] ?>">Xóa</a> | <a class="btn btn-warning" href="?action=quanlynhanvien&query=sua&idnhanvien=<?php echo $row['id_nhanvien'] ?>">Sửa</a>
            </td>

        </tr>
            <?php
            }
            ?>
    </table>
</body>

