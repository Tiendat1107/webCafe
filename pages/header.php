<header>
    <div class="container-fluid shadow">
        <nav style="height:70px;" class="shadow text-center align-items-center rounded-bottom">
            <div class="nav-left">
                <a href="index.php?quanly=sanpham"><i class="fa-solid fa-mug-hot fs-1 text-dark logo_icon"> Thảo CaFe</i></a>
                
            </div>
            <div class="nav-right">
                <div style="margin-right:10px" class="search--box">
                <form class="form-control" action="index.php?quanly=timkiem" method="POST">          
                    <input type="text" placeholder="Tìm kiếm sản phẩm:" name="tukhoa">
                    <input class="btn btn-primary btn-sm" type ="submit" name="timkiem" value="Tìm Kiếm">                    
                </form>
                </div>
                <div class="shopping">
                    <a href="index.php?quanly=giohang">
                        <img style="width:35px;" src="https://media.istockphoto.com/id/1206806317/vi/vec-to/bi%E1%BB%83u-t%C6%B0%E1%BB%A3ng-gi%E1%BB%8F-h%C3%A0ng-b%E1%BB%8B-c%C3%B4-l%E1%BA%ADp-tr%C3%AAn-n%E1%BB%81n-tr%E1%BA%AFng.jpg?s=612x612&w=0&k=20&c=UrYvaPaq7pqYECs9dSfy59-Z0UbXVwd5AhZQeeERNg8=" alt="">
                    </a>
                    <span class="quantity">
                        <?php
                            // Đếm số sản phẩm trong giỏ hàng
                            $soLuongSanPham = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                            echo $soLuongSanPham;
                        ?>
                    </span>
                </div>
                <div style="margin:10px;" class="logout">
                    <a class="logout-link" href="logout.php"><i style="font-size:18px;" class="fa-solid fa-right-from-bracket logout-icon "></i></a>
                </div>
            </div>
        </nav>
    </div>
</header>
<hr>
