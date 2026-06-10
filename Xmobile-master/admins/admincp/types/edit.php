<?php
    //Lấy id
    $id = $_GET['id'];
    //Kết nối db
    include_once "../../connection/open.php";
    //Viết sql
    $sql = "SELECT * FROM types WHERE id = '$id'";
    //Chạy sql
    $types = mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../../connection/close.php";
    //Hiển thị dữ liệu lấy được
?>
<link rel="stylesheet" href="css/style_create_edit.css">

    <h2>Sửa loại sản phẩm</h2>
    <form method="post" action="types/update.php">
        <?php
            foreach ($types as $type) {
        ?>
            <label for="id">ID: &nbsp;</label>
            <input type="text" name="id" id="id" readonly value="<?php echo $type['Id']; ?>"><br>
            
            <label for="name">Tên Loại Sản Phẩm: &nbsp;</label>
            <input type="text" name="name" id="name" value="<?php echo $type['Name']; ?>"><br>
        <?php
            }
        ?>
        <br>
        <div>
            <a href="index.php?action=quanlyphanloaisp"><button type="button">Thoát</button></a>
            <button type="submit">Cập nhật</button>
        </div>
    </form>