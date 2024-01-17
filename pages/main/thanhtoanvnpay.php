<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
include('../../admincp/config/config.php');

// Kiểm tra xem dữ liệu từ callback đã được truyền đến hay chưa
if (isset($_GET['vnp_Amount'])) {
    // Lấy thông tin thanh toán từ callback hoặc nơi bạn xác nhận thanh toán thành công
    $amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : '';
    $bankcode = isset($_GET['vnp_BankCode']) ? $_GET['vnp_BankCode'] : '';
    $banktrano = isset($_GET['vnp_BankTraNo']) ? $_GET['vnp_BankTraNo'] : '';
    $cardtype = isset($_GET['vnp_CartType']) ? $_GET['vnp_CartType'] : '';
    $orderinfo = isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : '';
    $paydate = isset($_GET['vnp_PayDate']) ? $_GET['vnp_PayDate'] : '';
    $tmncode = isset($_GET['vnp_TmnCode']) ? $_GET['vnp_TmnCode'] : '';
    $transactionno = isset($_GET['vnp_TransactionNo']) ? $_GET['vnp_TransactionNo'] : '';
    $id_hang = isset($_SESSION['id_hang']) ? $_SESSION['id_hang'] : '';

    // Thực hiện câu lệnh INSERT INTO để lưu thông tin thanh toán vào bảng tbl_vnpay
    $sql = "INSERT INTO tbl_vnpay (amount, bankcode, banktrano, cardtype, orderinfo, paydate, tmncode, transactionno, id_hang)
            VALUES ('$amount', '$bankcode', '$banktrano', '$cardtype', '$orderinfo', '$paydate', '$tmncode', '$transactionno', '$id_hang')";

    if (mysqli_query($mysqli, $sql)) {
        echo "Dữ liệu thanh toán đã được lưu thành công vào cơ sở dữ liệu.";

        // Xóa giỏ hàng sau khi thanh toán
        unset($_SESSION['cart']);

        // Hiển thị nút in hóa đơn và chuyển về trang index
        header('location: inhoadon.php?id_donhang=' . $id_hang);
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($mysqli);
    }
} else {
    echo "Không có dữ liệu thanh toán được truyền đến.";
}
?>