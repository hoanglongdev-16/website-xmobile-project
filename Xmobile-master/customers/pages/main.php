<main>
<?php
        //lấy giá trị action từ url
        if(isset($_GET["action"])){
            $pages = $_GET["action"];
        } else{
            $pages = "";
        }
        //chi tiết sản phẩm
        if($pages == "chitietsanpham"){
            include_once "content/product_detail.php";
        }elseif($pages == "sanpham"){
            include_once "content/products.php";
        }//trang con gồm (điện thoại, phụ kiện, máy tính bảng)
        elseif($pages == "dienthoai"){
            include_once "content/smart_phone.php";
        }elseif($pages == "phukien"){
            include_once "content/accessory.php";
        }elseif($pages == "maytinhbang"){
            include_once "content/tablet.php";
        }//tin tức
        elseif($pages == "tintuc"){
            include_once "content/news.php";
        }elseif($pages == "chitietbaiviet"){
            include_once "content/news_detail.php";
        }//lien hệ
        elseif($pages == "lienhe"){
            include_once "content/contact.php";
        }//xem tài khoản 
        elseif($pages == "xemtaikhoan"){
            include_once "content/view_account.php";
        }elseif($pages == "suataikhoan"){
            include_once "account/edit.php";
        }//giỏ hàng và đặt hàng
        elseif($pages == "giohang"){
            include_once "content/cart.php";
        }elseif($pages == "dathang"){
            include_once "check_out/check_info.php";
        }elseif($pages == "lichsumuahang"){
            include_once "content/order_history.php";
        }else{
            include_once "pages/content/home.php";
        }
?>
</main>