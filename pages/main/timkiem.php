<?php
$tukhoa = ''; // Khởi tạo biến tukhoa để tránh lỗi undefined khi không có dữ liệu từ form tìm kiếm

if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
    $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE '%$tukhoa%' AND tbl_sanpham.tinhtrang = 1";
    $query_pro = mysqli_query($mysqli, $sql_pro);

    while ($row_pro = mysqli_fetch_array($query_pro)) {
        // Hiển thị sản phẩm tìm kiếm
        ?>
        <div class="card shadow">
            <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?> ">
                <img class="card-img-top" src="admincp/modules/quanlysanpham/uploads/<?php echo $row_pro['hinhanh'] ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row_pro['tensanpham'] ?></h5>
                    <p class="card-price">Giá: <?php echo number_format($row_pro['giasanpham'], 0, '', '.') . ' VNĐ' ?></p>
                    <a><input class="btn btn-primary" name="themgiohang" type="submit" value="Thêm"></a>
                </div>
            </form>
        </div>
        <?php
    }
}
?>
