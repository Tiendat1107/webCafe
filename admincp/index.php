<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/styleadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
    header('Location: login.php');
}

include("config/config.php");
include("modules/menu.php");
include("modules/header.php");
include("modules/main.php");
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        thongke();
        var chart = new Morris.Area({
            parseTime: false,
            hideHover: 'auto',
            element: 'chart',
            lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
            xkey: 'date',
            ykeys: ['order', 'sales', 'quantity'],
            labels: ['Đơn Hàng', 'Doanh Thu', 'Số Lượng Bán']
        });

        $('.select-date').change(function () {
            var thoigian = $(this).val();
            var text = getTextForTimeRange(thoigian);
            $.ajax({
                url: "modules/thongke.php",
                method: "POST",
                dataType: "JSON",
                data: {thoigian: thoigian},
                success: function (data) {
                    chart.setData(data);
                    $('#text-date').text(text);
                }
            });
        });

        function thongke() {
            var text = '365 ngày qua';
            $('#text-date').text(text);
            $.ajax({
                url: "modules/thongke.php",
                method: "POST",
                dataType: "JSON",
                success: function (data) {
                    chart.setData(data);
                    $('#text-date').text(text);
                }
            });
        }

        function getTextForTimeRange(thoigian) {
            switch (thoigian) {
                case 'ngay':
                    return 'Hôm Nay';
                case '7ngay':
                    return '7 Ngày Qua';
                case '30ngay':
                    return '1 Tháng Qua';
                case '90ngay':
                    return '3 Tháng Qua';
                case '365ngay':
                    return '1 Năm Qua';
                default:
                    return '';
            }
        }
    });
</script>
</body>
</html>
