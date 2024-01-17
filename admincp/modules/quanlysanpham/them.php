<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<html>
    <body>
    <div class="container">
      <div class="panel-heading"> 
		    <h3 class="panel-title fs-1 text-primary">Thêm sản phẩm</h3> 
      </div> 
      <div class="panel-body">
        
      <form action="modules/quanlysanpham/xuly.php" method="post" enctype='multipart/form-data'class="form-horizontal" role="form">
         <div class="form-group">
			<label for="productName" class="col-sm-3 control-label pt-3">Tên sản phẩm</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="tensanpham" id="productName" placeholder="Nhập tên sản phẩm">
			</div>
        </div> 
        <div class="form-group">
          <label for="productPrice" class="col-sm-3 control-label pt-3">Giá sản phẩm</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="giasanpham" id="productPrice" placeholder="Nhập giá sản phẩm">
          </div>
        </div>
        <div class="form-group">
          <label for="productName" class="col-sm-3 control-label pt-3">Số lượng</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="soluong" id="productName" placeholder="Nhập số lượng sản phẩm">
          </div>
        </div>
        <div class="form-group">
          <label for="productImg" name="hinhanh" class="col-sm-3 control-label pt-3">Ảnh</label>
          <div class="col-sm-3">
            <label class="control-label small" for="productImg">Định dạng (jpg/png):</label> 
				<input type="file" name="hinhanh">
          </div>
        </div> 
		 <div class="form-group pt-3 col-sm-3">
         <tr>
            <td>Danh mục sản phẩm</td>
            <td>
                <select class="form-select form-select-sm mb-3 pt-2" name="danhmuc">
                    <?php
                        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                        $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
                        while($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        ?>  
                        <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                        <?php
                                    }
                    ?>   
                </select> 
            </td>
        </tr>
        <tr>
            <td>Tình Trạng</td>
            <td>
                <select class="form-select form-select-sm mb-3 col-sm-3" name="tinhtrang">
                    <option value="1">Hiển Thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </td>
        </tr>
        <tr>
        </div>  
        <div class="form-group py-3">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" name="themsanpham" class="btn btn-primary">Thêm</button>
          </div>
        </div> 
      </form>      
      </div>
    </div>
    <hr>
    </body>
</html>