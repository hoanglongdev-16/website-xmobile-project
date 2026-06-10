<?php
$host = "127.0.0.1:3307";
$user = "root";
$pass = "";
$database = "phone_store";

$connection = mysqli_connect($host, $user, $pass, $database);

if (!$connection) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
