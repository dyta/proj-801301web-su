<?php if(!empty($_SESSION['user_email']) && !empty($_SESSION['user_name'])) {
  header("Location: /?logged");
}?>
<div class="row" id="fullheight">
    <div class="column">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-user" aria-hidden="true"></i> สมัครสมาชิก</h5>
    </div>
    <div class="offset-by-four four columns">
        <div class="row">
            <div class="alert-error" id="error"></div>
            <form name="register" id="regis-form" class="text-center" method="post" onsubmit="return regisProcess()">
                <div class="form-group">
                    <label>ชื่อ-นามสกุล <b class="text-red">*</b></label>
                    <input type="text" class="form-control" name="name" placeholder="John Doe" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>อีเมล์ <b class="text-red">*</b></label>
                    <input type="email" class="form-control" name="email" placeholder="example@example.com" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>รหัสผ่าน <b class="text-red">*</b></label>
                    <input type="password" class="form-control" name="password" placeholder="******">
                </div>
                <div class="form-group">
                    <label>ยืนยันรหัสผ่าน <b class="text-red">*</b></label>
                    <input type="password" class="form-control" name="repassword" placeholder="******">
                </div>
                <div class="form-group">
                    <button type="submit" class="button-primary" name="btn-regis" id="btn-regis">สมัครสมาชิก</button >
                </div>
                <small>คุณมีบัญชีอยู่แล้ว? <a href="?action=login">เข้าสู่ระบบ</a></small>
          </form>
      </div>
    </div>
</div>
<script type="text/javascript">
  document.title = "สมัครสมาชิก";
</script>
