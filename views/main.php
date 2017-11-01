<div class="row">
  <section id="page">
    <div class="three columns sidebar">
      <?php
        include 'navigator/menu_avatar.php';
        include 'navigator/menu_sidebar.php';
        include 'navigator/menu_cate.php';
      ?>
    </div>
    <div class="nine columns main">
<?php if (empty($_SESSION['user_id'])) {?>
  <label>ตัวอย่างการใช้งานสำหรับ User ทั่วไป</label>
<pre><code>Email  : user@user.com
Password  : 123456</code></pre>
<label>ตัวอย่างการใช้งานสำหรับ Admin</label>
<pre><code>Email  : admin@admin.com
Password  : 123456</code></pre>
<?php } ?>
      <?php
      if(!empty($_GET['page'])){
          $page = mysqli_escape_string($DBConnect, $_GET['page']);
          include 'views/page.php';

      }else {
        include 'views/product/ProductLists.php';
      }?>
    </div>
  </section>
</div>
