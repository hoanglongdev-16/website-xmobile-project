<?php
    // Lấy id
    $id = $_GET['id'];
    // Kết nối db
    include_once "../../connection/open.php";
    // Viết SQL để lấy dữ liệu phương thức thanh toán cần sửa
    $sql = "SELECT * FROM payment_method WHERE id = '$id'";
    $payment_methods = mysqli_query($connection, $sql);
    // Đóng kết nối
    include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_create_edit.css">

<h2>Cập nhật phương thức thanh toán</h2>
<form method="post" action="payment_methods/update.php">
    <?php
        foreach ($payment_methods as $payment_method) {
    ?>
        <label for="id">ID: &nbsp;</label>
        <input type="text" name="id" id="id" readonly value="<?php echo $payment_method['Id']; ?>"><br>

        <label for="name">Tên Phương Thức Thanh Toán: &nbsp;</label>
        <input type="text" name="name" id="name" value="<?php echo $payment_method['Name']; ?>"><br>
    <?php
        }
    ?>
    <br>
    <div>
        <a href="index.php?action=quanlyphuongthucthanhtoan"><button type="button">Thoát</button></a>
        <button type="submit">Cập nhật</button>
    </div>
</form>
