<?php
session_start();
include('admincp/config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = $_POST['matkhau'];

    $sql = "SELECT * FROM tbl_nhanvien WHERE tendangnhap = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "s", $tendangnhap);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($matkhau, $row['matkhau'])) {
            $_SESSION['id_nhanvien'] = $row['id_nhanvien'];
            $_SESSION['hoten'] = $row['hoten'];
            // Thông tin đăng nhập chính xác, chuyển hướng đến trang quản lý
            header('Location: index.php');
            exit;
        } else {
            echo "Sai mật khẩu. Vui lòng thử lại.";
        }
    } else {
        echo "Tài khoản không tồn tại. Vui lòng kiểm tra lại.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-primary text-center pt-5">Đăng nhập</h1>
        <div class="container mt-5 d-flex align-items-center justify-content-center">
                <form style="width:500px" action="login.php" autocomplete="off" method="POST">
     
                    <div class="form-outline mb-4">
                    <label class="form-label fs-4" for="tendangnhap">Tên tài khoản</label>
                    <input type="text" id="account" name="tendangnhap" class="form-control" />
                    </div>
                
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                    <label class="form-label fs-4" for="matkhau">Mật khẩu</label>
                    <input type="password" name="matkhau" id="matkhau" class="form-control" />
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
                    <button type="submit" value="Đăng nhập" class="btn btn-primary btn-block mb-4">Đăng nhập</button>
                </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
