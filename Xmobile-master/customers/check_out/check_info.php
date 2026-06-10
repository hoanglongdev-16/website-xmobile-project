<?php
// mở kết nối
include_once "../Connection/open.php";
// lấy id của khách hàng đang đăng nhập
$customerId = $_SESSION['customer_id'];
$id = $_GET['id'];
// lấy danh sách phương thức thanh toán
$sql_payment_method = "SELECT * FROM payment_method";
//chạy sql
$payment_methods = mysqli_query($connection, $sql_payment_method);
//lấy thông tin của khách hàng
$sql = "SELECT * FROM customers WHERE Id = $customerId";
//chạy query
$customer = mysqli_query($connection, $sql);
//đóng kết nối
include_once "../Connection/close.php";
?>
<div class="bg-gray-100 flex items-center justify-center min-h-screen px-4" data-aos="fade-up">
    <form action="check_out/check_out.php" method="POST" class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-8">Thông tin người nhận</h2>
        <?php
            foreach ($customer as $customer) {
        ?>
        <!-- Tên người nhận -->
        <div class="mb-5">
            <label class="block text-gray-800 font-medium mb-1">Tên người nhận</label>
            <input type="text" 
            name="receiver_name" 
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="<?php echo $customer['Name']; ?>">
        </div>

        <!-- Địa chỉ -->
        <div class="mb-5">
            <label class="block text-gray-800 font-medium mb-1">Địa chỉ</label>
            <input type="text" 
            name="address" 
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="<?php echo $customer['Address']; ?>">
        </div>

        <!-- Số điện thoại -->
        <div class="mb-5">
            <label class="block text-gray-800 font-medium mb-1">Số điện thoại</label>
            <input type="tel" 
            name="phone" 
            pattern="[0-9]{10,11}" 
            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="<?php echo $customer['Phone']; ?>">
        </div>
        <?php 
            }
        ?>
        <!-- Phương thức thanh toán -->
        <div class="mb-6">
            <label class="block text-gray-800 font-medium mb-1">Phương thức thanh toán</label>
            <select id="payment_method" name="payment_method" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php 
                    foreach ($payment_methods as $payment_method){ 
                ?>
                    <option value="<?php echo $payment_method["Name"]; ?>">
                        <?php echo $payment_method["Name"]; ?>
                    </option>
                <?php 
                    }
                ?>
            </select>
        </div>

        <!-- Nút xác nhận -->
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-200">
            Xác nhận
        </button>
    </form>
</div>

