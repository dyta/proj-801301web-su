<div class="row display-none-c">
    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-database" aria-hidden="true"></i> หมวดหมู่สินค้า</h5>
    <div class="nav-category">
        <ul>
            <small style="font-weight: bold;">แยกตามประเภท</small>
            <?php
            $sql = "SELECT * FROM `product_category` ORDER BY cate_name DESC";
            $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
            $num_row = mysqli_num_rows($query);
            while($row = mysqli_fetch_assoc($query)){?>
                <li><a class="text-black" href="?action=cate&filter=<?php echo $row['cate_id']; ?>"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> <?php echo $row['cate_name']; ?></a></li>
                <?php } if($num_row == 0) {?>
                <p><small>**ไม่พบหมวดหมู่สินค้า**</small></p>
                <?php } ?>
        </ul>
    </div>
</div>
