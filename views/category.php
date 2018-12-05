<div class="row">
  <section id="page">
    <div class="three columns sidebar">
      <?php
        include 'navigator/menu_avatar.php';
        include 'navigator/menu_sidebar.php';
        include 'navigator/menu_cate.php';
        ?>
    </div>
    <div class="nine columns main">
<?php 
$perpage = 12;
if (!empty($_GET['p'])) {
    $page = mysqli_escape_string($DBConnect, $_GET['p']);
} else {
    $page = 1;
}

$start = ($page - 1) * $perpage;

$sql = "SELECT * FROM `product_list`
        JOIN `product_image` ON `product_image`.`prod_id` = `product_list`.`prod_id`
        JOIN `images` ON `images`.`img_id` = `product_image`.`img_id`
        JOIN `product_category` ON `product_category`.`cate_id` = `product_list`.`cate_id`
        WHERE `product_list`.`cate_id` = '".$_GET['filter']."'
        GROUP BY `product_list`.`prod_id`
        ORDER BY `product_list`.`prod_id` DESC LIMIT $start , $perpage";
$sqlPagination = "SELECT * FROM `product_list` WHERE `product_list`.`cate_id` = '".$_GET['filter']."'";

/* แบ่งหน้า*/
$query2 = mysqli_query($DBConnect, $sqlPagination);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);

/* คิวรีข้อมูล*/
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
$num_row = mysqli_num_rows($query);
/*ล้างคำค้นหา*/
if (!empty($_GET['search']) && !empty($_GET['clear']) && $_GET['search'] == true) {
    header("location: ?action=admin&manage=account&search=&sort=$sort");
}
$sql2 = "SELECT * FROM `product_category` WHERE `product_list`.`cate_id` = '".$_GET['filter']."'";
$query2 = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
$row2 = mysqli_fetch_assoc($query2);
?>
    <div class="column no-margin">

        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i> รายการสินค้า : <?php echo $row2['cate_name']; ?>
        <div class="alert-error" id="error"></div>
    </div>
    <div class="row text-center">
        <?php if (!empty($_GET['search'])) {?>
        <h3>ผลการค้นหาพบ <?php echo $total_record;?> รายการ</h3>
        <?php } ?>

        <?php while ($row = mysqli_fetch_assoc($query)) {?>
        <div class="four columns no-margin">
            <div class="product-grid text-center">
              <a href="?action=product&product=<?php echo $row['prod_id'];?>">
              <img src="uploads/contents/<?php echo $row['img_path']?>" alt="">
              </a>
                <small>
                    <p class="font-12x no-margin"><?php echo $row['prod_name'];?></p>
                </small>
                <small class="font-12x no-margin">฿
                    <?php if ($row['prod_discount'] > 0) {
                        echo "<i style='text-decoration: line-through;'>".number_format($row['prod_price'], 2, '.', ',').'</i> ';
                        $price = $row['prod_price'];
                        $discount = $row['prod_discount'];
                        $total = $price-($price*$discount/100);

                        echo "<b class='text-red'>".number_format($total, 2, '.', ',').'</b>';
} else {
    echo number_format($row['prod_price'], 2, '.', ',');
}?></small>
                <button type="button" onclick="return addcrt(<?php echo $row['prod_id'];?>, 1)" name="addtocart"><i class="fa fa-fw fa-shopping-basket" aria-hidden="true"></i> เพิ่มสินค้าลงตะกร้า</button>
            </div>
        </div>
        <?php } if ($num_row == 0) {?>
        <p class="text-center">ไม่พบรายการสินค้าในหมวดหมู่นี้</p>
        <script type="text/javascript">
          setTimeout(function() {
              window.location.assign('/');
          }, 3000);
        </script>
        <?php } ?>
    </div>

    <div class="row text-center">
        <ul class="pagination">
            <?php for ($i=1; $i<=$total_page; $i++) { ?>
            <li><a <?php if ($page==$i) {
                echo 'class="active"';
} ?> href="?action=<?php echo $_GET['action']; ?>&filter=<?php echo $_GET['filter']; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
        </ul>
    </div>

    </div>
  </section>
</div>
