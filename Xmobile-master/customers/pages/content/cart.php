<?php
//mở kết nối
include_once "../Connection/open.php";
$total = 0;
// Kiểm tra xem người dùng đã đăng nhập chưa
if(isset($_SESSION['customer_email'])){
//Lấy id của tài khoản đang đăng nhập
$customer_id = $_SESSION['customer_id'];


// Lấy thông tin khách hàng
$sqlCustomer = "SELECT Name FROM customers WHERE Id = $customer_id";
$customer = mysqli_query($connection, $sqlCustomer);

// Cấu hình phân trang
$recordsPerPage = 5;

$sqlCount = "SELECT COUNT(*) AS total 
    FROM carts
    JOIN cart_details ON carts.Id = cart_details.Cart_id
    WHERE carts.Customer_id = $customer_id";
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

// Lấy sản phẩm trong giỏ hàng
$sqlCart = "SELECT 
        cart_details.Product_id,
        cart_details.Quantity,
        carts.Id AS Cart_id,
        products.Name AS ProductName,
        images.Name AS ImageName,
        products.Price
    FROM carts
    JOIN cart_details ON carts.Id = cart_details.Cart_id
    JOIN products ON products.Id = cart_details.Product_id
    LEFT JOIN images ON products.Id = images.Product_id
    WHERE carts.Customer_id = $customer_id
    GROUP BY cart_details.Product_id
    ORDER BY carts.Id DESC
    LIMIT $start, $recordsPerPage";
//chạy query
$carts = mysqli_query($connection, $sqlCart);
} else {
    
}
//đóng kết nối
include_once "../Connection/close.php";
?>

<div class="max-w-[1200px] mx-auto p-4">
        <nav class="mt-5 px-4 text-2x1 text-gray-600" data-aos="fade-right">
            <ol class="list-reset flex items-center space-x-2">
                <li>
                    <a href="index.php" class="text-blue-700 hover:underline font-medium">Trang Chủ</a>
                </li>
                <li>
                    <span class="text-gray-400">›</span>
                </li>
                <li>
                    <a href="index.php?action=giohang" class="text-blue-700 hover:underline font-medium">Giỏ Hàng</a>
                </li>
            </ol>
        </nav>
    <?php 
        if(isset($_SESSION['customer_email'])){
    ?>
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between pb-3" data-aos="zoom-in">
            <h1 class="text-4xl font-bold mb-6">Giỏ hàng</h1>
            <a href="index.php?action=lichsumuahang">
            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                Xem Lịch Sử Mua Hàng
            </button>
        </a>
        </div>
        <!-- Form cập nhật giỏ hàng -->
        <form method="post" action="cart/update_cart.php" data-aos="fade-up">
            <table width="100%" cellpadding="20" cellspacing="0" style="background-color: #f9f9f9">
                <thead>
                    <tr style="border-bottom: 1px solid #bdc0cb; font-size: 20px; font-weight: bold;">
                        <th>Ảnh sản phẩm</th>
                        <td style="width: 400px">Tên sản phẩm</td>
                        <td style="width: 200px">Số lượng</td>
                        <td style="width: 200px">Tổng</td>
                        <td style="width: 100px"></td>
                    </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($carts) == 0){ ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Không có sản phẩm nào trong giỏ hàng</td>
                    </tr>
                <?php }else{ ?>
                    <?php 
                        foreach ($carts as $cart){ 
                    ?>
                        <tr style="border-bottom: 1px solid #bdc0cb;">
                            <td>
                                <center>
                                    <img src="../admins/admincp/images/<?php echo $cart['ImageName']; ?>" width="120" height="120">
                                </center>
                            </td>
                            <td><?php echo $cart['ProductName']; ?></td>
                            <td >
                                <input type="number" name="cart[<?php echo $cart['Cart_id']; ?>][<?php echo $cart['Product_id']; ?>]" value="<?php echo $cart['Quantity']; ?>" min="1" class="w-16 text-center border border-black rounded px-2 py-1">
                            </td>
                            
                            <td style="color:rgb(196, 44, 14); font-weight: bold; font-size: 18px">
                                <strong><?php
                                echo number_format($cart['Price'] * $cart['Quantity'], 0, ',', '.');
                                $total += $cart['Price'] * $cart['Quantity'];
                            ?> đ</strong>
                            </td>
                            <td>
                                <a href="cart/delete_product.php?id=<?php echo $cart['Product_id']; ?>" class="bg-red-500 p-2 pr-6 pl-6 text-white rounded-full hover:bg-red-700">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
                <tr>
                    <td colspan="5" style="text-align: right;">
                        Thành Tiền:
                        <strong style="color:rgb(196, 44, 14); font-weight: bold; font-size: 18px"><?php
                                echo number_format($total, 0, ',', '.');
                            ?> đ</strong>
                    </td>
                </tr>
                <tr>
                <td colspan="3">
                    <a href="index.php"><button type="button" class="border-2 border-gray-500 p-2 pr-6 pl-6 rounded-full text-gray-500 hover:border-gray-600 hover:text-gray-600">Tiếp tục mua sắm</button></a>
                    <button type="submit" class="bg-blue-600 p-2 pr-6 pl-6 rounded-full text-white hover:bg-blue-700" style="width:300px">Cập nhật giỏ hàng</button>
                </td>
                <td colspan="2">
                    <a href="cart/delete_cart.php?id=<?php echo $cart['Cart_id']; ?>" class="bg-red-600 p-2 pr-6 pl-7 rounded-full text-white mr-1">
                        Xóa giỏ hàng
                    </a>
                    <a href="index.php?action=dathang&id=<?php echo $cart['Cart_id'] ?>" class="bg-black p-2 pr-5 pl-5 rounded-full text-white">
                        Đặt hàng
                    </a>
                </td>
            </tr>
            </table>
        </form>

        <!-- Phân trang -->
        <div class="mt-2 text-center space-x-2">
            <?php for ($i = 1; $i <= $pages; $i++){
                $link = "index.php?action=giohang&id=$customer_id&page=$i";
            ?>
                <a href="<?php echo $link; ?>"
                class="inline-block px-4 py-2 border rounded <?php echo ($i == $page ? 'bg-black text-white font-bold' : 'border-gray-300 hover:bg-gray-200'); ?>">
                <?php echo $i; ?>
                </a>
            <?php } ?>
        </div>
        <?php } else { ?>
            <div class="text-center mt-10">
                <h2 class="text-2xl font-bold mb-4">Bạn chưa đăng nhập</h2>
                <p class="mb-4">Vui lòng đăng nhập để xem giỏ hàng của bạn.</p>
            </div>
        <?php } ?>
    </div>
</div>