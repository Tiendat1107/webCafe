<div class="main">
    <?php
            
            if(isset($_GET['action']) && isset($_GET['query'])){
                $tam = $_GET['action'];
                $query = $_GET['query'];
            }else{
                $tam = '';
                $query = '';
            }
            //quản lý danh mục sản phẩm
            if($tam=='quanlydanhmucsanpham' && $query=='them'){
                include("modules/quanlydanhmucsanpham/them.php");
                include("modules/quanlydanhmucsanpham/lietke.php");
            }elseif ($tam=='quanlydanhmucsanpham' && $query=='sua'){
                include("modules/quanlydanhmucsanpham/sua.php");
            //quản lý sản phẩm
            }elseif ($tam=='quanlysanpham' && $query=='them'){
                include("modules/quanlysanpham/them.php");
                include("modules/quanlysanpham/lietke.php");
            }elseif ($tam=='quanlysanpham' && $query=='sua'){
                include("modules/quanlysanpham/sua.php");
            //quản lý nhân viên
            }elseif ($tam=='quanlynhanvien' && $query=='them'){
            include("modules/quanlynhanvien/dangky.php");
            include("modules/quanlynhanvien/lietke.php");
            }elseif ($tam=='quanlynhanvien' && $query=='sua'){
            include("modules/quanlynhanvien/sua.php");
            //Quan ly don hang
            }elseif($tam=='quanlydonhang' && $query=='quanly'){
                include("modules/banhang/donhang.php");
            }elseif ($tam=='quanlydonhang' && $query=='chitiet'){
                include("modules/banhang/chitietdonhang.php");
                
            }else{
                include("modules/dashboard.php");
            }
            
    ?>
</div>