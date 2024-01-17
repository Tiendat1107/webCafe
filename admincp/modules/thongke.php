<?php
include('../config/config.php');
require('../../Carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;

if(isset($_POST['thoigian'])){
    $thoigian = $_POST['thoigian'];
}else{
    $thoigian ='';
}

// Khởi tạo giá trị mặc định cho $subdays (nếu $thoigian không được chọn)
$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(1)->toDateTimeString();

if($thoigian=='ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(1)->toDateTimeString();
}elseif($thoigian=='7ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateTimeString();   
}elseif($thoigian=='30ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateTimeString();   
}elseif($thoigian=='90ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateTimeString();   
}elseif($thoigian=='365ngay'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateTimeString();
}

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
$sql = "SELECT ngaydat, SUM(donhang) as donhang, SUM(doanhthu) as doanhthu, SUM(soluongban) as soluongban 
        FROM tbl_thongke 
        WHERE ngaydat BETWEEN '$subdays' AND '$now' 
        GROUP BY ngaydat 
        ORDER BY ngaydat ASC";
$sql_query = mysqli_query($mysqli, $sql);

$chart_data = array();

while ($val = mysqli_fetch_array($sql_query)) {
    $chart_data[] = array(
        'date' => $val['ngaydat'],
        'order' => $val['donhang'],
        'sales' => $val['doanhthu'],
        'quantity' => $val['soluongban']
    );
}

echo $data = json_encode($chart_data);
?>
