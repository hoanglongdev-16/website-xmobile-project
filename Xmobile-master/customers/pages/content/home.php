  <style>
  .slide {
    display: none;
  }
  .slide.active {
    display: block;
  }
  .hidden {
    display: none;
  }
  .container button {
    color: gray; 
    transition: color 0.3s ease, border-bottom 0.3s ease;
    background: none;
    border: none;
    padding: 0; 
    font-size: inherit; 
  }
  .container button.active {
    color: black; 
    border-bottom: 2px solid #007bff; 
  }
  .content-section {
    display: none;
  }
</style>

<body class="bg-gray-100">
<?php
// mở kết nối
include_once "../connection/open.php"; 

//truy vấn sql
$sql_product_image = "SELECT products.*, 
    brands.Name AS BrandName,
    types.Name AS TypeName,
    images.Name AS ImageName,
    products.Name AS ProductName
FROM products
INNER JOIN brands ON products.Brand = brands.Id
INNER JOIN types ON products.Type = types.Id
INNER JOIN images ON images.Product_id = products.Id
ORDER BY Products.Id DESC;";

//chạy query
$product_image_result = mysqli_query($connection, $sql_product_image);

// Tách dữ liệu
$products_data = [];
while ($row_product = mysqli_fetch_assoc($product_image_result)) {
    $products_data[] = $row_product;
}

// Truy vấn lấy sản phẩm của Apple và Samsung
$sql_products = "SELECT products.*, 
    brands.Name AS BrandName,
    types.Name AS TypeName,
    images.Name AS ImageName,
    products.Name AS ProductName
FROM products
INNER JOIN brands ON products.Brand = brands.Id
INNER JOIN types ON products.Type = types.Id
INNER JOIN images ON images.Product_id = products.Id
WHERE brands.Name IN ('Apple', 'Samsung') AND types.Name = 'Điện thoại'
ORDER BY Products.Id DESC;";

$products_query = mysqli_query($connection, $sql_products);

// Khởi tạo 2 mảng để chứa sản phẩm của Apple và Samsung
$products_data_apple = [];
$products_data_samsung = [];

// Phân loại sản phẩm vào mảng riêng biệt theo thương hiệu
while ($row = mysqli_fetch_assoc($products_query)) {
    if ($row['BrandName'] === 'Apple') {
        $products_data_apple[] = $row;
    } elseif ($row['BrandName'] === 'Samsung') {
        $products_data_samsung[] = $row;
    }
}

// Truy vấn lấy sản phẩm của Apple và Samsung
$sql_products_type = "SELECT products.*, 
    brands.Name AS BrandName,
    types.Name AS TypeName,
    images.Name AS ImageName,
    products.Name AS ProductName
FROM products
INNER JOIN brands ON products.Brand = brands.Id
INNER JOIN types ON products.Type = types.Id
INNER JOIN images ON images.Product_id = products.Id
WHERE types.Name IN ('Máy tính bảng', 'Phụ kiện')
ORDER BY Products.Id DESC;";

$products_type = mysqli_query($connection, $sql_products_type);

// Khởi tạo 2 mảng để chứa sản phẩm của Apple và Samsung
$products_data_tablet = [];
$products_data_accessory = [];

// Phân loại sản phẩm vào mảng riêng biệt theo thương hiệu
while ($row = mysqli_fetch_assoc($products_type)) {
    if ($row['TypeName'] === 'Máy tính bảng') {
        $products_data_tablet[] = $row;
    } elseif ($row['TypeName'] === 'Phụ kiện') {
        $products_data_accessory[] = $row;
    }
}
// Truy vấn chi tiết bài viết
    $sql_news = "SELECT news.*, images_news.Name AS ImageNews 
                 FROM news 
                 INNER JOIN images_news ON images_news.News_id = news.Id 
                 ORDER BY news.Id DESC
                 LIMIT 4";
    $news = mysqli_query($connection, $sql_news);

// đóng kết nối
include_once "../connection/close.php"; 
?>

<!-- Slider Section -->
<div class="mt-[20px] relative max-w-full mx-auto mb-12 overflow-hidden" data-aos="zoom-in">
  <!-- Slider Images -->
  <div class="slider-container" data-aos="fade-up">
    <div class="slide active" data-aos="fade-up">
      <img class="w-[96%] mx-auto h-100 object-cover" src="images/slide/slide1.jpg" alt="Slide 1" />
    </div>
    <div class="slide" data-aos="fade-up">
      <img class="w-[96%] mx-auto h-100 object-cover" src="images/slide/slide7.png" alt="Slide 2" />
    </div>
    <div class="slide" data-aos="fade-up">
      <img class="w-[96%] mx-auto h-100 object-cover" src="images/slide/slide3.jpg" alt="Slide 3" />
    </div>
    <div class="slide" data-aos="fade-up">
      <img class="w-[96%] mx-auto h-100 object-cover" src="images/slide/slide5.png" alt="Slide 4" />
    </div>
  </div>

  <!-- Navigation Arrows -->
  <button class="absolute top-1/2 left-8 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 text-xl cursor-pointer hover:bg-opacity-80 z-10" onclick="changeImageSlide(-1)">❮</button>
  <button class="absolute top-1/2 right-8 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 text-xl cursor-pointer hover:bg-opacity-80 z-10" onclick="changeImageSlide(1)">❯</button>

  <!-- Navigation Dots -->
  <div class="absolute bottom-5 w-full text-center" data-aos="zoom-in">
    <span class="inline-block h-1 w-5 mx-1 bg-white cursor-pointer dot" onclick="currentImageSlide(1)"></span>
    <span class="inline-block h-1 w-5 mx-1 bg-white cursor-pointer dot" onclick="currentImageSlide(2)"></span>
    <span class="inline-block h-1 w-5 mx-1 bg-white cursor-pointer dot" onclick="currentImageSlide(3)"></span>
    <span class="inline-block h-1 w-5 mx-1 bg-white cursor-pointer dot" onclick="currentImageSlide(4)"></span>
  </div>
</div>

<!-- Sản Phẩm Mới -->
<div class="new-products my-12 px-5 bg-white ml-20 mr-20 pt-5 pb-5 rounded-lg shadow-lg" >
  <div class="flex justify-between items-center mb-1 " >
    <p class="text-3xl font-semibold text-black ">Sản Phẩm Mới</p>
    <a href="#" class="text-blue-600 hover:underline text-sm">Xem tất cả sản phẩm mới</a>
  </div>

  <div class="relative overflow-hidden" data-aos="fade-up">
    <div id="product-slider-new" class="flex transition-transform duration-500 ease-in-out" data-aos="fade-up">
      <?php 
        $chunks = array_chunk($products_data, 6);
        foreach ($chunks as $group) {
      ?>
        <div class="min-w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-6 gap-4 p-4" data-aos="fade-up">
          <?php foreach ($group as $product){ ?>
            <div class="bg-white shadow hover:shadow-md transition p-3 text-center" >
              <a href="index.php?action=chitietsanpham&id=<?php echo $product['Id']; ?>">
                <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="mx-auto h-32 object-contain">
              </a>
              <div class="mt-2" >
                <div class="flex items-center justify-center text-yellow-400 text-sm">
                  <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                  <span class="text-gray-500 text-xs ml-2">đánh giá(4)</span>
                </div>
                <a href="index.php?action=chitietsanpham&id=<?php echo $product['Id']; ?>" class="block mt-1 text-sm font-medium text-gray-800 hover:text-blue-600 h-[40px]">
                  <?php echo $product['ProductName'] ?>
                </a>
                <p class="font-medium text-red-500 font-semibold text-sm mt-1">
                  <?php echo number_format($product['Price'], 0, ',', '.'); ?>đ
                </p>
              </div>
            </div>
          <?php }; ?>
        </div>
      <?php } ?>
    </div>

    <button class="absolute top-2/4 left-2 rounded-tr-xl rounded-br-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2  hover:bg-opacity-70 z-10" onclick="changeProductSlide(-1, 'product-slider-new')">❮</button>
    <button class="absolute top-2/4 right-2 rounded-tl-xl rounded-bl-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2  hover:bg-opacity-70 z-10" onclick="changeProductSlide(1, 'product-slider-new')">❯</button>
  </div>
</div>

<!-- Banner -->
<div class="flex justify-between items-center my-12  ml-20 mr-20" data-aos="fade-up">
  <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2025/04/23/sanphamhot2.png" class="rounded-lg ">
  <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2025/05/16/sanphamhot2.png" class="rounded-lg ">
  <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2025/05/05/sanphamhot-a06-a16-a26-5g.png" class="rounded-lg ">
  <img src="https://cdn.hoanghamobile.com/i/home/Uploads/2025/03/05/sanphamhot2-reno13f-2.png" class="rounded-lg ">
</div>

<!-- Danh Mục iPhone-->
<div class="mr-20 ml-20 mb-[50px]" data-aos="fade-up">
  <div class="container flex" data-aos="fade-up">
    <button class="text-2x1 font-semibold mb-4 mr-[50px] active" id="all-products"><h2>Tất cả</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-16"><h2>iPhone 16</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-15"><h2>iPhone 15</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-14"><h2>iPhone 14</h2></button>
  </div>

  <!-- Chia 5 cột: ảnh iPhone + sản phẩm -->
  <div class="grid grid-cols-5 gap-4 h-[340px]" data-aos="fade-up">
    <!-- Cột ảnh iPhone -->
    <div class="bg-gray-200 flex items-center justify-center h-full" data-aos="fade-up">
      <div class="relative w-full max-w-md bg-gray-300 overflow-hidden h-full" data-aos="fade-up">
        <img src="images/products/banner/iphone.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center" data-aos="fade-up">
          <h1 class="text-white text-4xl font-bold">Apple</h1>
          <a href="#" class="mt-4 text-white text-sm underline">Xem Thêm</a>
        </div>
      </div>
    </div>
    
    <!-- Cột sản phẩm -->
    <div class="relative overflow-hidden col-span-4 h-full"  data-aos="fade-up">
    <div id="product-slider-featured" class="flex transition-transform duration-500 ease-in-out h-full" data-aos="fade-up">
    <?php 
          $chunks_apple = array_chunk($products_data_apple, 5);
          foreach ($chunks_apple as $group_apple){
        ?>
          <div class="min-w-full grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 h-full">
          <?php foreach ($group_apple as $product_apple){ ?>
              <div class="bg-white shadow hover:shadow-md transition p-3 text-center h-full flex flex-col justify-between">
                <a href="index.php?action=chitietsanpham&id=<?php echo $product_apple['Id']; ?>">
                  <div class="flex items-center justify-center bg-white" >
                    <img src="../admins/admincp/images/<?php echo $product_apple["ImageName"]?>" class="mx-auto h-40 object-contain">
                  </div>
                </a>
                <div class="mt-2">
                  <div class="flex items-center justify-center text-yellow-400 text-sm" >
                    <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    <span class="text-gray-500 text-xs ml-2">đánh giá(4)</span>
                  </div>
                  <a href="index.php?action=chitietsanpham&id=<?php echo $product_apple['Id']; ?>" class="block mt-1 text-base font-medium text-gray-800 hover:text-blue-600 h-[50px]">
                    <?php echo $product_apple['ProductName'] ?>
                  </a>
                  <p class="font-medium text-red-500 font-semibold text-lg mt-1">
                    <?php echo number_format($product_apple['Price'], 0, ',', '.'); ?>đ
                  </p>
                </div>
              </div>
              <?php } ?>
          </div>
          <?php } ?>
      </div>
    <div id="content-all" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Tất cả -->
    </div>
    <div id="content-iphone-16" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần iPhone 16 -->
    </div>
    <div id="content-iphone-15" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần iPhone 15 -->
    </div>
    <div id="content-iphone-14" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần iPhone 14 -->
    </div>

      <button class="absolute top-2/4 left-2 rounded-tr-xl rounded-br-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(-1, 'product-slider-featured')">❮</button>
      <button class="absolute top-2/4 right-2 rounded-tl-xl rounded-bl-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(1, 'product-slider-featured')">❯</button>
    </div>
  </div>
</div>

<!-- Danh Mục Samsung-->
<div class=" mr-20 ml-20 mb-[50px]" data-aos="fade-up">
  <div class="container flex" data-aos="fade-up">
    <button class="text-2x1 font-semibold mb-4 mr-[50px] active" id="all-products"><h2>Tất cả</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="Galaxy Z Series"><h2>Galaxy Z Series</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="Galaxy S Series"><h2>Galaxy S Series</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="Galaxy Note Series"><h2>Galaxy Note Series</h2></button>
  </div>

  <!-- Chia 5 cột: ảnh Samsung + sản phẩm -->
  <div class="grid grid-cols-5 gap-4 h-[340px]" data-aos="fade-up">
    <!-- Cột ảnh Samsung -->
    <div class="bg-gray-200 flex items-center justify-center h-full" data-aos="fade-up">
      <div class="relative w-full max-w-md bg-gray-300 overflow-hidden h-full" data-aos="fade-up">
        <img src="images/products/banner/samsung.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center" data-aos="fade-up">
          <h1 class="text-white text-4xl font-bold">Samsung</h1>
          <a href="#" class="mt-4 text-white text-sm underline">Xem Thêm</a>
        </div>
      </div>
    </div>
    
    <!-- Cột sản phẩm -->
    <div class="relative overflow-hidden col-span-4 h-full"  data-aos="fade-up">
    <div id="product-slider-samsung" class="flex transition-transform duration-500 ease-in-out h-full" data-aos="fade-up">
    <?php 
          $chunks_samsung = array_chunk($products_data_samsung, 5);
          foreach ($chunks_samsung as $group_samsung){
        ?>
          <div class="min-w-full grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 h-full" data-aos="fade-up">
          <?php foreach ($group_samsung as $product_samsung){ ?>
              <div class="bg-white shadow hover:shadow-md transition p-3 text-center h-full flex flex-col justify-between">
                <a href="index.php?action=chitietsanpham&id=<?php echo $product_samsung['Id']; ?>">
                  <div class="flex items-center justify-center bg-white">
                    <img src="../admins/admincp/images/<?php echo $product_samsung["ImageName"]?>" class="mx-auto h-40 object-contain">
                  </div>
                </a>
                <div class="mt-2">
                  <div class="flex items-center justify-center text-yellow-400 text-sm">
                    <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    <span class="text-gray-500 text-xs ml-2">đánh giá(4)</span>
                  </div>
                  <a href="index.php?action=chitietsanpham&id=<?php echo $product_samsung['Id']; ?>" class="block mt-1 text-base font-medium text-gray-800 hover:text-blue-600 h-[50px]">
                    <?php echo $product_samsung['ProductName'] ?>
                  </a>
                  <p class="font-medium text-red-500 font-semibold text-lg mt-1">
                    <?php echo number_format($product_samsung['Price'], 0, ',', '.'); ?>đ
                  </p>
                </div>
              </div>
              <?php } ?>
          </div>
          <?php } ?>
      </div>
    <div id="content-all" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Tất cả -->
    </div>
    <div id="content-iphone-16" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Samsung -->
    </div>
    <div id="content-iphone-15" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Samsung -->
    </div>
    <div id="content-iphone-14" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Samsung -->
    </div>

      <button class="absolute top-2/4 left-2 rounded-tr-xl rounded-br-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(-1, 'product-slider-samsung')">❮</button>
      <button class="absolute top-2/4 right-2 rounded-tl-xl rounded-bl-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(1, 'product-slider-samsung')">❯</button>
    </div>
  </div>
</div>

<!-- Danh Mục Máy tính bảng-->
<div class=" mr-20 ml-20 mb-[50px]" data-aos="fade-up">
  <div class="container flex" data-aos="fade-up">
    <button class="text-2x1 font-semibold mb-4 mr-[50px] active" id="all-products"><h2>Tất cả</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-16"><h2>Xiaomi</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-15"><h2>Redmi</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-14"><h2>Huawei</h2></button>
  </div>

  <!-- Chia 5 cột: ảnh Máy tính bảng + sản phẩm -->
  <div class="grid grid-cols-5 gap-4 h-[340px]" data-aos="fade-up">
    <!-- Cột ảnh Máy tính bảng -->
    <div class="bg-gray-200 flex items-center justify-center h-full" data-aos="fade-up">
      <div class="relative w-full max-w-md bg-gray-300 overflow-hidden h-full" data-aos="fade-up">
        <img src="images/products/banner/tablet.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center" data-aos="fade-up">
          <h1 class="text-white text-4xl font-bold "><center>Máy tính bảng</center></h1>
          <a href="#" class="mt-4 text-white text-sm underline">Xem Thêm</a>
        </div>
      </div>
    </div>
    
    <!-- Cột sản phẩm -->
    <div class="relative overflow-hidden col-span-4 h-full"  data-aos="fade-up">
    <div id="product-slider-table" class="flex transition-transform duration-500 ease-in-out h-full" data-aos="fade-up">
        <?php 
          $chunks_tablet = array_chunk($products_data_tablet, 5);
          foreach ($chunks_tablet as $group_tablet){
        ?>
          <div class="min-w-full grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 h-full" data-aos="fade-up">
            <?php foreach ($group_tablet as $product_tablet){ ?>
              <div class="bg-white shadow hover:shadow-md transition p-3 text-center h-full flex flex-col justify-between" >
                <a href="index.php?action=chitietsanpham&id=<?php echo $product_tablet['Id']; ?>">
                  <div class="flex items-center justify-center bg-white" >
                    <img src="../admins/admincp/images/<?php echo $product_tablet["ImageName"]?>" class="mx-auto h-40 object-contain">
                  </div>
                </a>
                <div class="mt-2" >
                  <div class="flex items-center justify-center text-yellow-400 text-sm" >
                    <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    <span class="text-gray-500 text-xs ml-2">đánh giá(4)</span>
                  </div>
                  <a href="index.php?action=chitietsanpham&id=<?php echo $product_tablet['Id']; ?>" class="block mt-1 text-base font-medium text-gray-800 hover:text-blue-600 h-[50px]">
                    <?php echo $product_tablet['ProductName'] ?>
                  </a>
                  <p class="font-medium text-red-500 font-semibold text-lg mt-1">
                    <?php echo number_format($product_tablet['Price'], 0, ',', '.'); ?>đ
                  </p>
                </div>
              </div>
            <?php }; ?>
          </div>
        <?php } ?>
      </div>
    <div id="content-all" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Tất cả -->
    </div>
    <div id="content-iphone-16" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Máy tính bảng -->
    </div>
    <div id="content-iphone-15" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Máy tính bảng -->
    </div>
    <div id="content-iphone-14" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Máy tính bảng -->
    </div>

      <button class="absolute top-2/4 left-2 rounded-tr-xl rounded-br-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(-1, 'product-slider-table')">❮</button>
      <button class="absolute top-2/4 right-2 rounded-tl-xl rounded-bl-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(1, 'product-slider-table')">❯</button>
    </div>
  </div>
</div>

<!-- Danh Mục phụ kiện-->
<div class=" mr-20 ml-20 mb-[50px]" data-aos="fade-up">
  <div class="container flex" data-aos="fade-up">
    <button class="text-2x1 font-semibold mb-4 mr-[50px] active" id="all-products"><h2>Tất cả</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-16"><h2>Tai nghe</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-15"><h2>Sạc dự phòng</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-14"><h2>Ốp lưng</h2></button>
    <button class="text-2x1 font-semibold mb-4 mr-[50px]" id="iphone-14"><h2>Thẻ nhớ</h2></button>
  </div>

  <!-- Chia 5 cột: ảnh phụ kiện + sản phẩm -->
  <div class="grid grid-cols-5 gap-4 h-[340px]" data-aos="fade-up">
    <!-- Cột ảnh phụ kiện -->
    <div class="bg-gray-200 flex items-center justify-center h-full" data-aos="fade-up">
      <div class="relative w-full max-w-md bg-gray-300 overflow-hidden h-full" data-aos="fade-up">
        <img src="images/products/banner/accessory.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center" data-aos="fade-up">
          <h1 class="text-white text-4xl font-bold">Phụ kiện</h1>
          <a href="#" class="mt-4 text-white text-sm underline">Xem Thêm</a>
        </div>
      </div>
    </div>
    
    <!-- Cột sản phẩm -->
    <div class="relative overflow-hidden col-span-4 h-full"  data-aos="fade-up">
    <div id="product-slider-accessory" class="flex transition-transform duration-500 ease-in-out h-full" data-aos="fade-up">
        <?php 
          $chunks_accessory = array_chunk($products_data_accessory, 5);
          foreach ($chunks_accessory as $group_accessory){
        ?>
          <div class="min-w-full grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 h-full" data-aos="fade-up">
            <?php foreach ($group_accessory as $product_accessory){ ?>
              <div class="bg-white shadow hover:shadow-md transition p-3 text-center h-full flex flex-col justify-between" >
                <a href="index.php?action=chitietsanpham&id=<?php echo $product_accessory['Id']; ?>">
                  <div class="flex items-center justify-center bg-white">
                    <img src="../admins/admincp/images/<?php echo $product_accessory["ImageName"]?>" class="mx-auto h-40 object-contain">
                  </div>
                </a>
                <div class="mt-2">
                  <div class="flex items-center justify-center text-yellow-400 text-sm">
                    <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    <span class="text-gray-500 text-xs ml-2">đánh giá(4)</span>
                  </div>
                  <a href="index.php?action=chitietsanpham&id=<?php echo $product_accessory['Id']; ?>" class="block mt-1 text-base font-medium text-gray-800 hover:text-blue-600 h-[50px]">
                    <?php echo $product_accessory['ProductName'] ?>
                  </a>
                  <p class="font-medium text-red-500 font-semibold text-lg mt-1">
                    <?php echo number_format($product_accessory['Price'], 0, ',', '.'); ?>đ
                  </p>
                </div>
              </div>
            <?php }; ?>
          </div>
        <?php } ?>
      </div>
    <div id="content-all" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần Tất cả -->
    </div>
    <div id="content-iphone-16" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần phụ kiện -->
    </div>
    <div id="content-iphone-15" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần phụ kiện -->
    </div>
    <div id="content-iphone-14" class="content-section hidden" data-aos="fade-up">
      <!-- Nội dung phần phụ kiện -->
    </div>

      <button class="absolute top-2/4 left-2 rounded-tr-xl rounded-br-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(-1, 'product-slider-accessory')">❮</button>
      <button class="absolute top-2/4 right-2 rounded-tl-xl rounded-bl-xl transform -translate-y-1/2 bg-black bg-opacity-40 text-white p-2 hover:bg-opacity-70 z-10" onclick="changeProductSlide(1, 'product-slider-accessory')">❯</button>
    </div>
  </div>
</div>

<div class="justify-between items-center my-12  ml-20 mr-20 w-[87%]" data-aos="fade-up">
  <img src="images/products/logo/brands.jpg" class="w-full">
</div>

<h2 class="text-center text-2xl md:text-3xl font-bold text-gray-800 mb-8">
    Theo dõi chúng tôi để biết thêm nhiều Tin tức và Ưu đãi
</h2>

<div class="flex flex-wrap justify-center gap-8 px-4 mb-6" data-aos="fade-up">
    <?php foreach ($news as $new) { ?>
    <div class="w-72 bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 cursor-pointer">
        <a href="index.php?action=chitietbaiviet&id=<?php echo $new['Id']; ?>" class="block">
            <img src="../admins/admincp/images/<?php echo $new['ImageNews']; ?>" alt="Ảnh bài viết" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
            <div class="p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2">
                    <?php echo $new['Title'] ?>
                </h3>
                <span class="inline-block text-sm text-blue-600 hover:underline">
                    Xem chi tiết →
                </span>
            </div>
        </a>
    </div>
    <?php } ?>
</div>

<!-- Nút xem tất cả -->
<div class="text-center mb-8" data-aos="zoom-in">
    <a href="index.php?action=tintuc">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl shadow-lg transition duration-300">
            Xem tất cả bài viết
        </button>
    </a>
</div>

</body>
<!-- JS -->
<!-- AOS JS -->
<script src="js/slide.js"></script>
<script src="js/slide_product.js"></script>