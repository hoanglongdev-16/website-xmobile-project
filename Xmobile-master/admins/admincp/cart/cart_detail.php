<style>
            h2 {
            text-align: center;
            font-size: 35px;
            color: #333333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 5px 30px;
        }

        .button {
            background-color: #ffc107; 
            color: #121212; 
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 0;
        }
        .back {
            background-color: #1d1919;
            color: #fff;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 0;
        }
        
        .button:hover {
            background-color: #e0a800; /* Màu vàng đậm khi hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #1d1919;
            color: #ffc107;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
            color: #000;
        }

</style>
<?php
    // mở kết nối
    include_once "../../Connection/open.php";
    // Lấy ID sản phẩm từ URL
    $id = $_GET['id'];

    //lấy tên khách hàng dựa vào id
    $sqlCustomers = "SELECT *FROM customers
                    INNER JOIN carts ON customers.Id = carts.Customer_id
                    WHERE carts.Id = $id";
    //chay query
    $customers = mysqli_query($connection, $sqlCustomers);

    //Lấy giá trị đang search
                if(isset($_GET["keyword"])){
                    $keyword = $_GET["keyword"];
                } else {
                    $keyword = "";
                }

    // Cấu hình phân trang
    $recordsPerPage = 2;

    // Đếm tổng số sản phẩm phù hợp
    $sqlCount = "SELECT COUNT(*) AS total 
                FROM carts
                INNER JOIN cart_details ON carts.Id = cart_details.Cart_id
                INNER JOIN products ON products.Id = cart_details.Product_id
                WHERE products.Name LIKE '%$keyword%' AND carts.Id = $id";
    $resultCount = mysqli_query($connection, $sqlCount);
    //Lấy tổng số bản ghi
                foreach ($resultCount as $countRecord) {
                    $totalRecords = $countRecord["total"];
                }
    $pages = ceil($totalRecords / $recordsPerPage);

    // đếm trang
    $pages = ceil($totalRecords / $recordsPerPage);
    // Lấy trang hiện tại
        if(isset($_GET["page"])){
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
    // Vị trí bắt đầu của từng trang
    $start = ($page - 1) * $recordsPerPage;


    // Lấy dữ liệu giỏ hàng
    $sql = "SELECT 
                carts.Customer_id,
                cart_details.Product_id, 
                cart_details.Quantity, 
                carts.Id AS Cart_id,
                products.Name AS ProductName, 
                images.Name AS ImageName, 
                products.Price 
            FROM carts
            INNER JOIN cart_details ON carts.Id = cart_details.Cart_id
            INNER JOIN products ON products.Id = cart_details.Product_id
            LEFT JOIN images ON products.Id = images.Product_id
            WHERE products.Name LIKE '%$keyword%' AND carts.Id = $id
            ORDER BY carts.Customer_id ASC, products.Id DESC
            LIMIT $start, $recordsPerPage";
    // chạy sql
    $carts = mysqli_query($connection, $sql);
    // Đóng kết nối
    include_once "../../Connection/close.php";
?>

<body>
<div class="container mx-auto">
    <?php foreach($customers as $customer){?>
    <h2>Giỏ hàng của: <b style="color: #ffc107"><?php echo $customer['Name'];?> </b></h2>
    <?php } ?>
    <!-- Form tìm kiếm -->
    <form method="GET" action="index.php" class="flex items-center gap-3 mb-3">
        <input type="hidden" name="action" value="chitietdonhang">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="text" name="keyword" placeholder="Nhập từ khóa..." value="<?php echo $keyword ?>"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="button">
            Tìm kiếm
        </button>
    </form>

    <!-- Form cập nhật giỏ hàng -->
    <form method="post" action="cart/update_cart.php">
        <table border="1" width="100%" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th width="50px">Id</th>
                    <th width="300px">Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th width="100px">Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($carts) == 0){ ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Không có sản phẩm nào trong giỏ hàng</td>
                </tr>
            <?php }else{ ?>
                <?php foreach ($carts as $cart){ ?>
                    <tr>
                        <td><?php echo $cart['Product_id']; ?></td>
                        <td><?php echo $cart['ProductName']; ?></td>
                        <td>
                            <img src="images/<?php echo $cart['ImageName']; ?>" width="100px" height="120px">
                        </td>
                        <td>
                            <input type="text" name="cart[<?php echo $cart['Cart_id']; ?>][<?php echo $cart['Product_id']; ?>]" value="<?php echo $cart['Quantity']; ?>" size="2">
                        </td>
                        <td style="color:rgb(196, 44, 14); font-weight: bold; font-size: 18px">
                            <strong><?php echo number_format($cart['Price'] * $cart['Quantity'], 0, ',', '.'); ?> đ</strong>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
            <tr>
                <td colspan="5">
                    <a href="index.php?action=quanlygiohang"><button type="button" class="back">Thoát</button></a>
                </td>
            </tr>
        </table>
    </form>

    <!-- Phân trang -->
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $pages; $i++){
            $link = "index.php?action=chitietgiohang&id=" . $id . "&page=" . $i;
            if (!empty($keyword)) {
                $link .= "&keyword=" . urlencode($keyword);
            }
        ?>
            <a href="<?php echo $link; ?>" 
               style="margin: 0 5px; padding: 5px 10px; text-decoration: none; 
               <?php echo $i == $page ? 'background-color: #ffc107; color: black;' : 'border: 1px solid #ccc;' ?>">
               <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
</div>
</body>
