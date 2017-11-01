<?php if(!empty($_SESSION['user_email']) && !empty($_SESSION['user_name'])) {
  header("Location: /?logged");
}?>
<div class="row" id="fullheight">
    <div class="column">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-user" aria-hidden="true"></i> เข้าสู่ระบบ</h5>
    </div>
    <div class="offset-by-four four columns">
        <?php include 'login_sidebar.php'; ?>
    </div>
</div>
<script type="text/javascript">
  document.title = "เข้าสู่ระบบ";
</script>
