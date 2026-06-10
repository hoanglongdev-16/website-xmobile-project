<?php 
 
  // mở Kết nối
  include_once "../connection/open.php";
  //Lấy giá trị đang search
  if(isset($_GET["keyword"])){
      $keyword = $_GET["keyword"];
  } else {
      $keyword = "";
  }
  $sql = "SELECT * FROM products WHERE Name LIKE '%$keyword%'";
  $result = mysqli_query($connection, $sql);
?>
<header class="sticky top-0 z-[1000] w-full bg-white shadow-md">
  <!-- <img src="images/header/header.png" alt="Top banner" class="w-full object-contain object-center aspect-[41.67]" /> -->
  <nav class="w-full bg-white shadow-md">
    <div class="mx-auto flex max-w-[1265px] items-center justify-between gap-5 px-5 py-[22px]">
      <!-- Logo -->
      <a href="index.php" class="flex-shrink-0 self-start">
        <img src="images/menu/xmobile.png" alt="Company logo" class="w-[151px] object-contain object-center aspect-[3.36]" />
      </a>
      <!-- Navigation Links -->
      <ul class="flex flex-wrap items-center gap-[35px] text-center text-[14px] font-semibold text-black font-[Poppins,sans-serif]">
        <li><a href="index.php?action=dienthoai" class="text-[16px] pb-1 transition-all hover:text-blue-600 hover:border-b-2 hover:border-blue-600">Điện thoại</a></li>
        <li><a href="index.php?action=phukien" class="text-[16px] pb-1 transition-all hover:text-blue-600 hover:border-b-2 hover:border-blue-600">Phụ kiện</a></li>
        <li><a href="index.php?action=maytinhbang" class="text-[16px] pb-1 transition-all hover:text-blue-600 hover:border-b-2 hover:border-blue-600">Máy tính bảng</a></li>
        <li><a href="index.php?action=tintuc" class="text-[16px] pb-1 transition-all hover:text-blue-600 hover:border-b-2 hover:border-blue-600">Tin tức công nghệ</a></li>
        <li><a href="index.php?action=lienhe" class="text-[16px] pb-1 transition-all hover:text-blue-600 hover:border-b-2 hover:border-blue-600">Liên hệ</a></li>
      </ul>
      <!-- Search Bar -->
      <div class="flex items-center">
        <form method="GET" action="index.php" class="relative flex h-[42px] w-[260px] items-center rounded-full border border-black/10 bg-white shadow-sm">
          <input type="hidden" name="action" value="sanpham" />
          <input 
            type="text" 
            name="keyword" 
            placeholder="Tìm kiếm sản phẩm..." 
            value="<?php echo $keyword; ?>"
            class="w-full border-none bg-transparent px-4 py-3 pr-12 text-[16px] focus:outline-none" 
          />
          <button type="submit" class="absolute right-3" aria-label="Search">
            <img src="images/menu/search.svg" alt="Search icon" class="h-[22px] w-[22px] object-contain" />
          </button>
        </form>
      </div>
       <!-- User Actions -->
      <div class="flex items-center gap-[18px]">
        <!-- Cart -->
         <a href="index.php?action=giohang">
          <button class="p-0" aria-label="Shopping cart">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                class="w-[28px] object-contain aspect-square fill-[#000]">
              <path d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48l45.5 0c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5L488 384c13.3 0 24-10.7 24-24s-10.7-24-24-24l-288.3 0c-11.5 0-21.4-8.2-23.6-19.5L170.7 288l288.5 0c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32l-411 0C111 12.8 91.6 0 69.5 0L24 0zM131.1 80l389.6 0L482.4 222.2c-2.8 10.5-12.3 17.8-23.2 17.8l-297.6 0L131.1 80zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/>
            </svg>
          </button>
        </a>
          <!-- Đăng nhập -->
          <div class="flex items-center h-[45px]">
            <?php 
              //kiểm tra xem người dùng đã đăng nhập hay chưa
              if(isset($_SESSION['customer_email'])){
                //lấy email của khách hàng từ session
                $customer_email = $_SESSION['customer_email'];
                //truy vấn để lấy thông tin khách hàng từ cơ sở dữ liệu
                $sqlcustomers = "SELECT * FROM customers WHERE Email = '$customer_email'";
                //thực hiện truy vấn
                $customers = mysqli_query($connection, $sqlcustomers);
                //lấy thông tin khách hàng
                foreach($customers as $customer){
            ?>
              <div class="relative z-[1001] pl-4">
<?php 
// nếu khách hàng không có ảnh đại diện thì hiển thị ảnh mặc định


$imagePath = "";

if(
    isset($customer["Images"]) &&
    trim($customer["Images"]) != "" &&
    file_exists(
        $_SERVER['DOCUMENT_ROOT'] .
        "/Ban_DienThoai/Xmobile-master/uploads/" .
        trim($customer["Images"])
    )
){
    $imagePath =
    "/Ban_DienThoai/Xmobile-master/uploads/" .
    trim($customer["Images"]);

}else{
    $imagePath =
    "/Ban_DienThoai/Xmobile-master/images/header/avatar.webp";
}

?>

<button id="profileBtn" class="p-0" aria-label="User profile">

    <img
        src="<?php echo $imagePath; ?>"
        style="
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        "
    />

</button>

<div id="dropdownMenu"
     class="absolute right-0 mt-2 hidden min-w-[160px] rounded-lg border border-gray-200 bg-white shadow-lg">

    <a href="index.php?action=xemtaikhoan"
       class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 hover:rounded-t-lg">

       Xem tài khoản

    </a>

    <a href="login/logout.php"
       class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 hover:rounded-b-lg">

       Đăng xuất

    </a>
</div>
            <?php }}else{ ?>
              <a href="login/login.php"
                class="h-[45px] px-4 flex items-center justify-center rounded-lg border border-gray-300 bg-white text-sm shadow hover:bg-gray-100">
                Đăng nhập
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
<script src="js/account_menu.js"></script>
