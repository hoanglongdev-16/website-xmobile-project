<?php
// Mở kết nối
include_once "../../connection/open.php";

// Lấy danh sách brands, types để hiển thị trong form
$sql_brands = "SELECT * FROM brands";
$sql_types = "SELECT * FROM types";
$sql_images = "SELECT * FROM images";

$brands = mysqli_query($connection, $sql_brands);
$types = mysqli_query($connection, $sql_types);

// Đóng kết nối
include_once "../../connection/close.php";
?>
<link rel="stylesheet" href="css/style_create_edit.css">

    <h2>Thêm sản phẩm</h2>
    <form method="post" action="products/store.php" enctype="multipart/form-data">
        <div class="form-grid">
            <div class="form-group">
                <label for="image">Ảnh sản phẩm: </label>
                <input type="file" name="image" id="image"><br>
            </div>
            <div class="form-group">
                <label for="Name">Tên sản phẩm:</label>
                <input type="text" name="Name" id="Name">
            </div>
            <div class="form-group">
                <label for="Price">Giá:</label>
                <input type="text" name="Price" id="Price">
            </div>
            
            <div class="form-group">
                <label for="Color">Màu sắc:</label>
                <input type="text" name="Color" id="Color">
            </div>
            <div class="form-group">
                <label for="Ram">Ram:</label>
                <input type="text" name="Ram" id="Ram">
            </div>
            <div class="form-group">
                <label for="Chip">Chip:</label>
                <input type="text" name="Chip" id="Chip">
            </div>
            <div class="form-group">
                <label for="Rom">Rom:</label>
                <input type="text" name="Rom" id="Rom">
            </div>
            <div class="form-group">
                <label for="Sim">Khe cắm sim:</label>
                <input type="text" name="Sim" id="Sim">
            </div>
            <div class="form-group">
                <label for="Mobile_Network">Mạng di động:</label>
                <input type="text" name="Mobile_Network" id="Mobile_Network">
            </div>
            <div class="form-group">
                <label for="Resolution">Độ phân giải:</label>
                <input type="text" name="Resolution" id="Resolution">
            </div>
            <div class="form-group">
                <label for="Screen_size">Kích thước màn hình:</label>
                <input type="text" name="Screen_size" id="Screen_size">
            </div>
            <div class="form-group">
                <label for="Camera">Camera:</label>
                <input type="text" name="Camera" id="Camera">
            </div>
            <div class="form-group">
                <label for="Operating_System">Hệ điều hành:</label>
                <input type="text" name="Operating_System" id="Operating_System">
            </div>
            <div class="form-group">
                <label for="Battery_Capacity">Dung lượng pin:</label>
                <input type="text" name="Battery_Capacity" id="Battery_Capacity">
            </div>
            <div class="form-group">
                <label for="Brand">Thương hiệu:</label>
                <select id="Brand" name="Brand">
                    <?php
                        foreach ($brands as $brand) {
                    ?>
                        <option value="<?php echo $brand["Id"]; ?>">
                            <?php echo $brand["Name"]; ?>
                        </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Type">Loại:</label>
                <select id="Type" name="Type">
                    <?php
                        foreach ($types as $type) {
                    ?>
                        <option value="<?php echo $type["Id"]; ?>">
                            <?php echo $type["Name"]; ?>
                        </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
    <label for="Status">Trạng thái:</label>
    <select id="Status" name="Status">
        <option value="1">Hiển thị</option>
        <option value="0">Ẩn</option>
    </select>
</div>
            <div class="form-group" style="grid-column: span 2;">
                <label for="Description">Mô tả:</label>
                <textarea type="text" name="Description" id="Description" rows="5" cols="50"></textarea><br>
            </div>
        </div>
        <div class="form-buttons">
            <a href="index.php?action=quanlysanpham"><button type="button">Thoát</button></a>
            <button type="submit">Thêm sản phẩm</button>
        </div>
    </form>