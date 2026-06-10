<link rel="stylesheet" href="css/style_table.css">
<?php
// Mở kết nối
include_once "../../connection/open.php";

// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
        // Truy vấn chi tiết sản phẩm theo ID
        $sql_product = "SELECT products.*, 
        brands.Name AS BrandName,
        types.Name AS TypeName,
        images.Name AS ImageName,
        products.Name AS ProductName
    FROM products
    INNER JOIN brands ON products.Brand = brands.Id
    INNER JOIN types ON products.Type = types.Id
    INNER JOIN images ON images.Product_id = products.Id
    WHERE products.Id = $id AND products.Status = 1";
                    
    $products = mysqli_query($connection, $sql_product);
}

// Đóng kết nối
include_once "../../connection/close.php";
?>
 <div class="max-w-5xl mx-auto px-6 py-8 ">
    <h2 class="text-center text-[35px] text-[#333] font-bold mb-6">Chi tiết sản phẩm</h2>

    <?php foreach ($products as $product): ?>
    <h3 class="text-center text-2xl font-semibold text-gray-800 mb-4"><strong><?php echo $product['ProductName']; ?></strong></h3>

    <table class="w-full border-collapse text-[16px] mt-4 shadow-lg ">
        <tr class="bg-[#1d1919] text-[#ffc107] font-bold">
            <th class="border border-gray-300 px-4 py-3">Ảnh sản phẩm</th>
            <td class="border border-gray-300 bg-[#f9f9f9] px-4 py-3">
                <img src="images/<?php echo $product["ImageName"] ?>" alt="product image" style="width: 150px;">
            </td>
        </tr>
        <tr><th width="30%">Tên sản phẩm</th><td><?php echo $product['ProductName']; ?></td></tr>
        <tr><th>RAM</th><td><?php echo $product['Ram']; ?></td></tr>
        <tr><th>Chip</th><td><?php echo $product['Chip']; ?></td></tr>
        <tr><th>ROM</th><td><?php echo $product['Rom']; ?></td></tr>
        <tr><th>Sim</th><td><?php echo $product['Sim']; ?></td></tr>
        <tr><th>Mạng</th><td><?php echo $product['Mobile_Network']; ?></td></tr>
        <tr><th>Độ phân giải</th><td><?php echo $product['Resolution']; ?></td></tr>
        <tr><th>Kích thước màn hình</th><td><?php echo $product['Screen_size']; ?></td></tr>
        <tr><th>Camera</th><td><?php echo $product['Camera']; ?></td></tr>
        <tr><th>Hệ điều hành</th><td><?php echo $product['Operating_System']; ?></td></tr>
        <tr><th>Dung lượng pin</th><td><?php echo $product['Battery_Capacity']; ?></td></tr>
        <tr><th>Màu sắc</th><td><?php echo $product['Color']; ?></td></tr>
        <tr><th>Giá</th><td class="text-red-600 font-semibold"><?php echo number_format($product['Price'], 0, ',', '.'); ?>đ</td></tr>
        <tr><th>Thương hiệu</th><td><?php echo $product['BrandName']; ?></td></tr>
        <tr><th>Loại</th><td><?php echo $product['TypeName']; ?></td></tr>
        <tr><th>Mô tả</th><td><?php echo $product['Description']; ?></td></tr>
    </table><br>
    <center>
    <div class="flex justify-center gap-4 ">
        <a href="index.php?action=quanlysanpham">
            <button class="bg-[#ffc107] hover:bg-[#e0a800] text-[#121212] font-semibold px-6 py-2 rounded">Thoát</button>
        </a>
        <a href="index.php?action=suasanpham&id=<?php echo $product['Id']; ?>">
            <button class="bg-[#ffc107] hover:bg-[#e0a800] text-[#121212] font-semibold px-6 py-2 rounded">Chỉnh sửa</button>
        </a>
    </div>
    </center>
    <?php endforeach; ?>
</div>
