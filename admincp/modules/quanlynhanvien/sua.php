<?php
        $sql_select = "SELECT * FROM tbl_nhanvien WHERE id_nhanvien = '$_GET[idnhanvien]' LIMIT 1";
        $query_select = mysqli_query($mysqli,$sql_select)
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">       
        <div class="panel-heading"> 
		    <h3 class="panel-title fs-1 text-primary">Sửa thông tin nhân viên</h3> 
        </div>
        <div class="panel-body">
            <form action="modules/quanlynhanvien/xuly.php?idnhanvien=<?php echo $_GET['idnhanvien'] ?>" method="post"" enctype='multipart/form-data' class="form-horizontal" role="form">
                <?php    
                while($row = mysqli_fetch_array($query_select)) {
                ?>
                <input type="hidden" name="id_nhanvien" value="<?php echo $row['id_nhanvien']; ?>">    
                <div class="form-group col-sm-6 control-label pt-3">
                    <label for="hoten">Họ và tên</label>
                    <input type="text" id="hoten" name="hoten" value="<?php echo $row['hoten']; ?>" required class="form-control"placeholder="Nhập họ tên">
                </div>                  
                <div class="form-group col-sm-3 pt-3">
                    <label for="namsinh">Năm sinh</label>
                    <input type="date" id="namsinh" name="namsinh" value="<?php echo $row['namsinh']; ?>"  class="form-control"  placeholder="Ngày sinh">
                </div>                  
                <div class="form-group col-sm-3 pt-3">
                    <label for="gioitinh">Giới tính</label>
                    <select id="gioitinh" name="gioitinh" class="form-select form-select-sm mb-3 col-sm-3" value="<?php echo $row['namsinh']; ?>">
                        <option value="Nam" <?php echo ($row['gioitinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                        <option value="Nữ" <?php echo ($row['gioitinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    </select>
                </div>                  
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" id="diachi" name="diachi" value="<?php echo $row['diachi']; ?>" class="form-control" placeholder="Nhập địa chỉ">
                </div>                  
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="sodienthoai">Số điện thoại</label>
                    <input type="text" id="sodienthoai" name="sodienthoai" value="<?php echo $row['sodienthoai']; ?>" class="form-control" placeholder="Nhập số điện thoại" >
                </div>
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="tendangnhap">Tên đăng nhập</label>
                    <input type="text" id="tendangnhap" name="tendangnhap" value="<?php echo $row['tendangnhap']; ?>" required class="form-control" id="tendangnhap" placeholder="Nhập tên đăng nhập">
                </div>                  
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="password" id="matkhau" name="matkhau" class="form-control" placeholder="Nhập mật khẩu" >
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right mt-3">
                        <button type="submit"  name="suanhanvien" class="btn btn-primary">Lưu thông tin</button>
                        <button type="submit"  name="huy" class="btn btn-dark">Hủy</button>
                    </div>
                </div>
                <?php
                } 
                ?>               
            </form>
        </div>                                 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>