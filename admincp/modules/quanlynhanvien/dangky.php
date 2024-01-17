<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="form-them-suanv.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">       
        <div class="panel-heading"> 
		    <h3 class="panel-title fs-1 text-primary">Thêm thông tin nhân viên</h3> 
        </div>
        <div class="panel-body">
            <form action="modules/quanlynhanvien/xuly.php" method="post" enctype='multipart/form-data' class="form-horizontal" role="form">
                <div class="form-group col-sm-6 control-label pt-3">
                    <label for="hoten">Họ và tên</label>
                    <input type="text" name="hoten" class="form-control" id="hoten" placeholder="Nhập họ tên" required>
                </div>                  
                <div class="form-group col-sm-3 control-label pt-3">
                    <label for="namsinh">Ngày sinh</label>
                    <input type="date" name="namsinh" class="form-control" id="namsinh" placeholder="Ngày sinh">
                </div>                  
                <div class="form-group col-sm-3 control-label pt-3">
                    <label for="gioitinh">Giới tính</label>
                    <select name="gioitinh" id="gioitinh" class="form-select form-select-sm mb-3 col-sm-3">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>                  
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" name="diachi" class="form-control" id="diachi" placeholder="Nhập địa chỉ">
                </div>                  
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="sodienthoai">Số điện thoại</label>
                    <input type="text" name="sodienthoai" class="form-control" id="sodienthoai" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="tendangnhap">Tên đăng nhập</label>
                    <input type="text" name="tendangnhap" class="form-control" id="tendangnhap" placeholder="Nhập tên đăng nhập" required>
                </div>                  
                <div class="form-group  col-sm-6 control-label pt-3">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="password" name="matkhau" class="form-control" id="matkhau" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right mt-3">
                        <button type="submit" id="submit" name="themnhanvien" class="btn btn-primary">Thêm</button>
                        <!-- <input type="submit" name="themnhanvien" value="Đăng ký"> -->
                    </div>
                </div>               
            </form>
        </div>                                 
    </div>
    <hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>