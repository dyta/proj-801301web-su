<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?action=login';</script>";
}
$sql = "SELECT * FROM `payment_method`";
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("die");
$num_row = mysqli_num_rows($query);
?>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-user" aria-hidden="true"></i> ช่องทางการชำระเงิน
          <small><a href="?action=admin&amp;manage=paymethodAdd"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> เพิ่ม</a></small>
        </h5>
    </div>
    <div class="row">
        <div class="col-m12">
            <table width="100%">
                <tr>
                    <th>ชื่อธนาคาร</th>
                    <th>ชื่อบัญชี</th>
                    <th>เลขที่บัญชี</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($query)){?>
                <tr>
                    <td>
                        <a class="border-black font12x" href="?action=admin&amp;manage=paymethodEdit&amp;key=<?php echo base64_encode($row['paymethod_id']);?>">
                            <i class="fa fa-fw fa-cog" aria-hidden="true"></i>
                            <?php echo $row['paymethod_bank'];?>
                        </a>
                    </td>
                    <td>
                        <?php echo $row['paymethod_name'];?>
                    </td>
                    <td>
                        <?php echo $row['paymethod_no'];?>
                    </td>
                </tr>
                <?php } if($num_row == 0) {?>
                <tr>
                    <td class="text-center" colspan="3">ไม่พบรายการ</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        document.title = "ช่องทางการชำระเงิน ";
    </script>
