<?php
//Lấy giá trị đang search
if(isset($_GET["keyword"])){
    $keyword = $_GET["keyword"];
} else {
    $keyword = "";
}

// Mở kết nối
include_once "../../connection/open.php";

// Số bài viết mỗi trang
$recordsPerPage = 5;

// Đếm số bài viết phù hợp
$sqlCount = "SELECT COUNT(*) AS total FROM news WHERE Title LIKE '%$keyword%'";
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

// Truy vấn bài viết
$sql_products = "SELECT * FROM news 
                 WHERE Title LIKE '%$keyword%' 
                 ORDER BY Id DESC 
                 LIMIT $start, $recordsPerPage";
$products = mysqli_query($connection, $sql_products);

// Đóng kết nối
include_once "../../connection/close.php";
?>

<link rel="stylesheet" href="css/style_table.css">
<div class="container mx-auto">
    <h2>Danh sách bài viết</h2>

    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="quanlybaiviet">
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword ?>"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-200">
            Tìm kiếm
        </button>
    </form>

    <a href="index.php?action=thembaiviet">
        <button type="button" class="button">Thêm bài viết</button>
    </a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th width="50px">Id</th>
                    <th>Tên bài viết</th>
                    <th width="180px">Thông tin bài viết</th>
                    <th width="70px">Sửa</th>
                    <th width="70px">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product){ ?>
                    <tr>
                        <td><?php echo $product['Id']; ?></td>
                        <td><?php echo $product['Title']; ?></td>
                        <td><a href="index.php?action=chitietbaiviet&id=<?php echo $product['Id']; ?>">Xem chi tiết</a></td>
                        <td><a href="index.php?action=suabaiviet&id=<?php echo $product['Id']; ?>">Sửa</a></td>
                        <td><a href="news/destroy.php?id=<?php echo $product['Id']; ?>" class="delete">Xóa</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($page = 1; $page <= $pages; $page++){
            $link = "index.php?action=quanlybaiviet&page=$page";
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
