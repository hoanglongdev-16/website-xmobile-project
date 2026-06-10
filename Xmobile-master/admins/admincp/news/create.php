<link rel="stylesheet" href="css/style_create_edit.css">

<?php
    //Mở kết nối
    include_once "../../connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM news";
    //Chạy sql
    $brands = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../connection/close.php";
?>

<h2>Thêm bài viết</h2>
<form method="post" action="news/store.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="image">Image: </label>
        <input type="file" name="image" id="image"><br>
    </div>
    <div class="form-group">
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" id="title">
    </div>
    <div class="form-group">
        <label for="content">Nội dung:</label>
        <textarea type="text" name="content" id="Description" rows="5" cols="20"></textarea><br>
    </div>

    <div class="form-buttons">
        <a href="index.php?action=quanlybaiviet"><button type="button">Thoát</button></a>
        <button type="submit">Thêm bài viết</button>
    </div>
</form>
