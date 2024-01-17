<?php
    $sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
    $query_sua_danhmucsp = mysqli_query($mysqli,$sql_sua_danhmucsp);
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
    <div class="containers">
    <div class="panel-heading"> 
        <h3 class="panel-title fs-1 text-primary">Sửa danh mục</h3> 
    </div> 
    <div class="panel-body">
            
        <form method="POST" action="modules/quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>" enctype='multipart/form-data'class="form-horizontal" role="form">
        <?php
            while($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
            ?>
            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label pt-3">Tên danh mục</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text"  value="<?php echo $dong['tendanhmuc']?>" name="tendanhmuc" id="productName" placeholder="Nhập tên danh mục">
                </div>
            </div>
            <div class="form-group">
                <label for="ProductId" class="col-sm-3 control-label pt-3">Thứ tự</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text"  value="<?php echo $dong['thutu']?>" name="thutu" id="productId" placeholder="Nhập thứ tự">
                </div>
            </div>
            <div class="form-group pt-3">
            <tr>
                <td colspan="2"><input class="btn btn-warning" type="submit" name="suadanhmuc" value="Sửa danh mục"></td>
            </tr> 
            </div>
            <?php
                }
                ?> 
        </form>      
    </div>
</div>

</body>
