<div class="alert-error" id="error"></div>
<div class="row">
  <div class="offset-by-three six columns">
    <form name="order_invoice" action="#" onsubmit="return invoice()" method="POST">
        <div class="u-full-width">
            <label class="account_info">รหัสคำสั่งซื้อ</label>
            <input type="text" name="" readonly="" style="background: transparent;" value="<?php echo $_GET['order']; ?>"></input>
        </div>
        <div class="u-full-width">
          <label class="account_info">โอนเข้าบัญชี</label>
          <?php
          $sql = "SELECT * FROM `payment_method`";
          $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("die");
          $num_row = mysqli_num_rows($query);
          ?>
          <select name="paymethod_id">
            <?php while($row = mysqli_fetch_assoc($query)){ ?>
              <option value="<?php echo ($row['paymethod_id']);?>"><?php echo $row['paymethod_bank'];?></option>
            <?php } if($num_row == 0) {?>
              <option value="0">ไม่พบรายการ</option>
            <?php } ?>
          </select>
        </div>
        <div class="u-full-width">
            <label class="account_info">จำนวนเงิน <small>(บาท)</small></label>
            <input type="text" name="pay_amount" value="<?php echo number_format($_GET['price'], 2, '.', ',');?>"></input>
        </div>
        <div class="u-full-width">
            <label class="account_info">เวลาทำรายการ</label>
            <input type="date" name="paydate" value="<?php echo date('Y-m-d');?>">
            <input type="time" name="paytime" value="<?php echo date("H:i:s");?>">
        </div>
        <div class="u-full-width">
          <button type="submit" name="submit" class="button-primary">แจ้งชำระเงิน</button>
        </div>
    </form>
  </div>
</div>
<script type="text/javascript">
    document.title = "แจ้งการชำระเงิน";
    function invoice() {
      var paytime = document.forms['order_invoice']['paytime'].value;
      var paydate = document.forms['order_invoice']['paydate'].value;
      var paymethod_id = document.forms['order_invoice']['paymethod_id'].value;
      var pay_amount = document.forms['order_invoice']['pay_amount'].value;
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=doinvoice',
            data: "order_id=<?php echo $_GET['order']; ?>&invoice_id=<?php echo $_GET['order']; ?>&pay_amount="+pay_amount+"&paymethod_id="+paymethod_id+"&pay_date="+paydate+" "+paytime,
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>แจ้งการชำระเงินเรียบร้อยแล้ว</p>");
                    setTimeout(function() {
                        window.location.assign("?action=histories")
                    }, 2000);
                }
            }
        })
        return false;
    }
</script>
