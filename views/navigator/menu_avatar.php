<?php if(!empty($_SESSION['user_email'])) {?>
  <div class="row">
      <div class="col-m12 text-center" style="margin-top: 20px;">
          <img class="profiles_img" alt="<?php echo $_SESSION['user_name']; ?>" src="uploads/avatar/<?php echo $_SESSION['user_avatar']; ?>">
          <p>
              <small><?php echo $_SESSION['user_name'];?></small><br>
              <a class="text-red" href="?action=logout"><i class="fa fa-fw fa-power-off" aria-hidden="true"></i> ออกจากระบบ</a>
          </p>
      </div>
  </div>
<?php }else{?>
<h5 class="text-blue text-18x"><i class="fa fa-fw fa-user" aria-hidden="true"></i> เข้าสู่ระบบ</h5>
<?php include 'views/account/login_sidebar.php'; ?>
<?php } ?>
