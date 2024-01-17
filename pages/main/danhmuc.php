<?php

$sql_cate = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = ?";
$query_cate = mysqli_prepare($mysqli, $sql_cate);
mysqli_stmt_bind_param($query_cate, "i", $_GET['id']);
mysqli_stmt_execute($query_cate);
$result_cate = mysqli_stmt_get_result($query_cate);
$row_title = mysqli_fetch_array($result_cate);

$sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = ? AND tinhtrang = '1' ORDER BY id_sanpham DESC";
$query_pro = mysqli_prepare($mysqli, $sql_pro);
mysqli_stmt_bind_param($query_pro, "i", $_GET['id']);
mysqli_stmt_execute($query_pro);
$result_pro = mysqli_stmt_get_result($query_pro);

while ($row_pro = mysqli_fetch_array($result_pro)):
?>
  <div style="width:18%" class="card shadow">
    <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?> "> 
      <img class="card-img-top" src="admincp/modules/quanlysanpham/uploads/<?php echo $row_pro['hinhanh'] ?>" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row_pro['tensanpham'] ?></h5>
        <p class="card-price">Giá: <?php echo number_format($row_pro['giasanpham'], 0, '', '.') . ' VNĐ' ?></p>
        <a><input class="btn btn-primary" name="themgiohang" type="submit" value="Thêm" ></a>
      </div>
    </form>
  </div>
<?php endwhile; ?>
