<?php
if (empty($_GET['product'])) {
  echo "<script>window.location='/?';</script>";
}
$key = mysqli_escape_string($DBConnect, $_GET['product']);

$sql = "SELECT * FROM `product_list`WHERE `product_list`.`prod_id` = '$key'";

$sqlJoin = "SELECT * FROM `product_list`
        JOIN `product_image` ON `product_image`.`prod_id` = `product_list`.`prod_id`
        JOIN `images` ON `images`.`img_id` = `product_image`.`img_id`
        WHERE `product_list`.`prod_id` = '$key' ORDER BY `product_image`.`img_id` DESC";
$result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
$row = mysqli_fetch_assoc($result);
$result->close();
$result = mysqli_query($DBConnect, $sqlJoin, MYSQLI_USE_RESULT) or die('die');

if (!$row){
  echo "<script>window.location='/?action=admin&manage=pageList';</script>";
}

if (empty($_SESSION["img_sql"])) {
  # code...
}else {
  $count = count($_SESSION["img_sql"]);
  if ((count($_SESSION["img_sql"]) > 0)) {
    for ($i=0; $i < $count; $i++) {
      unset($_SESSION['img_sql'][$i]);
    }
  }
}
?>
    <div class="row">
        <div class="column">
            <h5 class="text-blue text-18x"><i class="fa fa-fw fa-heart" aria-hidden="true"></i> <?php echo $row['prod_name'];?></h5>
            <div class="alert-error" id="error"></div>
        </div>
        <div class="column no-margin">
            <div class="row">
                <div class="six columns">
                    <div class="u-full-width">
                        <div class="imageCenterer">
                            <?php
                        for ($i=0; $i < $rowImage = mysqli_fetch_assoc($result); $i++) {
                          $_SESSION["img_sql"][$i] = $rowImage['img_id'];
                        ?>
                                <img width="100%" id="<?php echo $rowImage['img_path'];?>" src="uploads/contents/<?php echo $rowImage['img_path'];?>" alt="">
                                <?php } $result->close();?>
                        </div>
                    </div>
                </div>

                <div class="six columns">
                    <small><p class="font-12x no-margin"><?php echo $row['prod_name'];?></p></small>
                    <div class="row">
                      <label>ราคา <small> (ลด <?php echo $row['prod_discount']?>%)</small></label>
                      <p><?php if($row['prod_discount'] > 0){
                          echo "<i style='text-decoration: line-through;'>".number_format($row['prod_price'], 2, '.', ',').'</i> ';
                          $price = $row['prod_price'];
                          $discount = $row['prod_discount'];
                          $total = $price-($price*$discount/100);

                          echo "<b class='text-red'>".number_format($total, 2, '.', ',').'</b>';
                      }else {
                        echo number_format($row['prod_price'], 2, '.', ',');
                      }?></p>
                    </div>

                    <div class="row">
                      <label>คำอธิบาย</label>
                      <p><?php echo $row['prod_description'];?></p>
                    </div>
                    <button type="button" class="button-primary" name="addtocart" onclick="return addcrt(<?php echo $row['prod_id'];?>, 1)"><i class="fa fa-fw fa-shopping-basket" aria-hidden="true"></i> เพิ่มสินค้าลงตะกร้า</button>
                    <?php if (!empty($_SESSION['user_group']) && $_SESSION['user_group'] == '1') {?>
                      <a href="?action=admin&manage=productinfo&pid=<?php echo $row['prod_id'];?>">แก้ไขสินค้านี้</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.title = "<?php echo $row['prod_name'];?>";
    </script>
