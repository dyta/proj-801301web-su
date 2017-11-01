<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}

$user_id = mysqli_escape_string($DBConnect, base64_decode($_GET['user']));

if (empty($_GET['user'])) {
  echo "<script>window.location='/?access_denied';</script>";
}

$sql = "SELECT * FROM `accounts` WHERE user_id = '$user_id'";
$result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
$row = mysqli_fetch_assoc($result);
if (!$row){
  echo "<script>window.location='/?action=admin&manage=account';</script>";
}
?>
<div class="u-pull-right">
  <a class="text-red" onclick="history.back()" style="float:right;" href="#"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
</div>
<div class="u-full-width">
  <h5 class="text-blue text-18x"><i class="fa fa-fw fa-user" aria-hidden="true"></i> ข้อมูลบัญชี <small>Customer ID: <?php echo $row['user_id']; ?></small></h5>
</div>
<div class="row">
  <div class="four columns text-center no-margin">
      <img width="180px" src="uploads/avatar/<?php echo $row['user_avatar'];?>">
  </div>
  <div class="eight columns">
      <div class="u-full-width">
          <label class="account_info">ระดับสมาชิก</label>
          <input type="text" readonly="" style="background: transparent;" value="<?php if ($row['user_group'] == 0){echo " สมาชิกทั่วไป ";} else {echo 'ผู้ดูแลระบบ';} ?>"></input>
      </div>
      <div class="u-full-width">
          <label class="account_info">Fullname / ชื่อ-นามสกุล</label>
          <input type="text" readonly="" style="background: transparent;" value="<?php echo $row['user_name']; ?>"></input>
      </div>
      <div class="u-full-width">
          <label class="account_info">Email / อีเมล์</label>
          <input type="text" readonly="" style="background: transparent;" value="<?php echo $row['user_email']; ?>"></input>
      </div>
      <div class="six columns no-margin no-padding">
          <label class="account_info">Gender / เพศ</label>
          <input type="text" readonly="" style="background: transparent;" value="<?php if ($row['user_gender'] == 'ชาย'){echo "ชาย";} elseif($row['user_gender'] == 'หญิง'){ echo 'หญิง';} else {echo 'ไม่ระบุ';} ?>"></input>
      </div>
      <div class="six columns no-padding">
          <label class="account_info">Age / อายุ</label>
          <input type="text" readonly="" style="background: transparent;" maxlength="2" value="<?php if ($row['user_age'] == null){echo " ไม่ระบุ ";} else {echo $row['user_age'];} ?>"></input>
      </div>
      <div class="six columns no-margin no-padding">
          <label class="account_info">Tel / เบอร์โทรศัพท์</label>
          <input type="text" readonly="" style="background: transparent;" maxlength="10" value="<?php if ($row['user_tel'] == null){echo " ไม่ระบุ ";} else {echo $row['user_tel'];} ?>"></input>
      </div>
      <div class="six columns no-padding">
          <label class="account_info">Registered Date</label>
          <input type="text" readonly="" style="background: transparent;" value="<?php echo DateFormate($row['user_date']);?>"></input>
      </div>
      <div class="u-full-width">
          <label class="account_info">Address / ที่อยู่</label>
          <textarea rows="4" readonly="" style="background: transparent;" cols="100"><?php if ($row['user_address'] == null){echo "ไม่ระบุ";} else {echo $row['user_address'];} ?></textarea>
      </div>
  </div>

</div>

<?php if($row['user_group'] == '0') {?>
  <h5 class="text-blue text-18x"><i class="fa fa-fw fa-history" aria-hidden="true"></i> ประวัติรายการสั่งซื้อ</h5>
  <div class="row">
    <div class="u-full-width">
      <table class="u-full-width">
        <tr>
          <th>รหัสคำสั่งซื้อ</th>
          <th>สถานะคำสั่งซื้อ</th>
          <th>วันที่ทำรายการ</th>
        </tr>
        <tr>
          <td class="text-center" colspan="4">ไม่พบรายการ</td>
        </tr>
      </table>
    </div>
  </div>
  <h5 class="text-blue text-18x"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> ลบบัญชีผู้ใช้</h5>
  <div class="col-m12 text-left">
    <div class="u-full-width">
      <button class="button-primary" onclick="location.href='?action=admin&amp;manage=accountDelete&amp;user=<?php echo $_GET['user'];?>&amp;verify=<?php echo base64_encode($row['user_email']); ?>'">ยืนยันการลบบัญชี</a>
    </div>
  </div>
</div>
<?php }?>
<script type="text/javascript">
  document.title = "ข้อมูลบัญชี";
</script>
