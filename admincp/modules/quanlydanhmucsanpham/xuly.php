<?php
include('../../config/config.php');

$tenloaisp = isset($_POST['tendanhmuc']) ? $_POST['tendanhmuc'] : '';
$thutu = isset($_POST['thutu']) ? $_POST['thutu'] : '';

// Kiểm tra trùng lặp khi thêm danh mục mới hoặc sửa danh mục
$sql_check_duplicate = "SELECT * FROM tbl_danhmuc WHERE (tendanhmuc = '$tenloaisp' OR thutu = '$thutu') AND id_danhmuc != " . (int)$_GET['iddanhmuc'];
$result = mysqli_query($mysqli, $sql_check_duplicate);

if (mysqli_num_rows($result) > 0 ){
    // Sử dụng JavaScript để hiển thị thông báo
    echo '<script>';
    echo 'alert("Tên danh mục hoặc thứ tự đã tồn tại. Vui lòng nhập lại.");';
    echo 'window.location.href = "../../index.php?action=quanlydanhmucsanpham&query=them";'; // Chuyển hướng về trang cần thiết
    echo '</script>';
} else {
    if(isset($_POST['themdanhmuc'])){
        
        // Thêm mới danh mục
        $sql_them = "INSERT INTO tbl_danhmuc(tendanhmuc, thutu) VALUES ('$tenloaisp','$thutu')";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
    } elseif(isset($_POST['suadanhmuc'])){
        // Sửa danh mục
        $danhmuc=$_GET['iddanhmuc'];
        $sql_update = "UPDATE tbl_danhmuc SET tendanhmuc='$tenloaisp', thutu='$thutu' WHERE id_danhmuc='$danhmuc'";
        mysqli_query($mysqli, $sql_update);
        header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
    } else {
        // Xóa danh mục
        $id=$_GET['iddanhmuc'];
        $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc='".$id."'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
    }
}
?>
