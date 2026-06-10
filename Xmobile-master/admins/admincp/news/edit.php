<link rel="stylesheet" href="css/style_create_edit.css">

<?php
    // Lấy ID bài viết
    $id = $_GET['id'];

    // Mở kết nối
    include_once "../../connection/open.php";

    // Lấy dữ liệu bài viết theo ID
    $sql = "SELECT news.*, images_news.Name AS ImageName 
            FROM news 
            LEFT JOIN images_news ON images_news.News_id = news.Id
            WHERE news.Id = '$id'";
    $result = mysqli_query($connection, $sql);

    // Đóng kết nối
    include_once "../../connection/close.php";
?>

<h2>Sửa bài viết</h2>

<form method="post" action="news/update.php" enctype="multipart/form-data">
    <?php foreach ($result as $news) { ?>
    <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" readonly value="<?php echo $news['Id']; ?>">
        </div>

    <div class="form-group">
        <label for="image">Ảnh bài viết: &nbsp;&nbsp;<img src="images/<?php echo $news["ImageName"]?> " style="width: 150px;">
        </label><input type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <label for="title">Tiêu đề:</label>
        <input type="text" name="title" id="title" value="<?php echo $news['Title']; ?>">
    </div>

    <div class="form-group">
        <label for="content">Nội dung:</label>
        <textarea name="content" id="Description" rows="5" cols="20"><?php echo $news['Content']; ?></textarea>
    </div>

    <div class="form-buttons">
        <a href="index.php?action=quanlybaiviet"><button type="button">Thoát</button></a>
        <button type="submit">Cập nhật bài viết</button>
    </div>
    <?php } ?>
</form>
