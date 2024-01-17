<?php
    $sql_lietke_sp = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC";
    $query_lietke_sp = mysqli_query($mysqli,$sql_lietke_sp);
    
?>
<h3 class="panel-title fs-1 text-primary">Danh sách sản phẩm</h3>
  <table style="width:100%" border="1" style=border-collapse:collapse;>
    <form action="modules/quanlysanpham/xuly.php" method="post" enctype="multipart/form-data">
      <tr>
        <th>Id</th>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Danh mục</th>
        <th>Tình trạng</th>
        <th>Thao Tác</th>
      </tr>
      <?php
      $i=0;
      while ($row = mysqli_fetch_array($query_lietke_sp)){
        $i = $i + 1;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo number_format($row['giasanpham'], 0, '', '.') . ' VNĐ'; ?></td>
            <td><img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" width= "150px" ></td>
            <td><?php echo $row['tendanhmuc'] ?></td>
            <td><?php echo $row['tinhtrang'] == 1 ? 'Hiển thị' : 'Ẩn'; ?></td>
            <td>
                <a class="btn btn-danger" href ="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>">Xóa</a> | <a class="btn btn-warning" href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">Sửa</a>
            </td>

        </tr>
        <?php
        }
        ?>
    </form>
  </table>
