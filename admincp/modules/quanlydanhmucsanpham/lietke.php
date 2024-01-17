<?php
    $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
    $query_lietke_danhmucsp = mysqli_query($mysqli,$sql_lietke_danhmucsp);
    
?>
<div class="container-fluid">
  <h3 class="panel-title fs-1 text-primary">Liệt kê danh mục</h3>
    <table style="width:100%" border="1" style=border-collapse:collapse;>
      <tr>
        <th>Id</th>
        <th>Tên danh mục</th>
        <th>Thứ Tự</th>
        <th>Quản lý</th>
      </tr>
      <?php
      $i=0;
      while ($row = mysqli_fetch_array($query_lietke_danhmucsp)){
        $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['tendanhmuc'] ?></td>
            <td><?php echo $row['thutu'] ?></td>
            <td>
                <a class="btn btn-danger" href ="modules/quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Xóa</a> | <a class="btn btn-warning" href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Sửa</a>
            </td>

        </tr>
        <?php
        }
        ?>
    </table>
</div>