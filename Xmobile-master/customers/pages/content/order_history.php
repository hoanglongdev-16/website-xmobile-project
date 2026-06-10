<?php
//mở kết nối
include_once "../Connection/open.php";
$total = 0;
// Lấy id của tài khoản đang đăng nhập
$customer_id = $_SESSION['customer_id'];

// Lấy thông tin khách hàng
$sqlCustomer = "SELECT Name FROM customers WHERE Id = $customer_id";
$customer = mysqli_query($connection, $sqlCustomer);

// Cấu hình phân trang đơn hàng (lịch sử mua hàng)
$recordsPerPage = 5;

// Đếm tổng số đơn hàng của khách
$sqlCount = "SELECT COUNT(DISTINCT orders.Id) AS total
    FROM orders
    WHERE orders.Customer_id = $customer_id";
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

// Lấy danh sách OrderId phân trang
$sqlOrders = "SELECT Id, Order_date, Order_status,
            Delivery_location,  Receiver_name, Receiver_phone, Payment_method
    FROM orders
    WHERE Customer_id = $customer_id
    ORDER BY orders.Order_date DESC, orders.Id DESC
    LIMIT $start, $recordsPerPage";
$resultOrders = mysqli_query($connection, $sqlOrders);

// Lấy chi tiết các đơn hàng
$orderIds = [];
$orders = [];
while ($row = mysqli_fetch_assoc($resultOrders)) {
    $orderIds[] = $row['Id'];
    $orders[$row['Id']] = [
        'Order_date' => $row['Order_date'],
        'Order_status' => $row['Order_status'],
        'Delivery_location' => $row['Delivery_location'],
        'Receiver_name' => $row['Receiver_name'],
        'Receiver_phone' => $row['Receiver_phone'],
        'Payment_method' => $row['Payment_method'],
        'Items' => []
    ];
}

if (count($orderIds) > 0) {
    $ids = implode(',', $orderIds);
    $sqlDetails = "SELECT 
            order_details.Order_id,
            order_details.Product_id,
            order_details.Quantity,
            order_details.Price,
            products.Name AS ProductName,
            images.Name AS ImageName
        FROM order_details
        JOIN products ON order_details.Product_id = products.Id
        LEFT JOIN images ON products.Id = images.Product_id
        WHERE order_details.Order_id IN ($ids)
        ORDER BY order_details.Order_id";
    $resultDetails = mysqli_query($connection, $sqlDetails);

    while ($item = mysqli_fetch_assoc($resultDetails)) {
        $orders[$item['Order_id']]['Items'][] = $item;
    }
}
//đóng kết nối
include_once "../Connection/close.php";
?>

<div class="max-w-[1200px] mx-auto pt-4">
    <!-- Breadcrumb -->
    <nav class="text-2x1 text-gray-600" data-aos="fade-right">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="index.php" class="text-blue-700 hover:underline font-medium">Trang Chủ</a>
            </li>
            <li><span class="text-gray-400">›</span></li>
            <li>
                <a href="index.php?action=giohang" class="text-blue-700 hover:underline font-medium">Giỏ hàng</a>
            </li>
            <li><span class="text-gray-400">›</span></li>
            <li>
                <a href="index.php?action=lichsumuahang" class="text-blue-700 hover:underline font-medium">Lịch Sử Mua Hàng</a>
            </li>
        </ol>
    </nav>
</div>
<div class="max-w-6xl mx-auto pt-6" data-aos="fade-up">
    <h1 class="text-3xl font-bold mb-6">Lịch sử mua hàng</h1>

    <?php if (empty($orders)) { ?>
        <p>Bạn chưa có đơn hàng nào.</p>
    <?php } else { ?>
        <?php foreach ($orders as $orderId => $order) { ?>
            <div class="mb-8 border rounded-lg shadow p-4 bg-white">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-xl font-semibold">Mã đơn hàng: #<?php echo $orderId ?></h1>
                </div>
                <p><strong>Tên khách hàng:</strong><strong style="color: red; font-size: 20px"> <?php echo $order['Receiver_name']; ?></strong></p>
                <p><strong>Ngày đặt:</strong> <?php echo $order['Order_date']; ?></p>

                <p><strong>Trạng thái:</strong>
                    <?php
                    switch ($order['Order_status']) {
                        case 0: echo "Chờ xử lý"; break;
                        case 1: echo "Đang giao"; break;
                        case 2: echo "Đã giao"; break;
                        case 3: echo "Đã hủy"; break;
                        default: echo "Không xác định";
                    }
                    ?>
                </p>
                <p><strong>Địa chỉ giao hàng:</strong> <?php echo $order['Delivery_location']; ?></p>
                <p><strong>Phương thức thanh toán:</strong> <?php echo $order['Payment_method']; ?></p>
                <p class="mt-[10px]">
                    <form action="check_out/update_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $orderId ?>">
                        <?php if ($order['Order_status'] == 0) { ?>
                            <button type="submit"
                                name="status" value="3"
                                class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 font-medium">
                                Hủy hàng
                            </button>
                        <?php } ?>
                    </form>
                </p>

                <table class="w-full mt-4 border-t text-left">
                    <thead>
                        <tr class="bg-gray-100 ">
                            <th class="py-2 px-5">Ảnh</th>
                            <th width="400px">Tên sản phẩm</th>
                            <th width="150px">Giá</th>
                            <th width="150px">Số lượng</th>
                            <th width="150px">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orderTotal = 0;
                        foreach ($order['Items'] as $item) {
                            $subtotal = $item['Price'] * $item['Quantity'];
                            $orderTotal += $subtotal;
                        ?>
                            <tr class="border-t">
                                <td><img src="../admins/admincp/images/<?php echo $item['ImageName'] ?>" width="80" class="pt-4 pb-4"></td>
                                <td><?php echo $item['ProductName'] ?></td>
                                <td><?php echo number_format($item['Price'], 0, ',', '.') . ' đ'; ?></td>
                                <td class="px-7"><?php echo $item['Quantity']; ?></td>
                                <td><?php echo number_format($subtotal, 0, ',', '.') . ' đ'; ?></td>
                            </tr>
                        <?php } ?>
                        <tr class="border-t ">
                            <td colspan="4" class="text-right font-bold pt-4">Tổng cộng: &nbsp;</td>
                            <td class="font-bold text-red-600 pt-4">
                                <strong style="color:rgb(196, 44, 14); font-weight: bold; font-size: 18px">
                                    <?php echo number_format($orderTotal, 0, ',', '.'); ?> đ
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<!-- Phân trang -->
<div class="mb-5 text-center space-x-2">
    <?php for ($i = 1; $i <= $pages; $i++) {
        $link = "index.php?action=lichsumuahang&id=$customer_id&page=$i";
    ?>
        <a href="<?php echo $link; ?>"
            class="inline-block px-4 py-2 border rounded <?php echo ($i == $page ? 'bg-black text-white font-bold' : 'border-gray-300 hover:bg-gray-200'); ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>
</div>
