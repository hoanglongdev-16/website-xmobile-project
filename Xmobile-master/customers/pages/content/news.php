<?php
//mở kết nối
include_once "../connection/open.php";

// Cấu hình phân trang
$recordsPerPage = 5;

// Tổng số bài viết
$sqlCount = "SELECT COUNT(*) AS total FROM news";
$resultCount = mysqli_query($connection, $sqlCount);
$row = mysqli_fetch_assoc($resultCount);
$totalRecords = $row['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);

// Lấy trang hiện tại
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
$start = ($page - 1) * $recordsPerPage;

// Truy vấn bài viết và ảnh bài viết
$sql = "SELECT news.*, images_news.Name AS Image 
        FROM news 
        LEFT JOIN images_news ON news.Id = images_news.News_id 
        ORDER BY news.Id DESC 
        LIMIT $start, $recordsPerPage";
$result = mysqli_query($connection, $sql);

//đóng kết nối
include_once "../connection/close.php";
?>

<div class="max-w-[1200px] mx-auto pt-4">
    <!-- Breadcrumb -->
    <nav class="text-2x1 text-gray-600" data-aos="fade-right">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="index.php" class="text-blue-700 hover:underline font-medium">Trang Chủ</a>
            </li>
            <li><span class="text-gray-400">›</span></li>
            <li>
                <a href="index.php?action=tintuc" class="text-blue-700 hover:underline font-medium">Tin Tức Công Nghệ</a>
            </li>
        </ol>
    </nav>
</div>

<div class="max-w-[1200px] mx-auto p-4">
    <!-- Tin Tức Nổi Bật -->
    <div class="flex items-center justify-between mb-4 border-b-2 border-b-gray-400 pb-3" data-aos="zoom-in">
        <h1 class="text-3xl font-bold text-gray-800">Tin Tức Công Nghê Nổi Bật</h1>
        <a href="index.php?action=tintuc">
            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                Xem tất cả
            </button>
        </a>
    </div>

    <!-- Videos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10" data-aos="fade-up">
        <iframe class="w-full aspect-video rounded-xl shadow-md"
                src="https://www.youtube.com/embed/yDVGOgSTRZ4?si=V0s8l8646ySn4RAi"
                title="YouTube video player"
                frameborder="0"
                allowfullscreen></iframe>

        <iframe class="w-full aspect-video rounded-xl shadow-md"
                src="https://www.youtube.com/embed/mPEoxRnWFzM?si=JcfIX3WS7OgbtpC6"
                title="YouTube video player"
                frameborder="0"
                allowfullscreen></iframe>
    </div>

    <!-- Tin Tức Mới Nhất -->
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8 border-b-2 border-b-gray-400 pb-3" data-aos="zoom-in">Tin Tức Mới Nhất</h2>

    <div class="space-y-8" data-aos="fade-up">
        <?php foreach($result as $news) { ?>
            <div class="flex flex-col md:flex-row bg-white rounded-xl shadow hover:shadow-xl transition duration-300 overflow-hidden border border-gray-200">
                <!-- Ảnh -->
                <div class="md:w-1/3 h-48 md:h-auto">
                    <img src="../admins/admincp/images/<?php echo $news['Image']?>" 
                         alt="Ảnh bài viết"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Nội dung -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-blue-600 hover:underline mb-2">
                            <a href="index.php?action=chitietbaiviet&id=<?php echo $news['Id']; ?>">
                                <?php echo $news['Title']; ?>
                            </a>
                        </h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            <?php echo mb_strimwidth(strip_tags($news['Content']), 0, 250, "..."); ?>
                        </p>
                    </div>
                    <div class="mt-4">
                        <a href="index.php?action=chitietbaiviet&id=<?php echo $news['Id']; ?>" class="text-blue-600 text-sm hover:underline">
                            Đọc thêm →
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Pagination -->
    <div class="mt-2 flex justify-center gap-2 flex-wrap">
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="index.php?action=tintuc&page=<?php echo $i; ?>" 
               class="px-4 py-2 rounded border text-sm font-medium transition 
               <?php echo $i == $page 
                   ? 'bg-black text-white' 
                   : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100'; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>

    <!-- Nút Xem tất cả -->
    <div class="mt-2 text-center">
        <a href="index.php?action=tintuc">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full text-base font-medium shadow-md transition">
                Xem tất cả tin tức →
            </button>
        </a>
    </div>
</div>