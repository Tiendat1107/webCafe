<?php
session_start();
include('../../admincp/config/config.php');
require('../../TCPDF-main/TCPDF-main/tcpdf.php');

if (isset($_GET['id_donhang']) && $_GET['id_donhang']) {
    $id_donhang = $_GET['id_donhang'];

    // Truy vấn thông tin đơn hàng
    $sql_donhang = "SELECT * FROM tbl_donhang WHERE id_donhang = '$id_donhang'";
    $query_donhang = mysqli_query($mysqli, $sql_donhang);
    $row_donhang = mysqli_fetch_assoc($query_donhang);

    if ($row_donhang) {
        // Truy vấn chi tiết đơn hàng
        $sql_chi_tiet_don_hang = "SELECT sp.tensanpham, ctdh.gia, ctdh.soluong, ctdh.gia * ctdh.soluong AS thanhtien
                                 FROM tbl_chi_tiet_don_hang ctdh
                                 INNER JOIN tbl_sanpham sp ON ctdh.id_sanpham = sp.id_sanpham
                                 WHERE ctdh.id_donhang = '$id_donhang'";
        $query_chi_tiet_don_hang = mysqli_query($mysqli, $sql_chi_tiet_don_hang);

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('DejaVuSansCondensed', '', 15);
        $pdf->SetFillColor(255, 255, 255);

        // Xuất thông tin đơn hàng
        $pdf->Cell(40, 10, 'Thông Tin Chi Tiết Đơn Hàng #' . $row_donhang['id_donhang']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Ngày Mua: ' . $row_donhang['ngaymua']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Hình Thức Thanh Toán: ' . $row_donhang['payment_method']);
        $pdf->Ln(10);

        // Xuất chi tiết đơn hàng
        $pdf->Cell(40, 10, 'Chi Tiết Sản Phẩm');
        $pdf->Ln(10);

        $width_cell = array(60, 30, 30, 40);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell($width_cell[0], 10, 'Tên Sản Phẩm', 1, 0, 'C', true);
        $pdf->Cell($width_cell[1], 10, 'Giá', 1, 0, 'C', true);
        $pdf->Cell($width_cell[2], 10, 'Số Lượng', 1, 0, 'C', true);
        $pdf->Cell($width_cell[3], 10, 'Thành Tiền', 1, 1, 'C', true);

        $tong_tien_don_hang = 0;

        while ($row_chi_tiet_don_hang = mysqli_fetch_assoc($query_chi_tiet_don_hang)) {
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell($width_cell[0], 10, $row_chi_tiet_don_hang['tensanpham'], 1, 0, 'C', true);
            $pdf->Cell($width_cell[1], 10, number_format($row_chi_tiet_don_hang['gia']), 1, 0, 'C', true);
            $pdf->Cell($width_cell[2], 10, $row_chi_tiet_don_hang['soluong'], 1, 0, 'C', true);
            $pdf->Cell($width_cell[3], 10, number_format($row_chi_tiet_don_hang['thanhtien']), 1, 1, 'C', true);

            $tong_tien_don_hang += $row_chi_tiet_don_hang['thanhtien'];
        }

        // Xuất tổng tiền đơn hàng
        $pdf->Cell(160, 10, 'Tổng Tiền Đơn Hàng: ' . number_format($tong_tien_don_hang) . ' VNĐ', 1, 1, 'C');

        
        // Xuất tệp PDF
    $pdf->Output();
    // Hiển thị nút "Quay lại trang index"
    

    } else {
        echo "<p>Không tìm thấy đơn hàng.</p>";
    }
} else {
    echo "<p>Thiếu thông tin đơn hàng.</p>";
}
?>
