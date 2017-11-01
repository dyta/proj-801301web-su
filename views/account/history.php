<?php
if (empty($_SESSION['user_id'])) {
  echo "<script>window.location='/?action=login';</script>";
}
$sql = "SELECT *, SUM(`order_items`.`ordit_price`) AS totalprice FROM `order_items`
    JOIN `order_details` ON `order_details`.`order_id` = `order_items`.`order_id`
    JOIN `invoices` ON `invoices`.`order_id` = `order_details`.`order_id`
    JOIN `order_status` ON `order_status`.`ordstatus_id` = `order_details`.`ordstatus_id`
    WHERE user_id = '".$_SESSION['user_id']."'
    GROUP BY `order_items`.`order_id`";
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("die");
$num_row = mysqli_num_rows($query);
?>
<div class="column no-margin">
    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-history" aria-hidden="true"></i> ประวัติการสั่งซื้อ</h5>
    <div class="alert-error" id="error"></div>
</div>
<div class="row">
  <div class="column no-margin">
  <table class="u-full-width">
      <tr>
          <th>รหัสใบสั่งซื้อ</th>
          <th class="display-none">จำนวนเงินทั้งหมด</th>
          <th>สถานะคำสั่งซื้อ</th>
          <th class="display-none">เวลา</th>
          <th>ตัวเลือก</th>

      </tr>
      <?php while($row = mysqli_fetch_assoc($query)){?>
      <tr class="text-center">
          <td><?php echo $row['invoice_id'];?></td>
          <td class="display-none"><?php echo number_format($row['totalprice'], 2, '.', ',')?></td>
          <td><?php echo $row['ordstatus_title'];?></td>
          <td class="display-none"><?php echo DateFormateFull($row['order_date'])?></td>
          <td>
            <?php if ($row['ordstatus_id'] == "2") {?>
              <a href="?action=payment&order=<?php echo $row['order_id'];?>&price=<?php echo $row['totalprice']?>">แจ้งชำระเงิน</a>
              - <a href="#" onclick="return deClick(<?php echo $row['invoice_id'];?>)">ยกเลิก</a>
            <?php }else {?>
              <a href="?action=invoice&receipt=<?php echo $row['invoice_id'];?>">ดูรายการ</a>
            <?php }?>
          </td>
      </tr>
      <?php } if($num_row == 0) {?>
      <tr>
          <td class="text-center" colspan="5">ไม่พบรายการ</td>
      </tr>
      <?php } ?>
  </table>
</div>
</div>


<script type="text/javascript">
    document.title = "ประวัติการสั่งซื้อ";
    function deClick(id) {
        var verified = window.confirm("คุณต้องการยกเลิกรายการสินค้านี้หรือไม่?");
        if (verified) {
          deOrder(id);

        }
        return false;
    }
    function deOrder(id) {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=deorder',
            data: "order_id=" + id,
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>คำสั่งซื้อถูกยกเลิกแล้ว</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        })
        return false;
    }
</script>
