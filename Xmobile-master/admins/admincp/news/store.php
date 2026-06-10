<?php
    // Lấy dữ liệu trong form
    $images = $_FILES["image"]["name"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Mở kết nối
    include_once "../../../Connection/open.php";

    // Viết SQL thêm bài viết
    $sql_news = "INSERT INTO news (Title, Content) VALUES ('$title', '$content')";
    mysqli_query($connection, $sql_news);

    // Lấy ID của bài viết vừa thêm
    $news_id = mysqli_insert_id($connection);

    // Viết SQL thêm ảnh, sử dụng đúng cột Product_id như ràng buộc
    $sql_images = "INSERT INTO images_news (Name, News_id) VALUES ('$images', '$news_id')";
    mysqli_query($connection, $sql_images);

    // Đóng kết nối
    include_once "../../../Connection/close.php";

    // Kiểm tra nếu ảnh hợp lệ và chưa tồn tại, thì lưu file vào thư mục
    if ($_FILES["image"]["error"] == 0 && !file_exists("../images/" . $images)) {
        $path = $_FILES["image"]["tmp_name"];
        move_uploaded_file($path, "../images/" . $images);
    }

    // Quay về danh sách
    header("location: ../index.php?action=quanlybaiviet");
?>
