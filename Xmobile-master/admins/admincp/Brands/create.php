<link rel="stylesheet" href="css/style_create_edit.css">

<?php
    //Mở kết nối
    include_once "../../connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM brands";
    //Chạy sql
    $brands = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../connection/close.php";
?>

<h2>Thêm thương hiệu</h2>
<form method="post" action="Brands/store.php">
    <div class="form-group">
        <label for="name">Tên Thương Hiệu:</label>
        <input type="text" name="name" id="name">
    </div>

    <div class="form-buttons">
        <a href="index.php?action=quanlythuonghieu"><button type="button">Thoát</button></a>
        <button type="submit">Thêm thương hiệu</button>
    </div>
</form>
