  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị Viên</title>
    <link rel="shortcut icon" type="image/png" href="../images/user-tie-solid.svg">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style_admin.css">
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<?php 
      //kiểm tra xem đã đăng nhập chưa
      session_start();
      if(empty($_SESSION['admin_email'])){
          header('Location: ../index.php');;
      }
      //menu dọc
        include_once "pages/sidebar.php";
      ?>
      <div id="content" class="p-4 p-md-5">
        <?php 
          include_once "pages/navbar.php";
          //main content
          include_once "pages/main.php";
        ?>
      </div>
	</div>   
  </body>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  </html>