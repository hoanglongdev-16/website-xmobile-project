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
$sqlCount = "SELECT COUNT(*) AS total FROM brands WHERE Name LIKE '%$keyword%'";
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

// Truy vấn dữ liệu phân trang + tìm kiếm
$sql_brands = "SELECT * FROM brands 
               WHERE Name LIKE '%$keyword%' 
               ORDER BY Id DESC 
               LIMIT $start, $recordsPerPage";
$brands = mysqli_query($connection, $sql_brands);

// Đóng kết nối
include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">

<div class="container mx-auto">
    <h2>Danh sách thương hiệu</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="quanlythuonghieu">
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword ?>"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <a href="index.php?action=themthuonghieu">
        <button type="button" class="button">Thêm thương hiệu</button>
    </a>

    <table border="1" cellpadding="5" cellspacing="0" width="100%" style="text-align: center; font-size:16px;">
        <thead class="bg-gray-100">
            <tr>
                <th width="50px">Id</th>
                <th>Tên thương hiệu</th>
                <th width="100px">Sửa</th>
                <th width="100px">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand){ ?>
                <tr>
                    <td><?php echo $brand['Id']; ?></td>
                    <td><?php echo $brand['Name']; ?></td>
                    <td>
                        <a href="index.php?action=suathuonghieu&id=<?php echo $brand['Id']; ?>">Sửa</a>
                    </td>
                    <td>
                        <a href="Brands/destroy.php?id=<?php echo $brand['Id']; ?>" class="delete">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $pages; $i++) {
            $link = "index.php?action=quanlythuonghieu&page=$i";
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
