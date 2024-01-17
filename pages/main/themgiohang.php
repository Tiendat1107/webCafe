<?php
session_start();
include('../../admincp/config/config.php');

// Trong phần tăng số lượng
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['soluong'] = min(20, $cart_item['soluong'] + 1);
        }
    }
    header('location:../../index.php?quanly=giohang');
}

// Trong phần giảm số lượng
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['soluong'] = max(1, $cart_item['soluong'] - 1);
        }
    }
    header('location:../../index.php?quanly=giohang');
}

//xoa san pham
if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $product = array(); // Khởi tạo mảng mới để lưu sản phẩm sau khi xóa

    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] != $id) {
            // Thêm các sản phẩm không phải là sản phẩm cần xóa vào mảng mới
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'],
                'id' => $cart_item['id'],
                'soluong' => $cart_item['soluong'],
                'giasanpham' => $cart_item['giasanpham'],
                'hinhanh' => $cart_item['hinhanh']
            );
        }
    }

    $_SESSION['cart'] = $product;
    header('location:../../index.php?quanly=giohang');
}

//xoa tat ca
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    header('location:../../index.php?quanly=giohang');
}

//them san pham vao gio hang
if (isset($_POST['themgiohang'])) {
    $id = $_GET['idsanpham']; // lấy ra id sp cần thêm
    $soluong = 1; //so luong mac dinh 1
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='" . $id . "' LIMIT 1"; //lấy ra sản phẩm dựa vào id sp
    $query = mysqli_query($mysqli, $sql); //truy vấn dữ liệu
    $row = mysqli_fetch_array($query); //đổ dữ liệu
    if ($row) { //nếu có dữ liệu
        $new_product = array(array('tensanpham' => $row['tensanpham'], 'id' => $id, 'soluong' => $soluong, 'giasanpham' => $row['giasanpham'], 'hinhanh' => $row['hinhanh'])); //lưu session giỏ hàng
        //kiem tra session gio hang ton tai
        if (isset($_SESSION['cart'])) { //kiểm tra tồn tại sp trong giỏ hàng
            $found = false;
            $product = array(); // Khởi tạo mảng $product
            foreach ($_SESSION['cart'] as $cart_item) {
                // neu du lieu bi trùng
                if ($cart_item['id'] == $id) { //nếu có sp trong giỏ hàng rồi thì số luong +1
                    $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $soluong + 1, 'giasanpham' => $cart_item['giasanpham'], 'hinhanh' => $cart_item['hinhanh']);
                    $found = true;
                } else {
                    //neu dữ liệu ko dùng thì thêm mới sp vào giỏ hàng
                    $product[] = array('tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'giasanpham' => $cart_item['giasanpham'], 'hinhanh' => $cart_item['hinhanh']);
                }
            }
            if ($found == false) {
                // lien ket dulieu new product voi product
                $_SESSION['cart'] = array_merge($product, $new_product);
            } else {
                $_SESSION['cart'] = $product; //session cart giữ nguyên
            }
        } else {
            $_SESSION['cart'] = $new_product; //tạo mới session cart với sp mới
        }
    }
    header('Location:../../index.php?quanly=sanpham'); //quay về danh mục
}
?>
