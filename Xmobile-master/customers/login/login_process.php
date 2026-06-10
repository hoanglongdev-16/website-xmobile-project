<?php
    session_start();
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Mở kết nối
    include_once "../../Connection/open.php";

    // Viết SQL để kiểm tra tất cả các trường
    $sql = "SELECT *, COUNT(Id) AS count_id FROM customers WHERE Name = '$name' AND Email = '$email' AND Password = '$password' ";
    
    // Chạy SQL
    $results = mysqli_query($connection, $sql);

    // Đóng kết nối
    include_once "../../Connection/close.php";

    // Kiểm tra xem thông tin đăng nhập có đúng hay không
    foreach ($results as $result) {
        if($result['count_id'] == 0){
            // Quay về trang login nếu sai thông tin
            header("Location: login.php?error=1"); 
        } else {
            // Lưu thông tin lên session
            $_SESSION['customer_id'] = $result['Id'];
            $_SESSION['customer_email'] = $result['Email'];
            //Quay về danh sách
            header("Location: ../index.php");
        }
    }
?>