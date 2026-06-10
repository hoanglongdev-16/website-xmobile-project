 <link rel="stylesheet" href="css/style_customers.css">
<?php
        //lấy id khách hàng
        $id = $_GET['id'];
        //mở kết nối
        include_once "../../Connection/open.php";
        //truy vấn dữ liệu khách hàng theo id
        $sql = "SELECT * FROM customers WHERE Id = '$id'";
        //chạy query
        $result = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../../Connection/close.php";
    ?>

    <div class="container">
        <h2 class="title">Chi tiết tài khoản khách hàng</h2>

        <?php 
            foreach ($result as $customer) { 
        ?>
            <div class="avatar">
                <?php 
                    //nếu khách hàng không có ảnh đại diện thì hiển thị ảnh mặc định
                    if($customer["Images"] == NULL){
                ?>
                    <img src="../../customers/images/header/avatar.webp">
                <?php } else { ?>
                    <img src="images/<?php echo $customer['Images']; ?>">
                <?php } ?>
                <p class="name"><?php echo $customer['Name']; ?></p>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <label>ID:</label>
                    <p><?php echo $customer['Id']; ?></p>
                </div>
                <div class="info-item">
                    <label>Số điện thoại:</label>
                    <p><?php echo $customer['Phone']; ?></p>
                </div>
                <div class="info-item">
                    <label>Địa chỉ:</label>
                    <p><?php echo $customer['Address']; ?></p>
                </div>
                <div class="info-item">
                    <label>Email:</label>
                    <p><?php echo $customer['Email']; ?></p>
                </div>
            </div>

            <div class="actions">
                <a href="index.php?action=quanlytaikhoankhachhang">
                    <button class="btn back">Quay lại</button>
                </a>
                <a href="index.php?action=suataikhoankhachhang&id=<?php echo $customer['Id']; ?>">
                    <button class="btn edit">Chỉnh sửa</button>
                </a>
            </div>
        <?php 
            } 
        ?>
    </div>