
<link rel="stylesheet" href="css/style_table.css">
<div class="container mx-auto">
    <h2>Danh sách sản phẩm</h2>
    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <?php
                //Lấy giá trị đang search
                if(isset($_GET["keyword"])){
                    $keyword = $_GET["keyword"];
                } else {
                    $keyword = "";
                }
        ?>
        <input type="hidden" name="action" value="quanlysanpham">
        
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword; ?>"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <a href="index.php?action=themsanpham"><button type="button">Thêm sản phẩm</button></a>

    <!-- Bảng danh sách sản phẩm -->
    <table border="1px" cellspacing="0" cellpadding="0" width="80%">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Thông tin sản phẩm </th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <?php
            //mở kết nối
            include_once "../../connection/open.php";

            // Số sản phẩm mỗi trang
            $recordsPerPage = 5;

            // Tổng số bản ghi
            $sqlCountRecords = "SELECT COUNT(*) AS total_records FROM products
                                WHERE products.Name LIKE '%$keyword%'";
            $countRecords = mysqli_query($connection, $sqlCountRecords);
            $totalRecords = 0;
            foreach ($countRecords as $countRecord) {
                $totalRecords = $countRecord["total_records"];
            }

            // Tính tổng số trang
            $pages = ceil($totalRecords / $recordsPerPage);

            // Lấy trang hiện tại
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }

            // Vị trí bắt đầu
            $start = ($page - 1) * $recordsPerPage;

            // Truy vấn sản phẩm
            $sql_products = "SELECT * FROM products
                            WHERE products.Name LIKE '%$keyword%'
                            ORDER BY products.Id DESC
                            LIMIT $start, $recordsPerPage";

            $products = mysqli_query($connection, $sql_products);

            // Đóng kết nối
            include_once "../../connection/close.php";
            // Hiển thị sản phẩm
            foreach ($products as $product) {
        ?>
        <tr>
            <td><?php echo $product["Id"] ?></td>
            <td><?php echo $product["Name"] ?></td>
            <td><a href="index.php?action=chitietsanpham&id=<?php echo $product['Id']; ?>">Xem chi tiết</a></td>
            <td><a href="index.php?action=suasanpham&id=<?php echo $product['Id']; ?>">Sửa</a></td>
            <td><a href="products/destroy.php?id=<?php echo $product['Id']; ?>" class="delete">Xóa</a></td>
        </tr>
        <?php } ?>
    </table>

    <!-- Phân trang -->
    <div style="text-align: center; margin-top: 20px;">
        <?php for ($i = 1; $i <= $pages; $i++) {
            $link = "index.php?action=quanlysanpham&page=$i";
            if (!empty($keyword)) {
                $link .= "&keyword=" . urlencode($keyword);
            }
        ?>
            <a href="<?php echo $link; ?>"
               style="margin: 0 5px; padding: 5px 10px; text-decoration: none;
                      <?php echo ($i == $page) ? 'background-color: #ffc107; color: black;' : 'border: 1px solid #ccc;' ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
</div>
