<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh mục sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="panel-heading"> 
            <h3 class="panel-title fs-1 text-primary">Thêm danh mục</h3> 
        </div> 
        <div class="panel-body">           
        <form method="POST" action="modules/quanlydanhmucsanpham/xuly.php" enctype='multipart/form-data'class="form-horizontal" role="form">
            <div class="form-group">
            <label for="productName" class="col-sm-3 control-label pt-3">Tên danh mục</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tendanhmuc" id="productName" placeholder="Nhập tên danh mục">
            </div>
            </div>
            <div class="form-group">
                <label for="ProductId" class="col-sm-3 control-label pt-3">Thứ tự</label>
                <div class="col-sm-4">
                <input type="text" class="form-control" name="thutu" id="productId" placeholder="Nhập thứ tự">
                </div>
            </div>
            <div class="form-group py-3">
            <tr>
                <td colspan="2"><input class="btn btn-primary" type="submit" name="themdanhmuc" value="Thêm danh mục"></td>
            </tr> 
            </div>
        </form>      
        </div>
    </div>
    <hr>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>