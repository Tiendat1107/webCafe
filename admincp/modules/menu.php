<?php
    if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
        unset($_SESSION['dangnhap']);
        header("Location:login.php");
    }
?>   
<div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="index.php?action=trangchu">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="index.php?action=quanlynhanvien&query=them">
                    <i class="fa-solid fa-user"></i>
                    <span>Tài khoản</span>
                </a>
            </li>
            <li>
                <a href="index.php?action=quanlydanhmucsanpham&query=them">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Quản lý danh mục sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="index.php?action=quanlysanpham&query=them">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="index.php?action=quanlydonhang&query=quanly">
                    <i class="fa-solid fa-list"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
            </li>
            
            <li class="logout">
                <a href="index.php?dangxuat=1">
                <?php 
                if(isset($_SESSION['dangnhap'])){ 
                ?>
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Đăng xuất</span>
                <?php
                }
                ?>
                </a>
            </li>
        </ul>
    </div>
    