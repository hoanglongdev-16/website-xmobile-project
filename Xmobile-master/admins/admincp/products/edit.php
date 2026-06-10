<?php
    // Lấy id
    $id = $_GET['id'];
    // Kết nối db
    include_once "../../connection/open.php";
    // Lấy sản phẩm theo id
    $sql_product = "SELECT products.*, images.Name AS ImageName 
    FROM products 
    LEFT JOIN images ON products.Id = images.Product_id 
    WHERE products.Id = '$id'";
    $products = mysqli_query($connection, $sql_product);
    // Lấy toàn bộ thương hiệu
    $sql_brands = "SELECT * FROM brands";
    $brands = mysqli_query($connection, $sql_brands);
    // Lấy toàn bộ loại sản phẩm
    $sql_types = "SELECT * FROM types";
    $types = mysqli_query($connection, $sql_types);
    // Đóng kết nối
    include_once "../../connection/close.php";
?>
<link rel="stylesheet" href="css/style_create_edit.css">
<h2>Sửa Sản phẩm</h2>
<form method="post" action="products/update.php" enctype="multipart/form-data">
    <div class="form-grid">
    <?php foreach ($products as $product) { ?>
        <!-- ID -->
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" readonly value="<?php echo $product['Id']; ?>">
        </div>

        <!-- ID -->
        <div class="form-group">
            <label for="image">Ảnh sản phẩm: <img src="images/<?php echo $product["ImageName"]?> " style="width: 150px;">
            </label><input type="file" name="image" id="image">
        </div>

        <!-- Tên sản phẩm -->
        <div class="form-group">
            <label for="Name">Tên sản phẩm:</label>
            <input type="text" name="Name" id="Name" value="<?php echo $product['Name']; ?>">
        </div>

        <!-- Ram -->
        <div class="form-group">
            <label for="Ram">Ram:</label>
            <input type="text" name="Ram" id="Ram" value="<?php echo $product['Ram']; ?>">
        </div>

        <!-- Chip -->
        <div class="form-group">
            <label for="Chip">Chip:</label>
            <input type="text" name="Chip" id="Chip" value="<?php echo $product['Chip']; ?>">
        </div>

        <!-- Rom -->
        <div class="form-group">
            <label for="Rom">Rom:</label>
            <input type="text" name="Rom" id="Rom" value="<?php echo $product['Rom']; ?>">
        </div>

        <!-- Sim -->
        <div class="form-group">
            <label for="Sim">Khe cắm sim:</label>
            <input type="text" name="Sim" id="Sim" value="<?php echo $product['Sim']; ?>">
        </div>

        <!-- Mạng di động -->
        <div class="form-group">
            <label for="Mobile_Network">Mạng di động:</label>
            <input type="text" name="Mobile_Network" id="Mobile_Network" value="<?php echo $product['Mobile_Network']; ?>">
        </div>

        <!-- Độ phân giải -->
        <div class="form-group">
            <label for="Resolution">Độ phân giải:</label>
            <input type="text" name="Resolution" id="Resolution" value="<?php echo $product['Resolution']; ?>">
        </div>

        <!-- Kích thước màn hình -->
        <div class="form-group">
            <label for="Screen_size">Kích thước màn hình:</label>
            <input type="text" name="Screen_size" id="Screen_size" value="<?php echo $product['Screen_size']; ?>">
        </div>

        <!-- Camera -->
        <div class="form-group">
            <label for="Camera">Camera:</label>
            <input type="text" name="Camera" id="Camera" value="<?php echo $product['Camera']; ?>">
        </div>

        <!-- Hệ điều hành -->
        <div class="form-group">
            <label for="Operating_System">Hệ điều hành:</label>
            <input type="text" name="Operating_System" id="Operating_System" value="<?php echo $product['Operating_System']; ?>">
        </div>

        <!-- Dung lượng pin -->
        <div class="form-group">
            <label for="Battery_Capacity">Dung lượng pin:</label>
            <input type="text" name="Battery_Capacity" id="Battery_Capacity" value="<?php echo $product['Battery_Capacity']; ?>">
        </div>

        <!-- Màu sắc -->
        <div class="form-group">
            <label for="Color">Màu sắc:</label>
            <input type="text" name="Color" id="Color" value="<?php echo $product['Color']; ?>">
        </div>

        <!-- Giá -->
        <div class="form-group">
            <label for="Price">Giá:</label>
            <input type="text" name="Price" id="Price" value="<?php echo $product['Price']; ?>">
        </div>

        <!-- Thương hiệu -->
        <div class="form-group">
            <label for="Brand">Thương hiệu:</label>
            <select id="Brand" name="Brand">
                <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand['Id']; ?>" 
                        <?php if ($brand['Id'] == $product['Brand']) echo 'selected="selected"'; ?>>
                        <?php echo $brand['Name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Loại sản phẩm -->
        <div class="form-group">
            <label for="Type">Loại sản phẩm:</label>
            <select id="Type" name="Type">
                <?php foreach ($types as $type) { ?>
                    <option value="<?php echo $type['Id']; ?>" 
                        <?php if ($type['Id'] == $product['Type']) echo 'selected="selected"'; ?>>
                        <?php echo $type['Name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
<!-- Trạng thái sản phẩm -->
<div class="form-group">
    <label for="Status">Trạng thái:</label>
    <select id="Status" name="Status">
        <option value="1" <?php if (isset($product['Status']) && $product['Status'] == 1) echo 'selected'; ?>>
          Hiển thị
        </option>
        <option value="0" <?php if (isset($product['Status']) && $product['Status'] == 0) echo 'selected'; ?>>
          Ẩn
        </option>
    </select>
</div>
        <!-- Mô tả -->
        <div class="form-group" style="grid-column: span 2;">
            <label for="Description">Mô tả:</label>
            <textarea name="Description" id="Description" rows="5" cols="50"><?php echo htmlspecialchars($product['Description']); ?></textarea>
        </div>
    <?php } ?>
    </div>

    <!-- Buttons -->
    <div class="form-buttons" style="margin-top: 20px;">
        <a href="index.php?action=quanlysanpham"><button type="button">Thoát</button></a>
        <button type="submit">Cập nhật</button>
    </div>
</form>
