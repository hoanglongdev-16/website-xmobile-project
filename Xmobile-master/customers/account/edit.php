<?php
    //lấy id khách hàng
    $customerId = $_SESSION["customer_id"];
    //mở kết nối
    include_once "../Connection/open.php";
    //lấy thông tin tài khoản người dùng
    $sql = "SELECT * FROM customers WHERE id = '$customerId'";
    //chạy query
    $customers = mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../Connection/close.php";
?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Sửa tài khoản</h2>
    <form method="post" action="account/update.php" enctype="multipart/form-data" class="space-y-6">
        <?php foreach ($customers as $customer) { ?>
            <div class="flex flex-col items-center gap-3">
                <?php 
                    //nếu khách hàng không có ảnh đại diện thì hiển thị ảnh mặc định
                  
    // nếu khách hàng không có ảnh
    if($customer["Images"] == NULL){
?>
<img src="images/header/avatar.webp"
     class="w-32 h-32 rounded-full object-cover border-4 border-gray-300">

<?php } else { ?>

<img src="/Ban_DienThoai/Xmobile-master/uploads/<?php echo trim($customer["Images"]); ?>" 
     class="w-32 h-32 rounded-full object-cover border-4 border-gray-300">
<?php } ?>
                <input type="file" name="image" id="image" class="mt-2">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                <div>
                    <label for="id" class="block mb-1 font-medium">ID:</label>
                    <input type="text" name="id" id="id" readonly 
                           value="<?php echo $customer['Id']; ?>" 
                           class="w-full border px-3 py-2 rounded bg-gray-100">
                </div>
                <div>
                    <label for="Name" class="block mb-1 font-medium">Tên Đăng Nhập:</label>
                    <input type="text" name="Name" id="Name" 
                           value="<?php echo $customer['Name']; ?>" 
                           class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label for="Phone" class="block mb-1 font-medium">Số Điện Thoại:</label>
                    <input type="text" name="Phone" id="Phone" 
                           value="<?php echo $customer['Phone']; ?>" 
                           class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label for="Address" class="block mb-1 font-medium">Địa Chỉ:</label>
                    <input type="text" name="Address" id="Address" 
                           value="<?php echo $customer['Address']; ?>" 
                           class="w-full border px-3 py-2 rounded">
                </div>
                <div>
                    <label for="Email" class="block mb-1 font-medium">Email:</label>
                    <input type="text" name="Email" id="Email" 
                           value="<?php echo $customer['Email']; ?>" 
                           class="w-full border px-3 py-2 rounded ">
                </div>
                <div>
                    <label for="Password" class="block mb-1 font-medium">Mật Khẩu:</label>
                    <input type="password" name="Password" id="Password" 
                           value="<?php echo $customer['Password']; ?>" 
                           class="w-full border px-3 py-2 rounded">
                </div>
            </div>

            <div class="flex justify-center gap-4 mt-8">
                <a href="index.php?action=index.php" 
                   class="px-5 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                    Thoát
                </a>
                <button type="submit" 
                        class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Cập nhật
                </button>
            </div>
        <?php } ?>
    </form>
</div>
