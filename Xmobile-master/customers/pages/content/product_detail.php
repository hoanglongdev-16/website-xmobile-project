<?php
    // mở kết nối
    include_once "../connection/open.php";
    // Lấy ID sản phẩm từ URL
    $id = $_GET['id'];
    if ($id) {
    //lấy thông tin sản phẩm
    $sql_product_image = "SELECT products.*, 
        brands.Name AS BrandName,
        types.Name AS TypeName,
        images.Name AS ImageName,
        products.Name AS ProductName
    FROM products
    INNER JOIN brands ON products.Brand = brands.Id
    INNER JOIN types ON products.Type = types.Id
    INNER JOIN images ON images.Product_id = products.Id
    WHERE products.Id = $id;";
    }
    //lấy sản phẩm
        $sql_product = "SELECT products.*, 
        brands.Name AS BrandName,
        types.Name AS TypeName,
        images.Name AS ImageName,
        products.Name AS ProductName
    FROM products
    INNER JOIN brands ON products.Brand = brands.Id
    INNER JOIN types ON products.Type = types.Id
    INNER JOIN images ON images.Product_id = products.Id
    ORDER BY Products.Id DESC
    LIMIT 4;";
    //lấy thông tin sản phẩm
    $products = mysqli_query($connection, $sql_product_image);
    //lấy sản phẩm
    $product_image = mysqli_query($connection, $sql_product);
    //đóng kết nối
    include_once "../connection/close.php";
?>
<body class="bg-gray-100 text-gray-800">
    <?php 
        foreach ($products as $product) {
    ?>
    <div class="max-w-7xl mx-auto p-4 grid grid-cols-1 md:grid-cols-7 gap-6" data-aos="fade-up">

        <!-- Left Column: Image and Color Options -->
        <div class="md:col-span-3 space-y-4">
        <div class="bg-white border border-gray-300 rounded-lg pl-4 pr-4 pt-1 pb-1">
        <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="mx-auto h-[300px] object-contain">
        </div>

        <!-- Color thumbnails -->
        <div class="flex space-x-2">
            <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="w-10 h-10 rounded border border-gray-400" alt="Hồng">
            <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="w-10 h-10 rounded border border-gray-400" alt="Xanh Mòng Két">
            <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="w-10 h-10 rounded border border-gray-400" alt="Trắng">
            <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="w-10 h-10 rounded border border-gray-400" alt="Xanh Lưu Ly">
            <img src="../admins/admincp/images/<?php echo $product["ImageName"]?>" class="w-10 h-10 rounded border border-gray-400" alt="Đen">
        </div>

        <!-- Info bullets -->
        <ul class="text-sm list-inside space-y-1 bg-white shadow p-4">
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="text-green-700 inline-block w-5 h-5 text-teal-500 mr-2 align-middle">
                    <path fill="currentColor" d="M112 0C85.5 0 64 21.5 64 48l0 48L16 96c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 208 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 160l-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l16 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 224l-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 144 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L64 288l0 128c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L112 0zM544 237.3l0 18.7-128 0 0-96 50.7 0L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/>
                </svg>
                Miễn phí vận chuyển toàn quốc – Giao hàng hỏa tốc 2H nội thành
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-700 inline-block w-5 h-5 text-teal-500 mr-2" viewBox="0 0 24 24" fill="none">
                    <path fill="currentColor" d="M12 2L4 5v6c0 5.55 3.84 10.74 8 12 4.16-1.26 8-6.45 8-12V5l-8-3Zm3.707 7.707-5 5a1 1 0 0 1-1.414 0l-2-2 1.414-1.414L10 12.586l4.293-4.293 1.414 1.414Z"/>
                </svg>
                Bảo hành 12 tháng chính hãng Apple
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-700 inline-block w-5 h-5 text-teal-500 mr-2" viewBox="0 0 24 24" fill="none">
                    <path fill="currentColor" d="M12 2l2.99 6.09L22 9.17l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.04 2 9.17l7.01-1.08L12 2Z"/>
                </svg>
                1 đổi 1 trong 30 ngày đầu nếu có lỗi phần cứng do nhà sản xuất
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-700 inline-block w-5 h-5 text-teal-500 mr-2" viewBox="0 0 24 24" fill="none">
                    <path fill="currentColor" d="M4 2h10l6 6v14H4V2Zm11 1.5V9h5.5L15 3.5Zm-1.707 10.207-3.147 3.146-1.646-1.647-1.414 1.415 3.06 3.06 4.56-4.56-1.413-1.414Z"/>
                </svg>
                Giá đã bao gồm VAT
            </li>
        </ul>

        <!-- Thông tin sản phẩm -->
        <div class="bg-white rounded shadow p-4 space-y-4">
        <h2 class="text-xl font-bold">THÔNG TIN SẢN PHẨM</h2>

        <!-- Mô tả -->
        <div class="bg-gray-100 rounded p-4 text-sm space-y-2 h-[580px] overflow-y-auto">
            <h3 class="font-semibold text-lg">Mô tả</h3>
            <div><?php echo $product['Description']; ?></div>
        </div>
        </div>
    </div>

    <!-- Right: Giá và thông số kỹ thuật -->
        <div class="md:col-span-4 space-y-3">
            <div>
            <h1 class="text-4xl font-semibold"><strong><?php echo $product['Name']; ?></strong></h1>
            <p class="text-4xl font-bold text-red-600 mt-2"><strong><?php echo number_format($product['Price'], 0, ',', '.'); ?>đ</strong></p>
            </div>

            <!-- Thông số kỹ thuật -->
            <div class="bg-white rounded shadow p-4 text-sm space-y-2 h-[350px] m-auto">
            <h3 class="font-semibold flex items-center text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-800 w-5 h-5 mr-2" viewBox="0 0 512 512" fill="currentColor">
                <path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
            </svg>
            <strong>THÔNG SỐ KỸ THUẬT</strong>
            </h3>
            <div class="grid grid-cols-2 gap-2">
                <div><span class="font-medium ">Độ phân giải camera </span></div><div><?php echo $product['Camera']; ?></div>
                <div><span class="font-medium ">Hệ điều hành </span></div><div><?php echo $product['Operating_System']; ?></div>
                <div><span class="font-medium ">Ram </span></div><div><?php echo $product['Ram']; ?></div>
                <div><span class="font-medium ">ROM </span></div><div><?php echo $product['Rom']; ?></div>
                <div><span class="font-medium ">Vi xử lý </span></div><div><?php echo $product['Chip']; ?></div>
                <div><span class="font-medium ">Khe cắm sim </span></div><div><?php echo $product['Sim']; ?></div>
                <div><span class="font-medium ">Mạng di động </span></div><div><?php echo $product['Mobile_Network']; ?></div>
                <div><span class="font-medium ">Độ phẩn giải </span></div><div><?php echo $product['Resolution']; ?></div>
                <div><span class="font-medium ">Dung lượng pin </span></div><div><?php echo $product['Battery_Capacity']; ?></div>
                <div><span class="font-medium ">Kích thước màn hình </span></div><div><?php echo $product['Screen_size']; ?></div>
            </div>
            </div>
    <?php 
        } 
    ?>
            <!-- Thêm vào giỏ hàng -->
            <div>
                <?php
                    if(isset($_SESSION['customer_email'])){
                ?>
                <button onclick="addToCart(<?php echo $product['Id']; ?>)" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded font-semibold mb-5">
                    Thêm vào giỏ hàng
                </button>
                <?php
                    } else {
                ?>
                <a href="login/login.php" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded font-semibold mb-5 text-center block">
                    Thêm vào giỏ hàng
                </a>
                <?php
                    }
                ?>
            </div>
            <img src="images/products/ads/iphonexs.jpg" class="pb-4">
            <!-- sản phẩm liên quan -->
            <div class="mt-6 bg-white p-5 shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Sản Phẩm liên quan</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php 
                        foreach ($product_image as $product_image) { 
                    ?>
                        <div class="product-item border shadow-sm p-3 text-center bg-white">
                            <a href="index.php?action=chitietsanpham&id=<?php echo $product_image['Id']; ?>">
                                <img src="../admins/admincp/images/<?php echo $product_image["ImageName"]?>" class="w-full h-48 object-contain mx-auto mb-2">
                            </a>
                            <div class="rating text-yellow-400 text-sm mb-1">
                                <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                                <span class="review-count text-gray-600">(4 đánh giá)</span>
                            </div>
                            <a href="index.php?action=chitietsanpham&id=<?php echo $product_image['Id']; ?>">
                                <h3 class="text-base font-medium text-gray-800 mb-1 hover:text-blue-600 h-[60px]"><?php echo $product_image['ProductName']; ?></h3>
                            </a>
                            <p class="price text-red-600 font-semibold"><?php echo number_format($product_image['Price'], 0, ',', '.'); ?>đ</p>
                        </div>  
                    <?php 
                        } 
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function addToCart(productId) {
        // Gửi yêu cầu thêm sản phẩm vào giỏ hàng (AJAX hoặc điều hướng)
        fetch(`cart/add_to_cart.php?id=${productId}`)
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã thêm vào giỏ hàng!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Có lỗi xảy ra!',
                        text: 'Vui lòng thử lại.'
                    });
                }
            });
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>