<?php
include('../../config/config.php');

// Lấy dữ liệu từ form
$id_nhanvien = isset($_POST['id_nhanvien']) ? $_POST['id_nhanvien'] : null;
$hoten = $_POST['hoten'];
$namsinh = $_POST['namsinh'];
$gioitinh = $_POST['gioitinh'];
$diachi = $_POST['diachi'];
$sodienthoai = $_POST['sodienthoai'];
$tendangnhap = $_POST['tendangnhap'];
$matkhau = isset($_POST['matkhau']) ? password_hash($_POST['matkhau'], PASSWORD_DEFAULT) : null;

// Kiểm tra nút được nhấn là "Thêm Nhân viên"
if (isset($_POST['themnhanvien'])) {
    // Kiểm tra trùng lặp khi thêm nhân viên mới
    $sql_check_duplicate = "SELECT * FROM tbl_nhanvien WHERE tendangnhap = '$tendangnhap'";
    $result = mysqli_query($mysqli, $sql_check_duplicate);

    if (mysqli_num_rows($result) > 0) {
        // Thông báo nếu tên đăng nhập đã tồn tại
        echo '<script>';
        echo 'alert("Tên đăng nhập đã tồn tại. Vui lòng nhập lại.");';
        echo 'window.location.href = "../../index.php?action=quanlynhanvien&query=them";';
        echo '</script>';
    } else {
        // Thực hiện thêm nhân viên nếu không có trùng lặp
        if (empty($hoten) || empty($namsinh) || empty($gioitinh) || empty($diachi) || !is_numeric($sodienthoai) || empty($tendangnhap)) {
            // Nếu bất kỳ trường nào không được nhập, hiển thị thông báo lỗi
            echo '<script>';
            echo 'alert("Nhập thiếu thông tin nhân viên. Vui lòng nhập lại.");';
            echo 'window.location.href = "../../index.php?action=quanlynhanvien&query=them";';
            echo '</script>';
        } else {
            // Thực hiện thêm nhân viên
            $sql_them = "INSERT INTO tbl_nhanvien(hoten, namsinh, gioitinh, diachi, sodienthoai, tendangnhap, matkhau) VALUES ('$hoten','$namsinh','$gioitinh','$diachi','$sodienthoai','$tendangnhap','$matkhau')";
            mysqli_query($mysqli, $sql_them);
            header('Location:../../index.php?action=quanlynhanvien&query=them');
        }
    }
} elseif (isset($_POST['suanhanvien'])) {
    // Kiểm tra nút được nhấn là "Sửa Nhân viên"
    // Thực hiện kiểm tra trường thông tin và cập nhật nhân viên
    if (empty($hoten) || empty($namsinh) || empty($gioitinh) || empty($diachi) || !is_numeric($sodienthoai) || empty($tendangnhap)) {
        // Nếu bất kỳ trường nào không được nhập, hiển thị thông báo lỗi
        echo '<script>';
        echo 'alert("Nhập thiếu thông tin nhân viên. Vui lòng nhập lại.");';
        echo 'window.location.href = "../../index.php?action=quanlysanpham&query=sua&idsanpham=' . $_GET['idsanpham'] . '";';
        echo '</script>';
    } else {
        // Thực hiện cập nhật thông tin nhân viên
        $sql_update = "UPDATE tbl_nhanvien SET hoten = ?, namsinh = ?, gioitinh = ?, diachi = ?, sodienthoai = ?, tendangnhap = ?";
        $params = "ssssss";
        $values = array($hoten, $namsinh, $gioitinh, $diachi, $sodienthoai, $tendangnhap);

        if ($matkhau !== null) {
            $sql_update .= ", matkhau = ?";
            $params .= "s";
            $values[] = $matkhau;
        }

        $sql_update .= " WHERE id_nhanvien = ?";
        $params .= "i";
        $values[] = $id_nhanvien;

        $stmt_update = mysqli_prepare($mysqli, $sql_update);
        mysqli_stmt_bind_param($stmt_update, $params, ...$values);
        mysqli_stmt_execute($stmt_update);

        header('Location:../../index.php?action=quanlynhanvien&query=them');
    }
} elseif (isset($_POST['huy'])) {
    // Nếu nút "Hủy" được nhấn, chuyển hướng về trang quản lý nhân viên
    header('Location:../../index.php?action=quanlynhanvien&query=them');
    exit;
} else {
    // Kiểm tra nút được nhấn là "Xóa Nhân viên"
    // Thực hiện xóa nhân viên
    $id = isset($_GET['idnhanvien']) ? (int)$_GET['idnhanvien'] : null;

    if (!isset($id)) {
        // Nếu không tìm thấy ID nhân viên, hiển thị thông báo lỗi
        echo '<script>';
        echo 'alert("Lỗi: Không tìm thấy ID nhân viên.");';
        echo 'window.location.href = "../../index.php?action=quanlynhanvien&query=them";';
        echo '</script>';
        exit;
    }

    $sql_delete = "DELETE FROM tbl_nhanvien WHERE id_nhanvien = $id";
    mysqli_query($mysqli, $sql_delete);

    header('Location:../../index.php?action=quanlynhanvien&query=them');
}
?>
