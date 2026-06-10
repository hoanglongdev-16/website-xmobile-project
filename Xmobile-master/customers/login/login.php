<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link rel="shortcut icon" type="image/png" href="../images/header/logo.png">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>

<?php
    session_start();

    if(isset($_SESSION['customer_email'])){
        header('Location: ../index.php');
    }

    if(isset($_GET["error"])){
        $error = $_GET["error"];

        if($error == "1"){
            echo "<script>alert('Sai thông tin đăng nhập!');</script>";
        }
    }
?>

<div class="container">
    <div class="login-image">
       <img src="images/logo.png" alt="Logo">
    </div>
    <h2>Đăng Nhập</h2>

    <form method="post" action="login_process.php">

        <div class="input-group">
            <label>TÊN</label>

            <i class="fas fa-user"></i>

            <input type="text"
                   name="name"
                   placeholder="Nhập tên của bạn"
                   required>
        </div>

        <div class="input-group">

            <label>MẬT KHẨU</label>

            <i class="fas fa-lock"></i>

            <input type="password"
                   name="password"
                   placeholder="Nhập mật khẩu"
                   required>
        </div>

        <div class="input-group">

            <label>EMAIL</label>

            <i class="fa-solid fa-envelope"></i>

            <input type="email"
                   name="email"
                   placeholder="Nhập email của bạn"
                   required>
        </div>

        <button type="submit" class="signup-btn">
            ĐĂNG NHẬP
        </button>

        <div class="login-link">
            Chưa có tài khoản?
            <a href="register.php">Đăng ký</a>
        </div>

    </form>

</div>

</body>
</html>