<?php
// Số sản phẩm hiển thị trên mỗi trang
$soSanPhamTrenMotTrang = 10;

// Trang hiện tại (mặc định là trang 1 nếu không có thông số trang)
$trangHienTai = isset($_GET['trang']) ? intval($_GET['trang']) : 1;

// Số lượng sản phẩm bắt đầu từ vị trí của trang hiện tại
$viTriBatDau = ($trangHienTai - 1) * $soSanPhamTrenMotTrang;

// Câu truy vấn SQL để lấy dữ liệu sản phẩm
$sql_pro = "SELECT * FROM tbl_sanpham WHERE tinhtrang = '1' ORDER BY id_sanpham DESC LIMIT ?, ?";
$query_pro = mysqli_prepare($mysqli, $sql_pro);
mysqli_stmt_bind_param($query_pro, 'ii', $viTriBatDau, $soSanPhamTrenMotTrang);
mysqli_stmt_execute($query_pro);
$result_pro = mysqli_stmt_get_result($query_pro);

// Số lượng sản phẩm trong bảng
$sql_dem = "SELECT COUNT(*) AS tongSoLuong FROM tbl_sanpham WHERE tinhtrang = '1'";
$query_dem = mysqli_query($mysqli, $sql_dem);

// Initialize $tongSoLuong to a default value
$tongSoLuong = 0;

// Check if the query was successful
if ($query_dem) {
    $row_dem = mysqli_fetch_assoc($query_dem);
    $tongSoLuong = $row_dem['tongSoLuong'];
}

// Số trang
$soTrang = ceil($tongSoLuong / $soSanPhamTrenMotTrang);
?>

<!-- Hiển thị danh sách sản phẩm -->
<?php while ($row_pro = mysqli_fetch_array($result_pro)): ?>
  <div style="width:18%" class="card shadow">
    <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?> "> 
      <img class="card-img-top" src="admincp/modules/quanlysanpham/uploads/<?php echo $row_pro['hinhanh'] ?>" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row_pro['tensanpham'] ?></h5>
        <p class="card-price">Giá: <?php echo number_format($row_pro['giasanpham'], 0, '', '.') . ' VNĐ' ?></p>
        <a><input class="btn btn-primary" name="themgiohang" type="submit" value="Thêm"></a>
      </div>
    </form>
  </div>
<?php endwhile; ?>

<!-- Hiển thị các nút phân trang -->
<div class="phan-trang">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php
            // Hiển thị nút phân trang
            for ($i = 1; $i <= $soTrang; $i++) {
                $activeClass = ($i == $trangHienTai) ? 'active' : '';
                echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?trang=' . $i . '">' . $i . '</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>
