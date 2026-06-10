<?php
    // Mở kết nối
    include_once "../../Connection/open.php";

    //Lấy giá trị đang search
    if(isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
    } else {
        $keyword = "";
    }

    // Phân trang
    $recordsPerPage = 5;
    $sqlCount = "SELECT COUNT(*) AS total 
                FROM orders 
                INNER JOIN customers ON orders.Customer_id = customers.Id 
                WHERE customers.Name LIKE '%$keyword%'";
    $resultCount = mysqli_query($connection, $sqlCount);
    $row = mysqli_fetch_assoc($resultCount);
    $totalRecords = $row['total'];
    $pages = ceil($totalRecords / $recordsPerPage);

    // Lấy trang hiện tại
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    // Vị trí bắt đầu
    $start = ($page - 1) * $recordsPerPage;

    // Lấy danh sách đơn hàng
    $sql = "SELECT 
                orders.Id AS OrderId,
                orders.Order_date,
                orders.Order_status,
                customers.Name AS CustomerName
            FROM orders
            JOIN customers ON orders.Customer_id = customers.Id
            WHERE customers.Name LIKE '%$keyword%'
            ORDER BY 
            CASE orders.Order_status
                WHEN 0 THEN 1  -- Chờ xử lý
                WHEN 1 THEN 2  -- Đang giao
                WHEN 2 THEN 3  -- Đã giao
                WHEN 3 THEN 4  -- Đã hủy
                ELSE 5
            END ASC,
            orders.Order_date DESC,
            orders.Id DESC
            LIMIT $start, $recordsPerPage";
    //chạy query
    $result = mysqli_query($connection, $sql);
    
    //đóng kết nối
    include_once "../../Connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">

<body>
<div class="container mx-auto">
    <h2>Danh sách đơn hàng</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="quanlydonhang">
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword ?>"
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <!-- Bảng danh sách đơn hàng -->
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th width="50px">Id</th>
                <th>Tài khoản</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Xem chi tiết</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) == 0){ ?>
            <tr><td colspan="6" style="text-align: center;">Không có đơn hàng nào</td></tr>
        <?php } else { ?>
            <?php foreach ($result as $order){ ?>
                <tr>
                    <td><?php echo $order['OrderId']; ?></td>
                    <td><?php echo $order['CustomerName']; ?></td>
                    <td><?php echo $order['Order_date']; ?></td>
                    <td>
                        <?php
                        switch ($order['Order_status']) {
                            case 0: echo "Chờ xử lý"; break;
                            case 1: echo "Đang giao"; break;
                            case 2: echo "Đã giao"; break;
                            case 3: echo "Đã hủy"; break;
                            default: echo "Không xác định";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="index.php?action=chitietdonhang&id=<?php echo $order['OrderId']; ?>">Chi tiết</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $pages; $i++) {
            $link = "index.php?action=quanlydonhang&page=$i";
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
