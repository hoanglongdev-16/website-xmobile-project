-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 02:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phone_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `Email`, `Password`) VALUES
(1, 'Admin', 'admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`Id`, `Name`) VALUES
(1, 'Apple'),
(7, 'Nokia'),
(4, 'Oppo'),
(6, 'Realme'),
(2, 'Samsung'),
(5, 'Vivo'),
(3, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `Id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`Id`, `Customer_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `Id` int(11) NOT NULL,
  `Cart_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Id`, `Name`, `Phone`, `Address`, `Email`, `Password`, `Images`) VALUES
(1, 'Nguyễn Văn A', '0901234567', 'Hà Nội', 'a@gmail.com', '123456', NULL),
(2, 'demo1', '0389125833', 'vĩnh hưng hoàng mai hà nội', 'demo2@gmail.com', '123456', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`Id`, `Name`, `Product_id`) VALUES
(1, 'iphone-17-pro-1tb-cam-6-638930820695610962-750x500.jpg', 1),
(2, 'iphone-16e-white-4-638756438261020654-750x500.jpg', 2),
(3, 'xiaomi-15t-pro-gold-1-638944309378092929-750x500.jpg', 3),
(4, 'sac-du-phong-15000mah-khong-day-magnetic-100w-xmobile-jp339-1-638914508411762348-750x500.jpg', 4),
(5, 'oppo-pad-se-nham-bac-1-638889655186313001-750x500.jpg', 5),
(6, 'motorola-moto-g35-5g-xanh-la-4-638980341459267808-750x500.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `images_news`
--

CREATE TABLE `images_news` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `News_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Order_date` date NOT NULL,
  `Order_status` tinyint(4) DEFAULT 0,
  `Delivery_location` text NOT NULL,
  `Receiver_name` varchar(255) NOT NULL,
  `Receiver_phone` varchar(20) NOT NULL,
  `Payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `Customer_id`, `Order_date`, `Order_status`, `Delivery_location`, `Receiver_name`, `Receiver_phone`, `Payment_method`) VALUES
(1, 2, '2025-12-10', 1, 'thanh lân thanh trì hoàng mai hà nội', 'demo1', '0389115833', 'Thanh toán khi nhận hàng (COD)'),
(2, 2, '2025-12-11', 0, 'thanh lân thanh trì hoàng mai hà nội', 'demo1', '0389115833', 'Thanh toán qua ZaloPay'),
(3, 2, '2025-12-11', 0, 'vĩnh hưng hoàng mai hà nội', 'demo1', '0389125833', 'Thanh toán khi nhận hàng (COD)');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `Id` int(11) NOT NULL,
  `Order_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`Id`, `Order_id`, `Product_id`, `Quantity`, `Price`) VALUES
(1, 1, 1, 1, 48000000.00),
(2, 2, 2, 1, 24000000.00),
(3, 3, 1, 1, 48000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`Id`, `Name`) VALUES
(2, 'Chuyển khoản ngân hàng (MB Bank STK:123XXX456)'),
(1, 'Thanh toán khi nhận hàng (COD)');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(15,2) NOT NULL,
  `Ram` varchar(50) DEFAULT NULL,
  `Chip` varchar(100) DEFAULT NULL,
  `Rom` varchar(50) DEFAULT NULL,
  `Sim` varchar(100) DEFAULT NULL,
  `Mobile_Network` varchar(100) DEFAULT NULL,
  `Resolution` varchar(100) DEFAULT NULL,
  `Screen_size` varchar(50) DEFAULT NULL,
  `Camera` text DEFAULT NULL,
  `Operating_System` varchar(100) DEFAULT NULL,
  `Battery_Capacity` varchar(50) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Brand` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Price`, `Ram`, `Chip`, `Rom`, `Sim`, `Mobile_Network`, `Resolution`, `Screen_size`, `Camera`, `Operating_System`, `Battery_Capacity`, `Color`, `Brand`, `Type`, `Description`) VALUES
(1, 'Điện thoại iPhone 17 Pro 1TB', 48000000.00, '12', 'Apple A19 Pro 6 nhân', '1tb', '1 Nano SIM & 1 eSIM', '5g', 'Super Retina XDR (1206 x 2622 Pixels)', '6.3', 'Smart HDR 5 Xóa phông Video hiển thị kép', 'iOS 26', '5000', 'cam', 1, 1, 'Đặc điểm nổi bật của iPhone 17 Pro\r\n• Khung nhôm nguyên khối chắc chắn, diện mạo mới mẻ.\r\n• Hình ảnh sắc nét, trơn tru trên màn hình ProMotion viền mỏng.\r\n• Bộ ba camera 48 MP cùng zoom quang 8x cho trải nghiệm nhiếp ảnh chuyên nghiệp.\r\n• Chip A19 Pro tích hợp tản nhiệt buồng hơi, duy trì hiệu suất vượt trội.\r\n• Pin dung lượng cao, xem video đến 31 giờ.'),
(2, 'Điện thoại iPhone 16e 512GB', 24000000.00, '8gb', 'Apple A18 6 nhân', '512gb', '', '5g', 'Super Retina XDR (1170 x 2532 Pixels)', '6.3', '12 MP', 'iOS 26', '5012', 'đen', 1, 1, 'iPhone 16e 512GB mang đến những công nghệ tiên tiến của iPhone 16 với mức giá hợp lý. Được ra mắt vào tháng 2/2025, sản phẩm này sở hữu bộ nhớ ROM lớn, công nghệ Apple Intelligence tiện lợi, hệ thống camera 2 trong 1 độc đáo và thời lượng pin lâu, hứa hẹn là lựa chọn lý tưởng cho người dùng hiện đại.'),
(3, 'Điện thoại Xiaomi 15T Pro 5G 12GB/256GB', 19000000.00, '8gb', 'MediaTek Dimensity 9400+ 8 nhân', '256gb', '1 Nano SIM & 1 eSIM', '5g', '1.5K (1280 x 2772 Pixels)', '6.83\" - Tần số quét 144 Hz', 'Chính 50 MP & Phụ 50 MP, 12 MP', 'Android 15', '5000', 'nâu', 3, 1, ''),
(4, 'Pin sạc dự phòng 15000mAh Không dây ', 1300000.00, '', '', '', '', '', '', '', '', '', '15000', 'trắng', 3, 3, '54 %\r\nLõi pin:\r\nLi-Ion\r\nCông nghệ/Tiện ích:\r\nMàn hình LED báo hiệu\r\nPower Delivery\r\nQuick Charge 3.0\r\nSạc không dây chuẩn Qi2\r\nThời gian sạc đầy pin:\r\nKhoảng 2.5 giờ (dùng Adapter 30W)\r\nNguồn ra:\r\nUSB: 5V - 3A, 9V - 2A, 10V - 2.25A, 12V - 1.75A (22.5W max)\r\nSạc không dây 15W\r\nType C1/C2: 5V - 3A, 9V - 3A, 12V - 3A, 15V - 3A, 20V - 5A (Max 100W)\r\nNguồn vào:\r\nType C1/C2: 5V - 3A, 9V - 3A, 12V - 3A, 15V - 3A, 20V - 3.25A (Max 65W)\r\nKích thước:\r\nDày 5.2 cm - Rộng 5.3 cm - Dài 11.6 cm\r\nKhối lượng:\r\n456 g\r\nThương hiệu của:\r\nThế Giới Di Động\r\nSản xuất tại:\r\nTrung Quốc\r\nHãng:\r\nXmobile. Xem thông tin hãng'),
(5, 'Máy tính bảng OPPO Pad SE', 5500000.00, '12gb', ' MediaTek Helio G100 8 nhân', '512gb', '1 Nano SIM & 1 eSIM', '4g', '1200 x 2000 Pixels', '11\" - Tần số quét 90 Hz', '5 MP Quay phim: HD 720p@30fps FullHD 1080p@30fps', 'Android 15', '9340', 'trắng', 4, 2, '1/14\r\nThế Giới Di Động cam kết\r\nchính sách bảo hành\r\n1 đổi 1 trong 30 ngày đối với sản phẩm lỗi tại 2961 siêu thị toàn quốc Xem chi tiết\r\n\r\nchính sách bảo hành\r\nBộ sản phẩm gồm: Sách hướng dẫn, Hộp máy, Cáp Type C - Type C\r\n\r\nchính sách bảo hành\r\nBảo hành chính hãng máy tính bảng 1 năm tại các trung tâm bảo hành hãng Xem địa chỉ bảo hành\r\n\r\nTham khảo thêm sản phẩm cũ, trưng bày\r\nMáy tính bảng OPPO Pad SE WiFi màn hình nhám 4GB/128GB\r\nMáy tính bảng OPPO Pad SE WiFi màn hình nhám 4GB/128GB\r\n\r\nGiá từ 3.860.000₫ -34%\r\nBảo hành Chính hãng đến 14/09/2026\r\nThông số kỹ thuật Thông tin sản phẩm\r\nOPPO Pad SE màn hình nhám mang đến trải nghiệm đỉnh cao cho cả gia đình bạn. Tận hưởng giải trí sống động, học tập hiệu quả và làm việc mượt mà trên mọi tác vụ. Đặc biệt, với chế độ trẻ em an toàn tích hợp, phụ huynh hoàn toàn an tâm quản lý thời gian, kiểm soát nội dung và bảo vệ tối đa thị lực nhạy cảm của bé.'),
(6, 'Điện thoại Motorola G35 5G 4GB/128GB', 6000000.00, '8gb', 'Unisoc T760 8 nhân', '128gb', '1 Nano SIM & 1 eSIM', '5g', 'Full HD+ (1080 x 2400 Pixels)', '6.7\" - Tần số quét 120 Hz', '50mp', 'Android 15', '5000', 'xanh lá cây', 2, 1, 'Đặc điểm nổi bật Motorola G35 5G\r\nMàn hình 6.7 inch Full HD+ 120 Hz hiển thị rõ nét ngay cả dưới nắng gắt.\r\nCamera 50 MP chụp nét mọi sáng, kèm góc siêu rộng 8 MP và quay 4K.\r\nHiệu năng ổn định với chip 8 nhân, RAM 4 GB và RAM Boost, kèm 5G tốc độ cao.\r\nPin 5000 mAh dùng cả ngày, kèm sạc nhanh 20W tiện lợi.');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`Id`, `Name`) VALUES
(1, 'Điện thoại'),
(2, 'Máy tính bảng'),
(3, 'Phụ kiện');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Cart_id` (`Cart_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `idx_customer_email` (`Email`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `images_news`
--
ALTER TABLE `images_news`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `News_id` (`News_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Customer_id` (`Customer_id`),
  ADD KEY `idx_order_date` (`Order_date`),
  ADD KEY `idx_order_status` (`Order_status`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Order_id` (`Order_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Brand` (`Brand`),
  ADD KEY `Type` (`Type`),
  ADD KEY `idx_product_name` (`Name`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images_news`
--
ALTER TABLE `images_news`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`Cart_id`) REFERENCES `carts` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `products` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `products` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `images_news`
--
ALTER TABLE `images_news`
  ADD CONSTRAINT `images_news_ibfk_1` FOREIGN KEY (`News_id`) REFERENCES `news` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `products` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Brand`) REFERENCES `brands` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`Type`) REFERENCES `types` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
