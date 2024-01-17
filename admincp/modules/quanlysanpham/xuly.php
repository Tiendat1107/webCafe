<?php
include('../../config/config.php');

$tensanpham = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : '';
$giasanpham = isset($_POST['giasanpham']) ? $_POST['giasanpham'] : '';
$soluong = isset($_POST['soluong']) ? (int)$_POST['soluong'] : 0;
$hinhanh = isset($_FILES['hinhanh']['name']) ? $_FILES['hinhanh']['name'] : '';
$hinhanh_tmp = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : '';
$hinhanh_name = time() . '_' . $hinhanh;
$danhmuc = isset($_POST['danhmuc']) ? $_POST['danhmuc'] : '';
$tinhtrang = isset($_POST['tinhtrang']) ? $_POST['tinhtrang'] : '';


// Kiểm tra trùng lặp khi thêm sản phẩm mới hoặc sửa sản phẩm
$sql_check_duplicate = "SELECT * FROM tbl_sanpham WHERE tensanpham = '$tensanpham' AND id_sanpham != " . (int)$_GET['idsanpham'];
$result = mysqli_query($mysqli, $sql_check_duplicate);

if (mysqli_num_rows($result) > 0 ){
    // Sử dụng JavaScript để hiển thị thông báo
    echo '<script>';
    echo 'alert("Tên sản phẩm đã tồn tại. Vui lòng nhập lại.");';
    echo 'window.location.href = "../../index.php?action=quanlysanpham&query=them";'; // Redirect về trang cần thiết
    echo '</script>';
} else {
    // Tiếp tục xử lý nếu không có trùng lặp
    if (isset($_POST['themsanpham'])) {
        //them
        // Kiểm tra các trường cần thiết
        if (empty($tensanpham) || empty($giasanpham) || empty($hinhanh) || empty($danhmuc) ||  !is_numeric($giasanpham) || !is_numeric($soluong)) {
            // Nếu bất kỳ trường nào không được nhập, hiển thị thông báo lỗi và không thực hiện thêm/sửa sản phẩm
            echo '<script>';
            echo 'alert(" Nhập thiếu thông tin sản phẩm.\nGiá và số lượng phải là số.\nVui lòng nhập lại.");';
            echo 'window.location.href = "../../index.php?action=quanlysanpham&query=them";'; // Redirect về trang cần thiết
            echo '</script>';
        } else {
            $sql_them = "INSERT INTO tbl_sanpham(tensanpham,giasanpham,soluong,hinhanh,id_danhmuc,tinhtrang) VALUES ('$tensanpham','$giasanpham','$soluong','$hinhanh_name','$danhmuc','$tinhtrang')";
            mysqli_query($mysqli, $sql_them);
            move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh_name);
            header('Location:../../index.php?action=quanlysanpham&query=them');
        }
    } elseif (isset($_POST['suasanpham'])) {
        //sua
        // Kiểm tra các trường cần thiết
        if (empty($tensanpham) || empty($giasanpham) || empty($hinhanh) || empty($danhmuc) || !is_numeric($giasanpham) || !is_numeric($soluong)) {
            // Nếu bất kỳ trường nào không được nhập, hiển thị thông báo lỗi và không thực hiện thêm/sửa sản phẩm
            echo '<script>';
            echo 'alert("Nhập thiếu thông tin sản phẩm.\nGiá và số lượng phải là số.\nVui lòng nhập lại.");';
            echo 'window.location.href = "../../index.php?action=quanlysanpham&query=sua&idsanpham=' . $_GET['idsanpham'] . '";';// Redirect về trang cần thiết
            echo '</script>';
        } else {
            if ($hinhanh != '') {
                move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh_name);
                $sql_update = "UPDATE tbl_sanpham SET tensanpham='$tensanpham',giasanpham='$giasanpham',soluong='$soluong',hinhanh='$hinhanh_name',id_danhmuc='$danhmuc',tinhtrang='$tinhtrang' WHERE id_sanpham=" . (int)$_GET['idsanpham'];

                $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = " . (int)$_GET['idsanpham'] . " LIMIT 1";
                $query = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($query)) {
                    unlink('uploads/' . $row['hinhanh']);
                }
            } else {
                $sql_update = "UPDATE tbl_sanpham SET tensanpham='$tensanpham',giasanpham='$giasanpham',soluong='$soluong',hinhanh='$hinhanh_name',id_danhmuc='$danhmuc',tinhtrang='$tinhtrang' WHERE id_sanpham=" . (int)$_GET['idsanpham'];
            }
            mysqli_query($mysqli, $sql_update);
            header('Location:../../index.php?action=quanlysanpham&query=them');
        }
    //Huy sua san pham        
    }elseif (isset($_POST['huy'])) {
        // Nếu nút "Hủy" được nhấn, chỉ chuyển hướng về trang quản lý sản phẩm
        header('Location:../../index.php?action=quanlysanpham&query=them');
        exit;
    
    } else {
        //xoa
        $id = (int)$_GET['idsanpham'];
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = $id LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['hinhanh']);
        }
        $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham=$id";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlysanpham&query=them');
    }
}
?>
