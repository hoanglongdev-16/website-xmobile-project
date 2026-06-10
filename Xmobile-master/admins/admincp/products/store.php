<?php
// Mở kết nối
include_once "../../../connection/open.php";

// Lấy dữ liệu từ form
$images = $_FILES["image"]["name"];
$name = $_POST["Name"];
$ram = $_POST["Ram"];
$chip = $_POST["Chip"];
$rom = $_POST["Rom"];
$sim = $_POST["Sim"];
$mobile_network = $_POST["Mobile_Network"];
$resolution = $_POST["Resolution"];
$screen_size = $_POST["Screen_size"];
$camera = $_POST["Camera"];
$operating_system = $_POST["Operating_System"];
$battery_capacity = $_POST["Battery_Capacity"];
$color = $_POST["Color"];
$price = $_POST["Price"];
$brand = $_POST["Brand"];
$type = $_POST["Type"];
$Description = $_POST["Description"];
$Status = $_POST['Status'];
// Viết SQL products
$sql_products = "INSERT INTO products (
    Name, Ram, Chip, Rom, Sim, Mobile_Network, Resolution, Screen_size,
    Camera, Operating_System, Battery_Capacity, Color, Price, Brand, Type,
    Description, Status
) 
VALUES (
    '$name', '$ram', '$chip', '$rom', '$sim', '$mobile_network',
    '$resolution', '$screen_size', '$camera', '$operating_system',
    '$battery_capacity', '$color', '$price', '$brand', '$type',
    '$Description', '$Status'
)";
// Chạy SQL sản phẩm
mysqli_query($connection, $sql_products);

// Lấy ID sản phẩm vừa thêm
$product_id = mysqli_insert_id($connection);

// Viết SQL images (gắn với Product_id)
$sql_images = "INSERT INTO images (Name, Product_id) VALUES ('$images', '$product_id')";

// Chạy SQL ảnh
mysqli_query($connection, $sql_images);

// Đóng kết nối
include_once "../../../connection/close.php";

// Kiểm tra nếu ảnh hợp lệ và chưa có trong thư mục thì lưu
if ($_FILES["image"]["error"] == 0 && !file_exists("../images/" . $images)) {
    $path = $_FILES["image"]["tmp_name"];
    move_uploaded_file($path, "../images/" . $images);
}

// Quay lại danh sách sản phẩm
header("Location: ../index.php?action=quanlysanpham");
?>
