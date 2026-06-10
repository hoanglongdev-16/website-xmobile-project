<?php
    //mở kết nối
    include_once "../../Connection/open.php";

    //Lấy giá trị đang search
    if(isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
    } else {
        $keyword = "";
    }

    // Số bản ghi mỗi trang
    $recordsPerPage = 5;

    // Đếm tổng số bản ghi phù hợp
    $sqlCount = "SELECT COUNT(*) AS total FROM carts 
    INNER JOIN customers ON carts.Customer_id = customers.Id 
    WHERE customers.Name LIKE '%$keyword%'";
    $resultCount = mysqli_query($connection, $sqlCount);
    $row = mysqli_fetch_assoc($resultCount);
    $totalRecords = $row['total'];
    $pages = ceil($totalRecords / $recordsPerPage);

    // Lấy trang hiện tại
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    // Đảm bảo $page >= 1
    if ($page < 1) {
        $page = 1;
    }
    // Đảm bảo tổng số trang không nhỏ hơn 1 (tránh chia cho 0)
    $pages = max(ceil($totalRecords / $recordsPerPage), 1);

    // Nếu số trang hiện tại vượt quá tổng số trang, gán lại
    if ($page > $pages) {
        $page = $pages;
    }

    // Vị trí bắt đầu của từng trang
    $start = ($page - 1) * $recordsPerPage;

    // Truy vấn danh sách khách hàng có giỏ hàng theo trang + tìm kiếm
    $sql = "SELECT
                carts.Id AS cartId,
                customers.Id AS CustomerId, 
                customers.Name AS CustomerName
            FROM carts
            INNER JOIN customers ON carts.Customer_id = customers.Id
            WHERE customers.Name LIKE '%$keyword%'
            ORDER BY customers.Name ASC
            LIMIT $start, $recordsPerPage";
    // Chạy truy vấn
    $customers = mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../../Connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">

<body>
<div class="container mx-auto">
    <h2>Danh sách khách hàng có giỏ hàng</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="quanlygiohang">
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword ?>"
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <!-- Bảng danh sách khách hàng -->
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th width="50px">Id</th>
                <th>Tên khách hàng</th>
                <th>Giỏ hàng</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($customers) == 0){ ?>
            <tr><td colspan="3" style="text-align: center;">Không có khách hàng nào</td></tr>
        <?php }else{ ?>
            <?php foreach ($customers as $customer){ ?>
                <tr>
                    <td><?php echo $customer['CustomerId']; ?></td>
                    <td><?php echo $customer['CustomerName']; ?></td>
                    <td><a href="index.php?action=chitietgiohang&id=<?php echo $customer['cartId']; ?>">Xem chi tiết</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $pages; $i++) {
            $link = "index.php?action=quanlygiohang&page=$i";
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
</body>
