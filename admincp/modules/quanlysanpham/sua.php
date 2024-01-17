<?php
    $sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
    $query_sua_sp = mysqli_query($mysqli,$sql_sua_sp);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="container">
      <div class="panel-heading"> 
		<h3 class="panel-title fs-1 text-primary">Sửa sản phẩm</h3> 
      </div> 
      <div class="panel-body">
      <?php
        while ($row = mysqli_fetch_array($query_sua_sp)) {
      ?>
      <form method="POST" action="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>" enctype='multipart/form-data'class="form-horizontal" role="form">
         <div class="form-group">
          <label for="productName" class="col-sm-3 control-label pt-3">Tên sản phẩm</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $row['tensanpham']?>" name="tensanpham" id="productName" placeholder="Nhập tên sản phẩm">
          </div>
        </div>
      
        <div class="form-group">
          <label for="productPrice" class="col-sm-3 control-label pt-3">Giá sản phẩm</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $row['giasanpham']?>" name="giasanpham" id="productPrice" placeholder="Nhập giá sản phẩm">
          </div>
        </div>
        <div class="form-group">
          <label for="productName" class="col-sm-3 control-label pt-3">Số lượng</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="soluong" value="<?php echo $row['soluong']; ?>" id="productName" placeholder="Nhập số lượng sản phẩm">
          </div>
        </div>
        <div class="form-group">
          <label for="productImg" name="hinhanh" class="col-sm-3 control-label pt-3">Ảnh</label>
          <div class="col-sm-3">
            <label class="control-label small" for="productImg">Định dạng (jpg/png):</label> 
            <input type="file" name="hinhanh">
			 <?php
				// Kiểm tra nếu có hình ảnh hiện tại thì hiển thị
				if (!empty($row['hinhanh'])) {
					echo '<br><img src="modules/quanlysanpham/uploads/' . $row['hinhanh'] . '" width="100" />';
				}
			?>
          </div>
        </div> 
		 <div class="form-group pt-3 col-sm-2">
         <tr>
            <td>Danh mục sản phẩm</td>
            <td>
                <select class="form-select form-select-sm mb-3 pt-2" name="danhmuc">
				   <?php
					$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
					$query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
					while($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
						if($row_danhmuc["id_danhmuc"] == $row["id_danhmuc"]) {
					?>  
						<option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
					<?php
						}else{
					?>
						<option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
					<?php
						}
					}
					?>       
                </select> 
            </td>
        </tr>
        <tr>
            <td>Tình Trạng</td>
            <td>
                <select class="form-select form-select-sm mb-3 col-sm-3" name="tinhtrang">
					<?php
						if ($row['tinhtrang']==1) {
							?>
							<option value="1" selected>Hiển Thị</option>
							<option value="0">Ẩn</option>
							<?php
						}else{
							?>
							<option value="1" selected>Hiển Thị</option>
							<option value="0">Ẩn</option>
							<?php
							}
					?>
                </select>
            </td>
        </tr>
        <tr>
        </div>
        <hr>
        <div class="form-group pt-3">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" name="suasanpham" class="btn btn-warning">Lưu thông tin</button>
            <button type="submit" name="huy" class="btn btn-dark">Hủy</button>
          </div>
        </div> 
      </form>      
      </div>
    </div>
  <?php
  }
  ?>    
</body>
</html>
