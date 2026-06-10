<?php
  //mở kết nối
  include_once "../connection/open.php";

  // Số sản phẩm mỗi trang
  $recordsPerPage = 30;

  // Đếm tổng số sản phẩm khớp
  $sqlCount = "SELECT COUNT(DISTINCT products.Id) AS total
             FROM products
             INNER JOIN brands ON products.Brand = brands.Id
             INNER JOIN types ON products.Type = types.Id
             INNER JOIN images ON images.Product_id = products.Id
             WHERE types.Name = 'Phụ kiện'";
  $countResult = mysqli_query($connection, $sqlCount);
  $row = mysqli_fetch_assoc($countResult);
  $totalRecords = $row['total'];

  // Tính tổng số trang
  $pages = ceil($totalRecords / $recordsPerPage);

  // Lấy trang hiện tại
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
  $start = ($page - 1) * $recordsPerPage;

  // Truy vấn sản phẩm kèm ảnh, loại, hãng
  $sql = "SELECT products.*, 
              brands.Name AS BrandName,
              types.Name AS TypeName,
              images.Name AS ImageName,
              products.Name AS ProductName
          FROM products
          INNER JOIN brands ON products.Brand = brands.Id
          INNER JOIN types ON products.Type = types.Id
          INNER JOIN images ON images.Product_id = products.Id
          WHERE types.Name = 'Máy tính bảng'
          GROUP BY products.Id
          ORDER BY products.Id DESC
          LIMIT $start, $recordsPerPage";
  //chạy query
  $product_image = mysqli_query($connection, $sql);
  //đóng kết nối
  include_once "../connection/close.php";
?>
<style>
  .slide {
    display: none;
  }
  .slide.active {
    display: block;
  }
</style>
<div class="mt-5 max-w-[1200px] mx-auto px-4">
    <nav class="text-2x1 text-gray-600 mb-4" data-aos="fade-right">
        <ol class="list-reset flex items-center space-x-2">
            <li>
                <a href="index.php" class="text-blue-700 hover:underline font-medium">Trang Chủ</a>
            </li>
            <li>
                <span class="text-gray-400">›</span>
            </li>
            <li>
                <a href="index.php?action=maytinhbang" class="text-blue-700 hover:underline font-medium">Máy Tính Bảng</a>
            </li>
        </ol>
    </nav>
    
  <div class="border-l-2 border-l-red-500 border-r-2 border-r-red-500 mr-[38%] ml-[38%] mb-[20px] p-2" data-aos="zoom-in">
    <h1 class="text-center text-4xl font-semibold text-black">Máy Tính Bảng</h1>
  </div>
  <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6" data-aos="zoom-in">
    <?php foreach ($product_image as $product) { ?>
      <div class="bg-white rounded-2xl shadow-md overflow-hidden transition-transform hover:scale-[1.03] duration-300">
        <a href="index.php?action=chitietsanpham&id=<?php echo $product['Id']; ?>" class="block">
          <img src="../admins/admincp/images/<?php echo $product["ImageName"]; ?>"
               alt="<?php echo $product['ProductName']; ?>"
               class="w-full h-48 object-contain bg-gray-50" />
        </a>
        <div class="p-4 text-center">
          <div class="text-yellow-400 text-sm mb-1">★★★★★ <span class="text-gray-500">(4 đánh giá)</span></div>
          <a href="index.php?action=chitietsanpham&id=<?php echo $product['Id']; ?>">
            <h3 class="text-gray-800 font-semibold text-base mb-2 hover:text-blue-600 h-[48px] leading-tight">
              <?php echo $product['ProductName']; ?>
            </h3>
          </a>
          <div class="text-red-600 font-bold text-lg">
            <?php echo number_format($product['Price'], 0, ',', '.') . ' đ'; ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- Phân trang -->
    <div style="margin-bottom: 20px; margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $pages; $i++) {
            $link = "index.php?action=maytinhbang&page=$i";
            if (!empty($keyword)) {
                $link .= "&keyword=" . urlencode($keyword);
            }
        ?>
            <a href="<?php echo $link; ?>"
               style="margin: 0 5px; padding: 5px 10px; text-decoration: none;
                      <?php echo ($i == $page) ? 'background-color: black; color: white;' : 'border: 1px solid #ccc;' ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>