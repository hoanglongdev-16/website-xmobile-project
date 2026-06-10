<?php
// Xử lý khi người dùng nhấn gửi form
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $success = true; // Chỉ để hiển thị demo
}
?>
<body>
    <div class="max-w-[1200px] mx-auto pt-4">
    <!-- Breadcrumb -->
    <nav class="text-2x1 text-gray-600" data-aos="fade-right">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="index.php" class="text-blue-700 hover:underline font-medium">Trang Chủ</a>
            </li>
            <li><span class="text-gray-400">›</span></li>
            <li>
                <a href="index.php?action=lienhe" class="text-blue-700 hover:underline font-medium">Liên Hệ</a>
            </li>
        </ol>
    </nav>
</div>
    <div class="w-full max-w-2xl pt-[10px] pb-[20px] pl-[20px] pr-[20px] mb-[10px] bg-white rounded-lg shadow-lg mx-auto" data-aos="fade-up">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Liên Hệ Với Chúng Tôi</h1>

        <?php if ($success){ ?>
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 border border-green-300">
                Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!
            </div>
        <?php } ?>

        <form action="" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Họ tên</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Chủ đề</label>
                <input type="text" name="subject"
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung</label>
                <textarea name="message" rows="8" required
                          class="w-full px-4 py-2 border border-gray-300 rounded resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded shadow">
                    Gửi Liên Hệ
                </button>
            </div>
        </form>
    </div>
</body>