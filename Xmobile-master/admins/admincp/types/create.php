<?php
    // Mở kết nối
    include_once "../../connection/open.php";
    // Viết SQL
    $sql = "SELECT * FROM types";
    // Chạy SQL
    $types = mysqli_query($connection, $sql);
    // Đóng kết nối
    include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_create_edit.css">

<h2>Thêm loại sản phẩm</h2>
<form method="post" action="types/store.php">
    <label for="name">Tên Loại Sản Phẩm: &nbsp;</label>
    <input type="text" name="name" id="name"><br><br>

    <div class="form-buttons">
        <a href="index.php?action=quanlyphanloaisp"><button type="button">Thoát</button></a>
        <button type="submit">Thêm loại sản phẩm</button>
    </div>
</form>
