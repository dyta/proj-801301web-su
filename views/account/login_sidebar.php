<div class="row">
    <div class="column" style="position: relative;">
      <div class="dimmer overlay-none">
        <div class="overlay-content">
          <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        </div>
      </div>
      <div class="alert-error" id="error"></div>
      <form id="login-form" name="login" class="text-center" onsubmit="return loginProcess();" method="post">
          <div class="form-group">
              <label>อีเมล์ <b class="text-red">*</b></label>
              <input type="email" class="form-control" name="email" placeholder="example@example.com" autocomplete="off">
          </div>
          <div class="form-group">
              <label>รหัสผ่าน <b class="text-red">*</b></label>
              <input type="password" class="form-control" name="password" placeholder="********" autocomplete="off">
          </div>
          <div class="form-group">
              <button type="submit" class="button-primary" name="btn-login" id="btn-login">เข้าสู่ระบบ</button >
          </div>
          <small>หากคุณยังไม่มีบัญชี? <a href="?action=register">สมัครสมาชิก</a></small>
      </form>
    </div>
</div>
