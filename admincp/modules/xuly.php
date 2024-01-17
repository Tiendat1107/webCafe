<?php
include('../config/config.php');
require('../../Carbon/autoload.php');
use Carbon\Carbon;

// Lấy tổng số lượng và doanh thu từ bảng tbl_thongke
$sql_thongke = "SELECT DATE(ngaydat) as ngay, SUM(soluongban) as soluong, SUM(doanhthu) as doanhthu
                FROM tbl_thongke
                GROUP BY ngay";
$query_thongke = mysqli_query($mysqli, $sql_thongke);

// Lặp qua từng ngày và thêm vào bảng tbl_sanpham_banra
while ($row_thongke = mysqli_fetch_assoc($query_thongke)) {
    $ngay = $row_thongke['ngay'];
    $soluong = $row_thongke['soluong'];
    $doanhthu = $row_thongke['doanhthu'];

    // Kiểm tra xem ngày đã tồn tại trong bảng tbl_sanpham_banra hay chưa
    $sql_check_exist = "SELECT * FROM tbl_sanpham_banra WHERE ngay = '$ngay'";
    $query_check_exist = mysqli_query($mysqli, $sql_check_exist);

    if (mysqli_num_rows($query_check_exist) == 0) {
        // Nếu ngày chưa tồn tại, thêm dữ liệu mới vào tbl_sanpham_banra
        $sql_insert_sanpham_banra = "INSERT INTO tbl_sanpham_banra (ngay, soluong, doanhthu) 
                                     VALUES ('$ngay', $soluong, $doanhthu)";
        mysqli_query($mysqli, $sql_insert_sanpham_banra);
    } else {
        // Nếu ngày đã tồn tại, cập nhật dữ liệu trong tbl_sanpham_banra
        $sql_update_sanpham_banra = "UPDATE tbl_sanpham_banra 
                                     SET soluong = soluong + $soluong, 
                                         doanhthu = doanhthu + $doanhthu 
                                     WHERE ngay = '$ngay'";
        mysqli_query($mysqli, $sql_update_sanpham_banra);
    }
}

// Đóng kết nối
mysqli_close($mysqli);
?>

<p>Thống Kê Doanh Thu Theo : <span id="text_date"></span></p>
<p>
    <select class="select-date">
        <option value="ngay">Hôm nay</option>
        <option value="7ngay">7 Ngày Qua</option>
        <option value="30ngay">1 Tháng</option>
        <option value="90ngay">3 Tháng</option>
        <option value="365ngay">1 Năm Qua</option>
    </select>
</p>
<div id="chart" style="height: 250px;"></div>