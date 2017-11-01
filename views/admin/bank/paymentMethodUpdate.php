<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?ฃ?action=login';</script>";
}
$key = mysqli_escape_string($DBConnect, base64_decode($_GET['key']));
if (empty($_GET['key'])) {
  echo "<script>history.back();</script>";
}

$sql = "SELECT * FROM `payment_method` WHERE paymethod_id = '$key'";
$result = mysqli_query($DBConnect, $sql) or die('die');
$row = mysqli_fetch_assoc($result);
if (!$row){
  echo "<script>window.location='/?action=admin&manage=paymethod';</script>";
}
?>
    <div class="u-pull-right">
        <a class="text-red" style="float:right;" href="?action=admin&manage=paymethod"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-money" aria-hidden="true"></i> แก้ไขช่องทางการชำระเงิน <small>Payment Method ID: <?php echo $row['paymethod_id'];?></small></h5>
    </div>
    <div class="u-full-width">
        <div class="alert-error" id="error"></div>
        <form action="#" name="payment_methodAdd" onsubmit="return updatePaymentMethod(<?php echo $row['paymethod_id'];?>)" method="POST">
            <div class="form-group">
                <label>ชื่อบัญชี</label>
                <input type="text" name="paymethod_name" maxlength="140" class="btn border-default" value="<?php echo $row['paymethod_name'];?>"></input>
            </div>
            <div class="form-group">
                <label>เลขที่บัญชี</label>
                <input type="text" name="paymethod_no" maxlength="20" pattern="[0-9]+" class="btn border-default" value="<?php echo $row['paymethod_no'];?>"></input>
            </div>
            <div class="form-group">
                <label>ธนาคาร</label>
                <select class="btn border-default" name="paymethod_bank">
                  <option value="ธนาคารกรุงเทพ"<?php if ($row['paymethod_bank'] == 'ธนาคารกรุงเทพ'){echo "selected";}?>>ธนาคารกรุงเทพ</option>
                  <option value="ธนาคารกรุงไทย"<?php if ($row['paymethod_bank'] == 'ธนาคารกรุงไทย'){echo "selected";}?>>ธนาคารกรุงไทย</option>
                  <option value="ธนาคารกรุงศรี"<?php if ($row['paymethod_bank'] == 'ธนาคารกรุงศรี'){echo "selected";}?>>ธนาคารกรุงศรี</option>
                  <option value="ธนาคารทหารไทย"<?php if ($row['paymethod_bank'] == 'ธนาคารทหารไทย'){echo "selected";}?>>ธนาคารทหารไทย</option>
                  <option value="ธนาคารกสิกรไทย"<?php if ($row['paymethod_bank'] == 'ธนาคารกสิกรไทย'){echo "selected";}?>>ธนาคารกสิกรไทย</option>
                  <option value="ธนาคารไทยพานิชย์"<?php if ($row['paymethod_bank'] == 'ธนาคารไทยพานิชย์'){echo "selected";}?>>ธนาคารไทยพานิชย์</option>
                  <option value="ธนาคารยูโอบี"<?php if ($row['paymethod_bank'] == 'ธนาคารยูโอบี'){echo "selected";}?>>ธนาคารยูโอบี</option>
                  <option value="ธนาคารออมสิน"<?php if ($row['paymethod_bank'] == 'ธนาคารออมสิน'){echo "selected";}?>>ธนาคารออมสิน</option>
                  <option value="ธนาคารสแตนดาร์ดชาร์เตอร์"<?php if ($row['paymethod_bank'] == 'ธนาคารสแตนดาร์ดชาร์เตอร์'){echo "selected";}?>>ธนาคารสแตนดาร์ดชาร์เตอร์</option>
                </select>
            </div>
            <div class="form-group">
                <label>ประเภทบัญชี</label>
                <select class="btn border-default" name="paymethod_type">
                  <option value="ออมทรัพย์"<?php if ($row['paymethod_type'] == 'ออมทรัพย์'){echo "selected";}?>>ออมทรัพย์</option>
                  <option value="กระแสรายวัน"<?php if ($row['paymethod_type'] == 'กระแสรายวัน'){echo "selected";}?>>กระแสรายวัน</option>
                </select>
            </div>
            <div class="form-group">
                <label>สาขา</label>
                <input type="text" name="paymethod_branch" maxlength="140" class="btn border-default" value="<?php echo $row['paymethod_branch'];?>"></input>
            </div>
            <div class="form-group">
                <button class="button-primary" type="submit" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> อัพเดทข้อมูล</button>
            </div>
        </form>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-money" aria-hidden="true"></i> ลบช่องทางการชำระ</h5>
        <a class="text-red fg" href="" onclick="return deClick(<?php echo $row['paymethod_id']; ?>);">
          ลบช่องทางการชำระเงิน
        </a>
    </div>
    <script type="text/javascript">
        document.title = "แก้ไขช่องทางการชำระเงิน";
    </script>
    <script type="text/javascript">
        function deClick(payid) {
            var verified = window.confirm("คุณต้องการที่จะลบช่องทางการชำระเงินนี้หรือไม่?");
            if (verified) {
                dePaymethod(payid);
            }
            return false;
        }
    </script>
