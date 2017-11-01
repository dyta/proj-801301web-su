<?php
  if ($_SESSION['user_group'] !=1) {
    echo "<script>window.location='/?access_denied';</script>";
  }
  $user_id = mysqli_escape_string($DBConnect, base64_decode($_GET['user']));
  $user_name = mysqli_escape_string($DBConnect, base64_decode($_GET['verify']));

  if (empty($_GET['verify'])) {
    echo "<script>window.location='/?access_denied';</script>";
  }

  $sql = "SELECT COUNT(*) FROM `accounts` WHERE user_id = '$user_id' AND user_email = '$user_name'";
  $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
  $row = mysqli_fetch_assoc($result);
  $numEmail=$row['COUNT(*)'];
  if($numEmail==0){
    echo "<script>window.location='?action=admin&manage=account';</script>";
  }
  $result->close();
?>
    <div class="u-pull-right">
        <a class="border-black text-red" onclick="history.back()" style="float:right;" href="#"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> ลบบัญชีผู้ใช้</h5>
    </div>
    <div class="alert-error" id="error"></div>
    <div class="column no-margin note">
        <h5><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> คำแนะนำ</h5>
        <p>หากคุณเป็นผู้ดูแลระบบ คุณสามารถลบผู้ใช้ที่คุณไม่ต้องการให้เข้าถึงเว็บไซต์ในส่วนของสมาชิกได้อีกต่อไปเมื่อคุณลบผู้ใช้นี้แล้ว</p>
        <ul>
            <li>
                อีเมล์ของบัญชีที่คุณต้องการลบ คือ <small>Email: <?php echo $user_name; ?></small>
            </li>
            <li>
                รหัสสมาชิกของบัญชีที่คุณต้องการลบ คือ <small>Customer ID: <?php echo $user_id; ?></small>
            </li>
            <li>
                ขณะนี้คุณไม่สามารถลบบัญชีที่เป็นผู้ดูแลระบบได้
            </li>
            <li>
                ระบบจะทำการลบข้อมูลต่างๆที่เกี่ยวข้องกับบัญชีผู้ใช้นี้ทั้งหมดโดยถาวร
            </li>
            <li>
                หลังจากข้อมูลถูกลบ จะไม่สามารถทำการกู้คืนข้อมูลได้
            </li>
            <li>พิมพ์คำว่า <i><u>ลบบัญชี</u></i> เพื่อยืนยันการลบบัญชี</li>
        </ul>
        <div class="offset-by-three six columns text-center">
          <form action="#" name="comfirm" onsubmit="return DeleteAccount(<?php echo $user_id; ?>)" method="POST">
              <div class="form-group">
                  <input type="text" class="btn border-default text-center" name="confirm_del" />
              </div>
              <div class="form-group">
                  <button type="submit" class="btn border-default btn-green" name="submit"><i class="fa fa-fw fa-check" aria-hidden="true"></i> ยืนยัน</button>
              </div>
          </form>
        </div>
    </div>


<script type="text/javascript">
  document.title = "ลบบัญชี";
</script>
