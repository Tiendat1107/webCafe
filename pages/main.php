<div class="container-fluid pt-5 d-flex">
  <?php
    include("sidebar/sidebar.php");
  ?>
      <div style="width: 100%"  class="card-item d-flex shadow" style =“width:100%;”>
        <?php
        if(isset($_GET['quanly'])){
          $tam = $_GET['quanly'];
        }else{
          $tam = '';
        }
        if($tam=='danhsach'){
          include("main/danhmuc.php");
        }elseif($tam=='giohang'){
          include("main/giohang.php");
        }elseif($tam=='thanhtoan'){
          include("main/thanhtoan.php");
        }elseif($tam=='inhoadon'){
          include("main/inhoadon.php"); 
        }elseif($tam=='sanpham'){
          include("main/index.php");
        }elseif($tam=='timkiem'){
          include("main/timkiem.php");  
        }else{
          include("main/index.php");
        }
        ?>  
      </div>
</div>