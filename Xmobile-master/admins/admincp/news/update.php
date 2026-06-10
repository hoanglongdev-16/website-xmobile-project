<?php
    // Lấy dữ liệu từ form
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_FILES["image"]["name"];

    // Mở kết nối
    include_once "../../../Connection/open.php";

    // Cập nhật nội dung bài viết
    $sql_update_news = "UPDATE news SET Title='$title', Content='$content' WHERE Id='$id'";
    mysqli_query($connection, $sql_update_news);

    // Nếu có ảnh mới thì cập nhật ảnh
    if ($_FILES["image"]["error"] == 0) {
        // Xử lý upload file
        $path = $_FILES["image"]["tmp_name"];
        move_uploaded_file($path, "../images/" . $image);

        // Kiểm tra xem bài viết đã có ảnh hay chưa
        $check_img_sql = "SELECT * FROM images_news WHERE News_id = '$id'";
        $img_result = mysqli_query($connection, $check_img_sql);

        if (mysqli_num_rows($img_result) > 0) {
            // Cập nhật ảnh nếu đã có
            $sql_update_img = "UPDATE images_news SET Name='$image' WHERE News_id='$id'";
        } else {
            // Thêm mới nếu chưa có ảnh
            $sql_update_img = "INSERT INTO images_news (Name, News_id) VALUES ('$image', '$id')";
        }

        mysqli_query($connection, $sql_update_img);
    }

    // Đóng kết nối
    include_once "../../../Connection/close.php";

    // Quay về danh sách bài viết
    header("Location: ../index.php?action=quanlybaiviet");
?>
