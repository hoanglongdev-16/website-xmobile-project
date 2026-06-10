<?php
//lấy id khách hàng
$customerId = $_SESSION["customer_id"];
// Mở kết nối
include_once "../connection/open.php";

// Lấy thông tin tài khoản người dùng
$sql = "SELECT * FROM customers WHERE Id = $customerId";
//chạy query
$customer = mysqli_query($connection, $sql);

// Đóng kết nối
include_once "../connection/close.php";
?>
<div class="container mx-auto max-w-2xl px-6 py-10 bg-white shadow-lg rounded-xl">
    <?php foreach ($customer as $customer) { ?>
        <!-- Ảnh đại diện -->
        <div class="flex flex-col items-center mb-6">
            <?php 
                //nếu khách hàng không có ảnh đại diện thì hiển thị ảnh mặc định

$imagePath = "";

if(
    isset($customer["Images"]) &&
    trim($customer["Images"]) != "" &&
    file_exists(
        $_SERVER['DOCUMENT_ROOT'] .
        "/Ban_DienThoai/Xmobile-master/uploads/" .
        trim($customer["Images"])
    )
){
    $imagePath =
    "/Ban_DienThoai/Xmobile-master/uploads/" .
    trim($customer["Images"]);

}else{
    $imagePath =
    "/Ban_DienThoai/Xmobile-master/images/header/avatar.webp";
}

?>

<img 
    src="<?php echo $imagePath; ?>"
    class="w-32 h-32 rounded-full object-cover border-4 border-gray-300 shadow-md mb-3"
>
            <h2 class="text-xl font-semibold text-gray-800">Thông tin tài khoản của bạn</h2>
        </div>

        <!-- Bảng thông tin -->
        <div class="overflow-hidden rounded-lg border border-gray-300">
            <table class="w-full text-sm text-left">
                <tbody>
                    <tr class="border-b">
                        <th class="p-3 bg-gray-100 w-1/3 font-medium text-gray-700">Họ và tên:</th>
                        <td class="p-3"><?php echo $customer['Name']; ?></td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-3 bg-gray-100 font-medium text-gray-700">Email:</th>
                        <td class="p-3"><?php echo $customer['Email']; ?></td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-3 bg-gray-100 font-medium text-gray-700">Mật khẩu:</th>
                        <td class="p-3">*********</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-3 bg-gray-100 font-medium text-gray-700">Số điện thoại:</th>
                        <td class="p-3"><?php echo $customer['Phone']; ?></td>
                    </tr>
                    <tr>
                        <th class="p-3 bg-gray-100 font-medium text-gray-700">Địa chỉ:</th>
                        <td class="p-3"><?php echo $customer['Address']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- Nút hành động -->
    <div class="flex justify-center gap-4 mt-6">
        <a href="index.php?action=suataikhoan" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded transition">
            Sửa thông tin
        </a>
        <a href="login/logout.php" 
           class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded transition">
            Đăng xuất
        </a>
    </div>
</div>

