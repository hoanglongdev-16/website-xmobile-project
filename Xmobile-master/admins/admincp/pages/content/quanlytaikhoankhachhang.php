<?php
//Lấy giá trị đang search
if(isset($_GET["keyword"])){
    $keyword = $_GET["keyword"];
} else {
    $keyword = "";
}

// Mở kết nối
include_once "../../connection/open.php";

// Số bản ghi mỗi trang
$recordsPerPage = 5;

// Đếm tổng số khách hàng phù hợp với keyword
$sqlCount = "SELECT COUNT(*) AS total FROM customers 
             WHERE Name LIKE '%$keyword%' 
                OR Email LIKE '%$keyword%' 
                OR Phone LIKE '%$keyword%' 
                OR Address LIKE '%$keyword%'";
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

// Truy vấn danh sách khách hàng có phân trang và tìm kiếm
$sql_customer = "SELECT * FROM customers 
                 WHERE Name LIKE '%$keyword%' 
                    OR Email LIKE '%$keyword%' 
                    OR Phone LIKE '%$keyword%' 
                    OR Address LIKE '%$keyword%' 
                 ORDER BY Id DESC 
                 LIMIT $start, $recordsPerPage";
$customers = mysqli_query($connection, $sql_customer);

// Đóng kết nối
include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">

<div class="container mx-auto">
    <h2>Danh sách tài khoản khách hàng</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="quanlytaikhoankhachhang">
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword ?>"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <a href="index.php?action=themtaikhoankhachhang">
        <button type="button" class="button">
            Thêm tài khoản
        </button>
    </a>

    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="text-align: center; font-size:16px;">
        <thead class="bg-gray-100">
            <tr>
                <th width="50px">Id</th>
                <th>Ảnh đại diện</th>
                <th>Tên</th>
                <th>Xem chi tiết</th>
                <th width="100px">Sửa</th>
                <th width="100px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer){ ?>
                <tr>
                    <td><?php echo $customer['Id']; ?></td>
                    <td>
                        <?php 
                            //nếu khách hàng không có ảnh đại diện thì hiển thị ảnh mặc định
                            if($customer["Images"] == NULL){
                        ?>
                            <img src="../../customers/images/header/avatar.webp" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        <?php } else { ?>
                            <img src="images/<?php echo $customer["Images"] ?>" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        <?php }?>
                    </td>
                    <td><?php echo $customer['Name']; ?></td>
                    <td>
                        <a href="index.php?action=xemchitiettaikhoankhachhang&id=<?php echo $customer['Id']; ?>">Xem chi tiết</a>
                    </td>
                    <td>
                        <a href="index.php?action=suataikhoankhachhang&id=<?php echo $customer['Id']; ?>">Sửa</a>
                    </td>
                    <td>
                        <a href="account_customers/destroy.php?id=<?php echo $customer['Id']; ?>" class="delete">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($page = 1; $page <= $pages; $page++){
            $link = "index.php?action=quanlytaikhoankhachhang&page=$page";
            if (!empty($keyword)) {
                $link .= "&keyword=" . urlencode($keyword);
            }
        ?>
            <a href="<?php echo $link; ?>" 
            style="margin: 0 5px; padding: 5px 10px; text-decoration: none;
            <?php echo $page == $page ? 'background-color: #ffc107; color: black;' : 'border: 1px solid #ccc;' ?>">
            <?php echo $page; ?>
            </a>
        <?php } ?>
    </div>
</div>
