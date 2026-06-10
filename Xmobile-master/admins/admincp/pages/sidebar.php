<nav id="sidebar">
			<div class="p-4">
				<a href="../../customers/index.php">
		  		<p style="font-size: 15px; color: #f8b739; font-weight: bold; text-align: center">
				  <svg fill="#f8b739" height="80px" width="80px" xmlns="http://www.w3.org/2000/svg" class="inputIcon" viewBox="0 0 448 512">
            			<path d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z"/>
        			</svg>
					<a> Xin chào,
					<?php
						echo isset($_SESSION['admin_name'])
						? $_SESSION['admin_name']
							: 'ADMIN';
					?>
					</a>
				</p>
				</a>
	        <ul class="list-unstyled components mb-5">
	          <li >
	            <a href="index.php?action=quanlytaikhoanadmin">Quản lý tài khoản quản trị viên</a>
	          </li>
			  <li >
	            <a href="index.php?action=quanlytaikhoankhachhang">Quản lý tài khoản khách hàng</a>
	          </li>
	          <li>
	            <a href="index.php?action=quanlysanpham">Quản lý Sản phẩm</a>
	          </li>
			  <li>
	            <a href="index.php?action=quanlythuonghieu">Quản lý thương hiệu</a>
	          </li>
			  <li>
	            <a href="index.php?action=quanlyphanloaisp">Phân loại sản phẩm</a>
	          </li>
			  <li>
	            <a href="index.php?action=quanlyphuongthucthanhtoan">Phương thức thanh toán</a>
	          </li>
              <li>
              	<a href="index.php?action=quanlybaiviet">Bài viết & Tin tức</a>
	          </li>
	          <li>
              	<a href="index.php?action=quanlygiohang">Giỏ hàng</a>
	          </li>
			  <li>
              	<a href="index.php?action=quanlydonhang">Đơn hàng</a>
	          </li>
			  <li>
              	<a href="../logout.php">Đăng xuất</a>
	          </li>
	        </ul>
	      </div>
    	</nav>