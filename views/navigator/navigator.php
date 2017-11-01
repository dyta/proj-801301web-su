<ul class="topnav" id="nav-default">
    <li><a href="/"><i class="fa fa-fw fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
    <li class="dropdown dp-none" id="dropdown"><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-fw fa-database" aria-hidden="true"></i> หมวดหมู่สินค้า</a>
      <div class="dropdown-content">
        <?php
        $sql = "SELECT * FROM `product_category` ORDER BY cate_name DESC";
        $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
        $num_row = mysqli_num_rows($query);
        while($row = mysqli_fetch_assoc($query)){?>
            <a href="?action=cate&filter=<?php echo $row['cate_id']; ?>"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> <?php echo $row['cate_name']; ?></a>
            <?php } if($num_row == 0) {?>
            <p><small>**ไม่พบหมวดหมู่สินค้า**</small></p>
            <?php } $query->close();?>
      </div>
    </li>
    <?php
    $sql = "SELECT * FROM `page_content` WHERE cont_showontop = 'on';";
    $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
    $num_row = mysqli_num_rows($query);
    while($row = mysqli_fetch_assoc($query)){?>
      <li><a href="?page=<?php echo $row['cont_url'];?>"><?php echo $row['cont_title'];?></a></li>
    <?php }  $query->close();?>
    <li class="right"><a href="/?action=cart"><i class="fa fa-fw fa-shopping-basket" aria-hidden="true"></i> ตะกร้าสินค้า <?php if (!empty($_SESSION['cart'])) {echo "(".count($_SESSION['cart']).")";} ?></a></li>
    <li class="icon">
        <a href="javascript:navResponsive();"><i class="fa fa-bars" aria-hidden="true"></i></a>
    </li>
</ul>
