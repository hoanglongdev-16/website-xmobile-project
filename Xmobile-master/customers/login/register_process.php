<?php

// Lấy dữ liệu từ form
$name = $_POST["name"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$email = $_POST["email"];
$password = $_POST["password"];

$image = "";

// =======================
// XỬ LÝ UPLOAD ẢNH
// =======================

if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
{
    // Lấy đuôi file
    $extension = strtolower(
        pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)
    );

    // Chỉ cho phép các định dạng này
    $allowed = ["jpg", "jpeg", "png", "webp"];

    if(!in_array($extension, $allowed))
    {
        die("
        <script>
            alert('Chỉ cho phép ảnh JPG, JPEG, PNG, WEBP');
            window.location.href='register.php';
        </script>
        ");
    }

    // Tạo tên ảnh mới tránh trùng
    $image = time() . "_" . basename($_FILES["image"]["name"]);

    // Đường dẫn thư mục uploads
    $upload_path = __DIR__ . "/../../uploads/";

    // Nếu chưa có thư mục uploads thì tạo
    if(!file_exists($upload_path))
    {
        mkdir($upload_path, 0777, true);
    }

    // Upload ảnh
    $upload_success = move_uploaded_file(
        $_FILES["image"]["tmp_name"],
        $upload_path . $image
    );

    // Nếu upload thất bại
    if(!$upload_success)
    {
        die("
        <script>
            alert('Upload ảnh thất bại!');
            window.location.href='register.php';
        </script>
        ");
    }
}

// =======================
// MỞ KẾT NỐI DATABASE
// =======================

include_once(__DIR__ . "/../../connection/open.php");

// =======================
// KIỂM TRA EMAIL TỒN TẠI
// =======================

$checkEmail = "
SELECT COUNT(Id) AS count_id
FROM customers
WHERE Email = '$email'
";

$results = mysqli_query($connection, $checkEmail);

$result = mysqli_fetch_assoc($results);

// =======================
// NẾU EMAIL CHƯA TỒN TẠI
// =======================

if($result['count_id'] == 0)
{
    // SQL thêm tài khoản
    $sql = "
    INSERT INTO customers
    (Name, Phone, Address, Email, Password, Images)
    VALUES
    ('$name', '$phone', '$address', '$email', '$password', '$image')
    ";

    mysqli_query($connection, $sql);

    // Đóng kết nối
    include_once(__DIR__ . "/../../connection/close.php");

    // Chuyển hướng
    header("Location: register.php?success=1");

    exit();
}
else
{
    include_once(__DIR__ . "/../../connection/close.php");

    echo "
    <script>
        alert('Email đã tồn tại!');
        window.location.href='register.php';
    </script>
    ";
}

?>