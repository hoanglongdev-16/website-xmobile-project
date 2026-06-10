<link rel="stylesheet" href="css/style_create_edit.css">
<?php
    //Lấy id
    $id = $_GET['id'];
    //Kết nối db
    include_once "../../Connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM customers WHERE id = '$id'";
    //Chạy sql
    $customers = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../Connection/close.php";
?>

<h2>Sửa tài khoản</h2>
<form method="post" action="account_customers/update.php" enctype="multipart/form-data">
    <div class="form-grid">
        <?php foreach ($customers as $customer) { ?>
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" readonly value="<?php echo $customer['Id']; ?>">
            </div>
            <div class="form-group">
                <label for="image">Ảnh đại diện: 
                    <?php 
                        //nếu khách hàng không có ảnh đại diện thì hiển thị ảnh mặc định
                        if($customer["Images"] == NULL){
                    ?>
                        <img src="../../customers/images/header/avatar.webp" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    <?php } else { ?>
                        <img src="images/<?php echo $customer["Images"]?> " style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    <?php } ?>
                </label><input type="file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="Name">Tên Đăng Nhập:</label>
                <input type="text" name="Name" id="Name" value="<?php echo $customer['Name']; ?>">
            </div>
            <div class="form-group">
                <label for="Phone">Số Điện Thoại:</label>
                <input type="text" name="Phone" id="Phone" value="<?php echo $customer['Phone']; ?>">
            </div>
            <div class="form-group">
                <label for="Address">Địa Chỉ:</label>
                <input type="text" name="Address" id="Address" value="<?php echo $customer['Address']; ?>">
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="text" name="Email" id="Email" readonly value="<?php echo $customer['Email']; ?>">
            </div>
            <div class="form-group">
                <label for="Password">Mật Khẩu:</label>
                <input type="text" name="Password" id="Password" value="<?php echo $customer['Password']; ?>">
            </div>
        <?php } ?>
    </div>

    <div class="form-buttons">
        <a href="index.php?action=quanlytaikhoankhachhang"><button type="button">Thoát</button></a>
        <button type="submit">Cập nhật</button>
    </div>
</form>
