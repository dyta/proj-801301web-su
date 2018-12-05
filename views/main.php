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
