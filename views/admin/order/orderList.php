<?php
if (empty($_SESSION['user_id'])) {
  echo "<script>window.location='/?action=login';</script>";
}
$sql = "SELECT *, SUM(`order_items`.`ordit_price`) AS totalprice FROM `order_items`
    JOIN `order_details` ON `order_details`.`order_id` = `order_items`.`order_id`
    JOIN `invoices` ON `invoices`.`order_id` = `order_details`.`order_id`
    JOIN `order_status` ON `order_status`.`ordstatus_id` = `order_details`.`ordstatus_id`
    GROUP BY `order_items`.`order_id`";
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("die");
$num_row = mysqli_num_rows($query);
?>
<div class="column no-margin">
    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-bank" aria-hidden="true"></i> รายการคำสั่งซื้อ</h5>
    <div class="alert-error" id="error"></div>
</div>
<div class="row">
  <div class="column no-margin no-padding">
  <table class="u-full-width">
      <tr>
          <th>รหัสใบสั่งซื้อ</th>
          <th class="display-none">จำนวนเงินทั้งหมด</th>
          <th class="display-none">เวลา</th>
          <th>ตัวเลือก</th>

      </tr>
      <?php while($row = mysqli_fetch_assoc($query)){?>
      <tr class="text-center">
          <td><a href="?action=admin&manage=orderInfor&receipt=<?php echo $row['invoice_id'];?>&user=<?php echo $row['user_id']?>"><?php
          if ($row['ordstatus_id'] == '1') {?>
            <i class="fa fa-bell" aria-hidden="true"></i>
            <?php }
            echo $row['invoice_id'];?></a></td>
          <td class="display-none"><?php echo number_format($row['totalprice'], 2, '.', ',')?></td>
          <td class="display-none"><?php echo DateFormateFull($row['order_date'])?></td>
          <td>
            <select id ="ddl" name="ddl" onmousedown="this.value='';" onchange="jsFunction(this.value, <?php echo $row['invoice_id'];?>);">
              <?php
              $sql2 = "SELECT * FROM order_status";
              $query2 = mysqli_query($DBConnect, $sql2) or die ("die");
              $num_row = mysqli_num_rows($query2);
              while ($row2 = mysqli_fetch_assoc($query2)) {?>
              <option value='<?php echo $row2['ordstatus_id'];?>' <?php if ($row2['ordstatus_id'] == $row['ordstatus_id']){echo "selected";};?>><?php echo $row2['ordstatus_title'];?></option>
              <?php }?>
            </select>
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
    document.title = "รายการสั่งซื้อ";
    function jsFunction(value,id){
      var verified = window.confirm("ยืนยันการทำรายการ?");
      if (verified) {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=updateorderad',
            data: "invoice_id=" + id + "&value=" + value,
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>อัพเดทแล้ว</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        })
      }
      return false;
    }
</script>
