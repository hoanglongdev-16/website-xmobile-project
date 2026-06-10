<?php
//mở kết nối
include_once "../../Connection/open.php";

$total = 0;
$orderId = $_GET["id"];

// Lấy thông tin đơn hàng và khách hàng
$sqlOrderInfo = "SELECT 
                    orders.Order_date,
                    orders.Order_status,
                    orders.Delivery_location,
                    orders.Receiver_name,
                    orders.Receiver_phone,
                    orders.Payment_method,
                    customers.Name AS CustomerName
                FROM orders
                JOIN customers ON orders.Customer_id = customers.Id
                WHERE orders.Id = $orderId";
//chạy sql
$order = mysqli_query($connection, $sqlOrderInfo);

// Lấy danh sách sản phẩm trong đơn hàng
$sqlItems = "SELECT 
                order_details.Product_id,
                order_details.Quantity,
                products.Name AS ProductName,
                products.Price,
                images.Name AS ImageName
            FROM order_details
            JOIN products ON order_details.Product_id = products.Id
            LEFT JOIN images ON products.Id = images.Product_id
            WHERE order_details.Order_id = $orderId";
//chạy sql
$itemsResult = mysqli_query($connection, $sqlItems);

//đóng kết nối
include_once "../../Connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">
<?php 
    foreach($order as $order){
?>
<div class="container mx-auto mt-6">
    <h2 class="text-2xl font-bold text-blue-800">Chi tiết đơn hàng</h2>

    <?php if (!$order) { ?>
        <div class="p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            Đơn hàng không tồn tại.
        </div>
    <?php } else { ?>
        <div class=" p-6 mb-3">
            <p style="font-size: 20px"><strong>Khách hàng:</strong> <strong style="color: red; "><?php echo $order['Receiver_name']; ?></strong></p>
            <p><strong>Ngày đặt:</strong> <?php echo $order['Order_date']; ?></p>
            <p><strong>Trạng thái:</strong>
                <?php
                    switch ($order['Order_status']) {
                        case 0: echo 'Chờ xử lý'; break;
                        case 1: echo 'Đang giao'; break;
                        case 2: echo 'Đã giao'; break;
                        case 3: echo 'Đã hủy'; break;
                        default: echo "Không xác định";
                    }
                ?>
            </p>
            <p><strong>Địa chỉ giao hàng:</strong> <?php echo $order['Delivery_location']; ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $order['Receiver_phone']; ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?php echo $order['Payment_method']; ?></p>

            <!-- Form cập nhật trạng thái -->
            <form action="check_out/update_status.php" method="POST">
                <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">

                <label for="status" class="font-semibold">Cập nhật trạng thái:</label>

                <?php if ($order['Order_status'] == 0) { ?>
                    <select name="status" id="status" class="border px-3 py-1 rounded">
                        <option value="0" selected>Chờ xử lý</option>
                        <option value="1">Đang giao</option>
                        <option value="2">Đã giao</option>
                        <option value="3">Đã hủy</option>
                    </select>
                    <button type="submit" 
                            class="ml-2 pl-3 pr-3 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition">
                        Cập nhật
                    </button>

                <?php } elseif ($order['Order_status'] == 1) { ?>
                    <select name="status" id="status" class="border px-3 py-1 rounded">
                        <option value="1" selected>Đang giao</option>
                        <option value="2">Đã giao</option>
                        <option value="3">Đã hủy</option>
                    </select>
                    <button type="submit" 
                            class="ml-2 pl-3 pr-3 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition">
                        Cập nhật
                    </button>

                <?php } elseif ($order['Order_status'] == 2) { ?>
                    <span style="color: red; font-size: 18px; font-weight: bold;">Đã giao</span>

                <?php } elseif ($order['Order_status'] == 3) { ?>
                    <span style="color: red; font-size: 18px; font-weight: bold;">Đã hủy</span>
                <?php } ?>
            </form>

        </div>

        <table border="1" width="100%" cellpadding="8" cellspacing="0" class="bg-white rounded-lg border text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th width="100px">Ảnh</th>
                    <th width="280px">Tên sản phẩm</th>
                    <th width="90px">Số lượng</th>
                    <th width="100px">Giá</th>
                    <th width="100px">Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($item = mysqli_fetch_assoc($itemsResult)) {
                    $subtotal = $item['Quantity'] * $item['Price'];
                    $total += $subtotal;
                ?>
                <tr class="border-t hover:bg-gray-50">
                    <td><img src="../../admins/admincp/images/<?php echo $item['ImageName']; ?>" width="70"></td>
                    <td><?php echo $item['ProductName']; ?></td>
                    <td><?php echo $item['Quantity']; ?></td>
                    <td><?php echo number_format($item['Price'], 0, ',', '.') . ' đ'; ?></td>
                    <td><?php echo number_format($subtotal, 0, ',', '.') . ' đ'; ?></td>
                </tr>
                <?php } ?>
                <tr class="font-bold bg-gray-50">
                    <td colspan="4" class="text-right font-bold" >Tổng cộng: &nbsp;</td>
                    <td class="font-bold text-red-600">
                        <strong style="color:rgb(219, 50, 16); font-weight: bold; font-size: 18px">
                            <?php echo number_format($total, 0, ',', '.'); ?> đ
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php 
        } 
    ?>
        <div class="mt-6">
            <a href="index.php?action=quanlydonhang" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded transition">
               ← Quay lại danh sách
            </a>
        </div>
</div>
<?php 
    } 
?>