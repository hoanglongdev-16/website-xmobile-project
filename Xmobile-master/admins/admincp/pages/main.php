<div class="main">
<?php
        if(isset($_GET["action"])){
            $pages = $_GET["action"];
        } else{
            $pages = "";
        }
        //quản lý tài khoản quản trị viên
        if($pages == "quanlytaikhoanadmin"){
            include_once "content/quanlytaikhoanadmin.php";
        }else if($pages == "themtaikhoanadmin"){
            include_once "account_admin/create.php";
        }else if($pages == "suataikhoanadmin"){
            include_once "account_admin/edit.php";
        }//quản lý tài khoản khách hàng
        else if($pages == "quanlytaikhoankhachhang"){
            include_once "content/quanlytaikhoankhachhang.php";
        }else if($pages == "xemchitiettaikhoankhachhang"){
            include_once "account_customers/account_customer_detail.php";
        }else if($pages == "themtaikhoankhachhang"){
            include_once "account_customers/create.php";
        }else if($pages == "suataikhoankhachhang"){
            include_once "account_customers/edit.php";
        }//quản lý sản phẩm
        else if($pages == "quanlysanpham"){ 
            include_once "content/quanlysanpham.php";
        }else if($pages == "themsanpham"){ 
            include_once "products/create.php";
        }else if($pages == "suasanpham"){ 
            include_once "products/edit.php";
        }else if($pages == "chitietsanpham"){ 
            include_once "products/product_details.php";
        }//quản lý thương hiệu
        else if($pages == "quanlythuonghieu"){ 
            include_once "content/quanlythuonghieu.php";
        }else if($pages == "themthuonghieu"){
            include_once "Brands/create.php";
        }else if($pages == "suathuonghieu"){
            include_once "Brands/edit.php";
        }//quản lý loại sản phẩm
        else if($pages == "quanlyphanloaisp"){
            include_once "content/phanloaisp.php";
        }else if($pages == "themloaisanpham"){
            include_once "types/create.php";
        }else if($pages == "sualoaisanpham"){
            include_once "types/edit.php";
        }//quản lý thanh toán
        else if($pages == "quanlyphuongthucthanhtoan"){
            include_once "content/phuongthucthanhtoan.php";
        }else if($pages == "themphuongthucthanhtoan"){
            include_once "payment_methods/create.php";
        }else if($pages == "suaphuongthucthanhtoan"){
            include_once "payment_methods/edit.php";
        }//quản lý hình ảnh
        else if($pages == "quanlyhinhanh"){ 
            include_once "content/quanlyhinhanh.php";
        }else if($pages == "themhinhanh"){ 
            include_once "images/create.php";
        }else if($pages == "suahinhanh"){ 
            include_once "images/edit.php";
        }//quản lý bài viết
        else if($pages == "quanlybaiviet"){
            include_once "content/news.php";
        }else if($pages == "thembaiviet"){
            include_once "news/create.php";
        }else if($pages == "suabaiviet"){
            include_once "news/edit.php";
        }else if($pages == "chitietbaiviet"){ 
            include_once "news/news_details.php";
        }//quản lý giỏ hàng
        else if($pages == "quanlygiohang"){
            include_once "content/cart.php";
        }else if($pages == "chitietgiohang"){
            include_once "cart/cart_detail.php";
        }else if($pages == "xoagiohang"){
            include_once "cart/delete_carts.php";
        }//quản lý đơn hàng
        else if($pages == "quanlydonhang"){
            include_once "content/checkout.php";
        }else if($pages == "chitietdonhang"){
            include_once "check_out/order_detail.php";
        }else{
            include_once "content/dashboard.php";
        }
    ?>
</div>