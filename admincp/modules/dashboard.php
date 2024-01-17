<?php
require('../Carbon/autoload.php');
use Carbon\Carbon;
?>
<p>Thống Kê Doanh Thu Hôm Nay</p>
<div id="chart" style="height: 250px;"></div>
<?php

// Lấy ngày hôm nay và thiết lập thời điểm bắt đầu và kết thúc của ngày hôm nay
$ngay_hom_nay = Carbon::now('Asia/Ho_Chi_Minh');
$ngay_bat_dau = $ngay_hom_nay->copy()->startOfDay();
$ngay_ket_thuc = $ngay_hom_nay->copy()->endOfDay();

// Truy vấn để lấy tổng doanh thu, số lượng sản phẩm bán ra và số đơn hàng từ ngày đặt đến ngày hôm nay
$sql_tong_thong_ke = "SELECT SUM(doanhthu) as tong_doanh_thu, SUM(soluongban) as tong_so_luong_ban_ra, SUM(donhang) as tong_so_don_hang
                      FROM tbl_thongke
                      WHERE ngaydat BETWEEN '$ngay_bat_dau' AND '$ngay_ket_thuc'";
$query_tong_thong_ke = mysqli_query($mysqli, $sql_tong_thong_ke);


if ($query_tong_thong_ke) {
    $row_tong_thong_ke = mysqli_fetch_assoc($query_tong_thong_ke);

    $tong_doanh_thu = number_format($row_tong_thong_ke['tong_doanh_thu']);
    $tong_so_luong_ban_ra = $row_tong_thong_ke['tong_so_luong_ban_ra'];
    $tong_so_don_hang = $row_tong_thong_ke['tong_so_don_hang'];

    echo '<table border="1">';
    echo '<tr><td><b>Tổng doanh thu hôm nay:</b></td><td><b>' . $tong_doanh_thu . ' VND</b></td></tr>';
    echo '<tr><td><b>Tổng sản phẩm đã bán ra hôm nay:</b></td><td><b>' . $tong_so_luong_ban_ra . '</b></td></tr>';
    echo '<tr><td><b>Tổng số đơn hàng đã bán ra hôm nay:</b></td><td><b>' . $tong_so_don_hang . '</b></td></tr>';
    echo '</table>';

} else {
    echo "Không có thông tin thống kê cho khoảng thời gian từ ngày đặt đến ngày hôm nay";
}

// Truy vấn để lấy 5 mặt hàng được mua nhiều nhất trong ngày
$sql_top_5_mat_hang = "SELECT sp.tensanpham as ten_sp, SUM(ctdh.soluong) as so_luong
                       FROM tbl_chi_tiet_don_hang ctdh
                       JOIN tbl_sanpham sp ON ctdh.id_sanpham = sp.id_sanpham
                       JOIN tbl_donhang dh ON ctdh.id_donhang = dh.id_donhang
                       WHERE dh.ngaymua BETWEEN '$ngay_bat_dau' AND '$ngay_ket_thuc'
                       GROUP BY ten_sp
                       ORDER BY so_luong DESC
                       LIMIT 5";
$query_top_5_mat_hang = mysqli_query($mysqli, $sql_top_5_mat_hang);

// Dữ liệu cho biểu đồ
$chart_data = array();
while ($row_top_5_mat_hang = mysqli_fetch_assoc($query_top_5_mat_hang)) {
    $ten_sp = $row_top_5_mat_hang['ten_sp'];
    $so_luong = $row_top_5_mat_hang['so_luong'];
    $chart_data[] = array('ten_sp' => $ten_sp, 'so_luong' => $so_luong);
}

// Chuyển dữ liệu thành định dạng JSON để sử dụng trong biểu đồ
$json_data = json_encode($chart_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu đồ 5 mặt hàng được mua nhiều nhất trong ngày</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

    <div id="bar-chart"></div>

    <script>
        // Dữ liệu từ PHP được chuyển thành biến JavaScript
        var jsonData = <?php echo $json_data; ?>;

        // Tạo dữ liệu cho biểu đồ cột
        var data = [{
            x: jsonData.map(item => item.ten_sp),
            y: jsonData.map(item => item.so_luong),
            type: 'bar'
        }];

        // Thiết lập layout cho biểu đồ
        var layout = {
            title: '5 Mặt hàng được mua nhiều nhất trong ngày',
            xaxis: { title: 'Mặt hàng' },
            yaxis: { title: 'Số lượng' }
        };

        // Tạo biểu đồ cột
        Plotly.newPlot('bar-chart', data, layout);
    </script>

</body>
</html>

