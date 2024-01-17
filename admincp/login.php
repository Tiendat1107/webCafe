<?php
    session_start();
    include('config/config.php');
    
    $error = ''; // Biến để lưu thông báo lỗi

    if(isset($_POST['dangnhap'])){
        $taikhoan = $_POST['username'];
        $matkhau = md5($_POST['password']);
        
        $sql = "SELECT * FROM tbl_admin WHERE username= ? AND password= ? LIMIT 1";
        $stmt = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $taikhoan, $matkhau);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $count = mysqli_num_rows($result);
        
        if($count > 0){
            $_SESSION['dangnhap'] = $taikhoan;
            header("Location:index.php"); 
        }else{
            $error = 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại.';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
      <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-primary text-center pt-5">Đăng nhập Admin</h1>
        <div class="container mt-5 d-flex align-items-center justify-content-center">
                <form style="width:500px" action="" autocomplete="off" method="POST">
                    <!-- Email input -->
					<?php if(!empty($error)): ?>
                    <tr>
                        <td colspan="2" style="color: red;"><?php echo $error; ?></td>
                    </tr>
					<?php endif; ?>
                    <div class="form-outline mb-4">
                    <label class="form-label fs-4" for="accouunt">Tên tài khoản</label>
                    <input type="text" id="account" name="username" class="form-control" />
                    </div>
                
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                    <label class="form-label fs-4" for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control" />
                    </div>
                
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="remember" checked />
                        <label class="form-check-label" for="remember"> Ghi nhớ tôi </label>
                        </div>
                    </div>

                     <!-- Submit button -->
                    <button type="submit" name="dangnhap" value="Đăng nhập" class="btn btn-primary btn-block mb-4">Đăng nhập</button>
                </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </body>
</html>
