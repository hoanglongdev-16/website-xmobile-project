<?php
//lấy id bài viết
$id = $_GET["id"];
//mở kết nối
include_once "../connection/open.php";
//viết sql
$sql_news = "SELECT news.*, images_news.Name AS Image 
        FROM news 
        LEFT JOIN images_news ON news.Id = images_news.News_id 
        WHERE news.Id = $id";
//chạy sql
$news = mysqli_query($connection, $sql_news);

//đóng kết nối
include_once "../connection/close.php";
?>

<link rel="stylesheet" href="css/style_news.css">
<div class="container mx-auto p-4">
    <?php 
        foreach ($news as $news){
    ?>
    <!-- Breadcrumb -->
    <nav class="text-2x1 text-gray-600" data-aos="fade-right">
        <ol class="flex items-center space-x-2 mb-5">
            <li>
                <a href="index.php" class="text-blue-700 hover:underline font-medium">Trang Chủ</a>
            </li>
            <li><span class="text-gray-400">›</span></li>
            <li>
                <a href="index.php?action=tintuc" class="text-blue-700 hover:underline font-medium">Tin Tức Công Nghệ</a>
            </li>
            <li><span class="text-gray-400">›</span></li>
            <li>
                <a href="index.php?action=chitietbaiviet&id=<?php echo $news['Id']; ?>" class="text-blue-700 hover:underline font-medium"><?php echo $news['Title']; ?></a>
            </li>
        </ol>
    </nav>
    <div data-aos="fade-up">
        <img src="../../admins/admincp/images/<?php echo $news['Image']?>" 
                            alt="Ảnh bài viết"
                            class="w-[1100px] mx-auto block rounded-3xl h-full object-cover transition-transform duration-300">
        <div class="prose max-w-none">
            <?php echo $news['Content'] ?>
        </div>
        <div class="mt-6">
            <a href="index.php?action=tintuc" class="text-blue-600 hover:underline">← Quay lại danh sách</a>
        </div>
    </div>
    <?php
        }
    ?>
</div>
