<?php
    // Lấy dữ liệu trong form
    $images = $_FILES["image"]["name"];
    $name = $_POST["Name"];
    $phone = $_POST["Phone"];
    $address = $_POST["Address"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];

    // Mở kết nối
    include_once "../../../Connection/open.php";

    // Kiểm tra xem email đã tồn tại chưa
    $checkEmail = "SELECT *, COUNT(Id) AS count_id FROM customers WHERE Email = '$email' ";
    $results = mysqli_query($connection, $checkEmail);
    foreach ($results as $result) {
        if ($result['count_id'] == 0) {
            // Viết sql để thêm mới
            $sql = "INSERT INTO customers (Name, Phone, Address, Email, Password, Images) 
                    VALUES ('$name', '$phone', '$address', '$email', '$password', '$images')";
            // Chạy sql
            mysqli_query($connection, $sql);
            // Kiểm tra nếu ảnh hợp lệ và chưa có trong thư mục thì lưu
            if ($_FILES["image"]["error"] == 0 && !file_exists("../images/" . $images)) {
                $path = $_FILES["image"]["tmp_name"];
                move_uploaded_file($path, "../images/" . $images);
            }
            // Quay về danh sách
            header("location: ../index.php?action=quanlytaikhoankhachhang");
        } else {
            // Email đã tồn tại
            echo "<script>
                alert('Email đã tồn tại! Vui lòng sử dụng email khác!');
                window.location.href = '../index.php?action=quanlytaikhoankhachhang';
            </script>";      
        }
    }

    // Đóng kết nối
    include_once "../../../Connection/close.php";
?>
