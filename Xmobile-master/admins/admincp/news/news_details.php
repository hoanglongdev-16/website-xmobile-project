<link rel="stylesheet" href="css/style_table.css">
<?php
// Mở kết nối
include_once "../../connection/open.php";

// Lấy ID bài viết từ URL
$id = $_GET['id'];

if ($id) {
    // Truy vấn chi tiết bài viết theo ID
    $sql_news = "SELECT news.*, images_news.Name AS ImageNews 
                 FROM news 
                 INNER JOIN images_news ON images_news.News_id = news.Id 
                 WHERE news.Id = $id";
    $news_result = mysqli_query($connection, $sql_news);
}

// Đóng kết nối
include_once "../../connection/close.php";
?>

<div class="max-w-4xl mx-auto px-6 py-8">
    <h2 class="text-center text-[35px] text-[#333] font-bold mb-6">Chi tiết bài viết</h2>

    <?php foreach ($news_result as $news): ?>
        <h3 class="text-center text-2xl font-semibold text-gray-800 mb-4"><?php echo $news['Title']; ?></h3>

        <table class="w-full border-collapse text-[16px] mt-4 shadow-lg">
            <tr class="bg-[#1d1919] text-[#ffc107] font-bold">
                <th class="border border-gray-300 px-4 py-3" width="30%">Ảnh bài viết</th>
                <td class="border border-gray-300 bg-[#f9f9f9] px-4 py-3">
                    <img src="images/<?php echo $news['ImageNews']; ?>" alt="news image" style="width: 200px;">
                </td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-3">Tiêu đề</th>
                <td class="border border-gray-300 px-4 py-3"><?php echo $news['Title']; ?></td>
            </tr>
            <tr>
                <th class="border border-gray-300 px-4 py-3">Nội dung</th>
                <td class="border border-gray-300 px-4 py-3"><?php echo nl2br($news['Content']); ?></td>
            </tr>
        </table><br>
        <center>
        <div class="flex justify-center gap-4">
            <a href="index.php?action=quanlybaiviet">
                <button class="bg-[#ffc107] hover:bg-[#e0a800] text-[#121212] font-semibold px-6 py-2 rounded">Thoát</button>
            </a>
            <a href="index.php?action=suabaiviet&id=<?php echo $news['Id']; ?>">
                <button class="bg-[#ffc107] hover:bg-[#e0a800] text-[#121212] font-semibold px-6 py-2 rounded">Chỉnh sửa</button>
            </a>
        </div>
        </center>
    <?php endforeach; ?>
</div>
