<link rel="stylesheet" href="css/style_create_edit.css">

<?php
    //Lấy id
    $id = $_GET['id'];
    //Kết nối db
    include_once(__DIR__ . "/../../../connection/open.php");
    //Viết sql
    $sql = "SELECT * FROM admin WHERE id = '$id'";
    //Chạy sql
    $admins = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once(__DIR__ . "/../../../connection/close.php");
?>

<h2>Sửa tài khoản</h2>
<form method="post" action="account_admin/update.php">
    <div class="form-grid">
        <?php foreach ($admins as $admin) { ?>
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" readonly value="<?php echo $admin['Id']; ?>">
            </div>
            <div class="form-group">
                <label for="Name">Tên Đăng Nhập:</label>
                <input type="text" name="Name" id="Name" value="<?php echo $admin['Name']; ?>">
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="text" name="Email" id="Email" readonly value="<?php echo $admin['Email']; ?>">
            </div>
            <div class="form-group">
                <label for="Password">Mật Khẩu:</label>
                <input type="password" name="Password" id="Password" value="<?php echo $admin['Password']; ?>">
            </div>
        <?php } ?>
    </div>

    <div class="form-buttons">
        <a href="index.php?action=quanlytaikhoanadmin"><button type="button">Thoát</button></a>
        <button type="submit">Cập nhật</button>
    </div>
</form>
