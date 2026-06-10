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

// Đếm tổng số bản ghi phù hợp
$sqlCount = "SELECT COUNT(*) AS total FROM admin 
             WHERE Name LIKE '%$keyword%' OR Email LIKE '%$keyword%'";
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

// Truy vấn danh sách tài khoản admin theo trang và keyword
$sql_admin = "SELECT * FROM admin 
              WHERE Name LIKE '%$keyword%'
              ORDER BY Id DESC 
              LIMIT $start, $recordsPerPage";
$admins = mysqli_query($connection, $sql_admin);

// Đóng kết nối
include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">

<div class="container mx-auto">
    <h2>Danh sách tài khoản quản trị viên</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="quanlytaikhoanadmin">
        <input type="text" name="keyword" placeholder="Tìm từ khóa..." value="<?php echo $keyword ?>"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <a href="index.php?action=themtaikhoanadmin">
        <button type="button" class="button">
            Thêm tài khoản
        </button>
    </a>

    <table border="1px" cellspacing="0" cellpadding="0" width="80%">
        <thead class="bg-gray-100">
            <tr>
                <th width="50px">Id</th>
                <th>Tên</th>
                <th>Email</th>
                <th width="100px">Sửa</th>
                <th width="100px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin){ ?>
                <tr>
                    <td><?php echo $admin['Id']; ?></td>
                    <td><?php echo $admin['Name']; ?></td>
                    <td><?php echo $admin['Email']; ?></td>
                    <td>
                        <a href="index.php?action=suataikhoanadmin&id=<?php echo $admin['Id']; ?>">Sửa</a>
                    </td>
                    <td>
                        <a href="account_admin/destroy.php?id=<?php echo $admin['Id']; ?>" class="delete">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($page = 1; $page <= $pages; $page++){
            $link = "index.php?action=quanlytaikhoanadmin&page=$page";
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
