<link rel="stylesheet" href="css/style_create_edit.css">
<?php
    //Mở kết nối
    include_once "../../connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM customers";
    //Chạy sql
    $customers = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../connection/close.php";
?>

<h2>Thêm tài khoản</h2>
<form method="post" action="account_customers/store.php" enctype="multipart/form-data">
    <div class="form-grid">
        <div class="form-group">
                <label for="image">Ảnh đại diện: </label>
                <input type="file" name="image" id="image"><br>
        </div>
        <div class="form-group">
            <label for="Name">Tên Đăng Nhập:</label>
            <input type="text" name="Name" id="Name">
        </div>

        <div class="form-group">
            <label for="Phone">Số Điện Thoại:</label>
            <input type="text" name="Phone" id="Phone">
        </div>

        <div class="form-group">
            <label for="Address">Địa Chỉ:</label>
            <input type="text" name="Address" id="Address">
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

    <div class="form-buttons">
        <a href="index.php?action=quanlytaikhoankhachhang"><button type="button">Thoát</button></a>
        <button type="submit">Thêm tài khoản</button>
    </div>
</form>
