<?php
    session_start();
    //Lấy email, pwd từ form
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //Mở kết nối
    include_once "../Connection/open.php";
    //Viết sql
    $sql = "SELECT *, COUNT(Id) AS count_id FROM admin WHERE Name = '$name' AND Email = '$email' AND Password = '$password'";
    //Chạy sql
    $results = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../Connection/close.php";
    //Kiểm tra xem email, pwd có đúng hay không
    foreach ($results as $result) {
        if($result['count_id'] == 0){
            //Quay về trang login
            header("Location: index.php?error=1"); 
        } else{
            //Lưu account lên session
            $_SESSION['admin_id'] = $result['Id'];
            $_SESSION['admin_email'] = $result['Email'];
            $_SESSION['admin_name'] = $result['Name'];
            //Quay về danh sách
            header("Location: admincp/index.php");
        }
    }
?>