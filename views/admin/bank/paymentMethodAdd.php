<?php
if ($_SESSION['user_group'] != 1) {
  echo "<script>window.location='/?action=login';</script>";
}
?>
    <div class="u-pull-right">
        <a class="text-red" style="float:right;" href="?action=admin&manage=paymethod"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-money" aria-hidden="true"></i> เพิ่มช่องทางการชำระเงิน <small>โอนผ่านธนาคาร</small></h5>
    </div>
    <div class="row">
        <div class="u-full-weight">
            <div class="alert-error" id="error"></div>
            <form action="#" name="payment_methodAdd" onsubmit="return paymethodCHK()" method="POST">
                <div class="form-group">
                    <label>ชื่อบัญชี</label>
                    <input type="text" name="paymethod_name" maxlength="140"></input>
                </div>
                <div class="form-group">
                    <label>เลขที่บัญชี</label>
                    <input type="text" name="paymethod_no" maxlength="20" pattern="[0-9]+"></input>
                </div>
                <div class="form-group">
                    <label>ธนาคาร</label>
                    <select name="paymethod_bank">
                      <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                      <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                      <option value="ธนาคารกรุงศรี">ธนาคารกรุงศรี</option>
                      <option value="ธนาคารทหารไทย">ธนาคารทหารไทย</option>
                      <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                      <option value="ธนาคารไทยพานิชย์">ธนาคารไทยพานิชย์</option>
                      <option value="ธนาคารยูโอบี">ธนาคารยูโอบี</option>
                      <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                      <option value="ธนาคารสแตนดาร์ดชาร์เตอร์">ธนาคารสแตนดาร์ดชาร์เตอร์</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ประเภทบัญชี</label>
                    <select name="paymethod_type">
                      <option value="ออมทรัพย์">ออมทรัพย์</option>
                      <option value="กระแสรายวัน">กระแสรายวัน</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>สาขา</label>
                    <input type="text" name="paymethod_branch" maxlength="140"></input>
                </div>
                <div class="form-group">
                    <button type="submit" class="button-primary" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> เพิ่ม</button>
                </div>
            </form>
        </div>
    </div>
        <script type="text/javascript">
            document.title = "เพิ่มช่องทางการชำระเงิน";
        </script>
