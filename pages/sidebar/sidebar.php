<div class="category-list">
    <h2><a href="index.php?quanly=sanpham">Danh Mục</a></h2>
    <?php
    $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
    ?>
    <ul class="list-group shadow">
        <?php
        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
            $categoryId = $row_danhmuc['id_danhmuc'];
            $categoryName = $row_danhmuc['tendanhmuc'];
            $isActive = isset($_GET['id']) && $_GET['id'] == $categoryId ? 'active' : '';
        ?>
            <li class="list-group-item <?php echo $isActive; ?>">
                <a class="item-style" href="index.php?quanly=danhsach&id=<?php echo $categoryId ?>">
                    <?php echo $categoryName ?>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>
