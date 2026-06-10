<?php
    // Mở kết nối
    include_once "../../../Connection/open.php";
    
    // Lấy id
    $id = $_GET['id'];
    
    // Xóa các ảnh liên quan trong bảng images
    $sql_images = "DELETE FROM images_news WHERE news_id = '$id'";
    mysqli_query($connection, $sql_images);
    
    // Xóa bài viết
    $sql_news = "DELETE FROM news WHERE id = '$id'";
    $result_news = mysqli_query($connection, $sql_news);
    
    // Đóng kết nối
    include_once "../../../Connection/close.php";
    
    // Quay lại danh sách sản phẩm
    header("Location: ../index.php?action=quanlybaiviet");
?>
