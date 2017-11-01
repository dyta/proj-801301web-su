<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
$sql = "SELECT * FROM `product_category` ORDER BY cate_name DESC";
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("<script>window.location='/?access_denied';</script>");
$num_row = mysqli_num_rows($query);
?>
    <div class="row">
        <div class="u-full-width">
            <h5 class="text-blue text-18x"><i class="fa fa-fw fa-database" aria-hidden="true"></i> หมวดหมู่สินค้า</h5>
        </div>
    </div>
    <div class="row">
        <div class="u-full-width">
            <div class="alert-error" id="error"></div>
            <form action="#" name="cate" onsubmit="return CreateCate()" method="POST">
                <div class="ten columns no-margin no-padding">
                    <input type="text" autofocus="" autocomplete="off" name="cate_name" pattern="[a-zA-Z0-9ก-๙]+" placeholder="กรอกชื่อหมวดหมู่" />
                </div>
                <div class="two columns no-padding">
                    <button type="submit" class="button-primary" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> เพิ่ม</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-m12">
            <table class="u-full-width">
                <tr>
                    <th>ชื่อหมวดหมู่</th>
                    <th>ตัวเลือก</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($query)){?>
                <tr>
                    <td>
                      <?php echo $row['cate_name'];?>
                    </td>
                    <td class="text-center" width="170px">
                      <a href="?action=admin&manage=categoryDetails&key=<?php echo base64_encode($row['cate_id'])?>">
                          <i class="fa fa-fw fa-cog" aria-hidden="true"></i> แก้ไข
                      </a>
                    </td>
                </tr>
                <?php } if($num_row == 0) {?>
                <tr>
                    <td class="text-center" colspan="2">ไม่พบรายการ</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        document.title = "หมวดหมู่สินค้า";
    </script>
