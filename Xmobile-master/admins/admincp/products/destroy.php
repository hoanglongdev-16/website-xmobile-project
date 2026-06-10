<?php
    // Mở kết nối
    include_once "../../../Connection/open.php";
    
    // Lấy id từ URL
    $id = $_GET['id'];
    
    // Xóa các ảnh liên quan trong bảng images
    $sql_images_delete = "DELETE FROM images WHERE Product_id = '$id'";
    mysqli_query($connection, $sql_images_delete);
    
    // Xóa sản phẩm
    $sql_products = "DELETE FROM products WHERE id = '$id'";
    $result_products = mysqli_query($connection, $sql_products);
    
    // Đóng kết nối
    include_once "../../../Connection/close.php";
    
    // Quay lại danh sách sản phẩm
    header("Location: ../index.php?action=quanlysanpham");
?>
