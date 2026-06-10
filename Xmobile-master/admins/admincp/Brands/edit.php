<link rel="stylesheet" href="css/style_create_edit.css">

<?php
    //Lấy id
    $id = $_GET['id'];
    //Kết nối db
    include_once "../../Connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM brands WHERE id = '$id'";
    //Chạy sql
    $brands = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../Connection/close.php";
?>

<h2>Sửa thương hiệu</h2>
<form method="post" action="Brands/update.php">
    <?php foreach ($brands as $brand) { ?>
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" readonly value="<?php echo $brand['Id']; ?>">
        </div>
        <div class="form-group">
            <label for="name">Tên Thương Hiệu:</label>
            <input type="text" name="name" id="name" value="<?php echo $brand['Name']; ?>">
        </div>
    <?php } ?>

    <div class="form-buttons">
        <a href="index.php?action=quanlythuonghieu"><button type="button">Thoát</button></a>
        <button type="submit">Cập nhật</button>
    </div>
</form>
