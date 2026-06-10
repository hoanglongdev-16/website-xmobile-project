<?php
    //Mở kết nối
    include_once(__DIR__ . "/../../../connection/open.php");
    //Viết sql
    $sql = "SELECT * FROM admin";
    //Chạy sql
    $admins = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once(__DIR__ . "/../../../connection/close.php");
?>

<link rel="stylesheet" href="css/style_create_edit.css">

<h2>Thêm tài khoản</h2>

<form method="post" action="account_admin/store.php">
    <div class="form-grid">
        <div class="form-group">
            <label for="Name">Tên Đăng Nhập:</label>
            <input type="text" name="Name" id="Name">
        </div>
        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="text" name="Email" id="Email">
        </div>
        <div class="form-group">
            <label for="Password">Mật Khẩu:</label>
            <input type="password" name="Password" id="Password">
        </div>
    </div>

    <br>
    <div class="form-buttons">
        <a href="index.php?action=quanlytaikhoanadmin"><button type="button">Thoát</button></a>
        <button type="submit">Thêm tài khoản</button>
    </div>
</form>
