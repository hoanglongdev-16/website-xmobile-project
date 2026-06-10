<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <link rel="shortcut icon" type="image/png" href="images/user-tie-solid.svg">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['admin_email'])){
            header('Location: admincp/index.php');  
        }
    ?>
    <?php
        if(isset($_GET["error"])){
            $error = $_GET["error"];
        } else{
            $error = "";
        }
        if($error == "1"){
            // Hiển thị thông báo lỗi nếu thông tin đăng nhập không đúng
            echo "<script>alert('Sai thông tin đăng nhập!');</script>";   
        }
    ?>
    <div class="login-container">
    <div class="login-box">
      <div class="admin-icon">
        <a href="../customers/index.php">
            <img src="images/user-tie-solid.svg" width="100px" height="100px" >
        </a>
      </div>
      <h2>Đăng nhập<br>Quản Trị Viên</h2>
    <form method="post" action="login_process.php">
        <label for="Name" style="float: left; color:rgb(230, 170, 31);">Tên: </label><br>
        <input type="Name" name="Name" id="Name" placeholder="Nhập tên của bạn" required><br>

        <label for="email" style="float: left; color: #fdbf2d;">Mật khẩu: </label><br>
        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu của bạn" required><br>

        <label for="email" style="float: left; color:rgb(230, 170, 31);">Email: </label><br>
        <input type="email" name="email" id="email" placeholder="Nhập email của bạn" required><br>
        <button><b>Đăng nhập</b></button>
    </form>
    <p class="note">Vui lòng nhập thông tin để truy cập hệ thống quản trị.</p>
    </div>
  </div>
</body>
</html>
