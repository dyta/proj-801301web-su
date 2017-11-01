<div class="row">
  <section id="page">
    <div class="three columns sidebar">
        <?php
        include 'views/navigator/menu_avatar.php';
        include 'views/navigator/menu_sidebar.php';
        if($_SESSION['user_group'] == '0' || empty($_SESSION['user_group'])) {
          echo "<script>window.location='?access_denied'</script>";
        }
        ?>
        <div class="row">
            <h5 class="text-blue text-18x"><i class="fa fa-fw fa-cog" aria-hidden="true"></i> แผงควบคุม</h5>
            <div class="nav-category">
                <ul>
                    <li><a class="text-black" href="?action=admin"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> ภาพรวม</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=category"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> หมวดหมู่สินค้า</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=product"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> รายการสินค้า</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=order"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> รายการคำสั่งซื้อ</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=paymethod"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> ช่องทางชำระเงิน</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=pageList"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> แก้ไขหน้าเนื้อหา</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=imagesList"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> จัดการรูปภาพ</a></li>
                    <li><a class="text-black" href="?action=admin&amp;manage=account&amp;search="><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> จัดการสมาชิก</a></li>
                </ul>
            </div>
        </div>
      </div>
      <div class="nine columns main">
      <?php if(!empty($_GET['manage'])){
          $page = mysqli_escape_string($DBConnect, $_GET['manage']);
          if($page == "account"){
              include "account/accountList.php";
          }
          elseif($page == "category"){
              include "category/categoryList.php";
          }
          elseif($page == "categoryDelete"){
              include "category/categoryDelete.php";
          }
          elseif($page == "categoryDetails"){
              include "category/categoryInfo.php";
          }
          elseif($page == "paymethod"){
              include "bank/paymentMethod.php";
          }
          elseif($page == "paymethodAdd"){
              include "bank/paymentMethodAdd.php";
          }
          elseif($page == "paymethodEdit"){
              include "bank/paymentMethodUpdate.php";
          }
          elseif($page == "paymethodDelete"){
              include "bank/paymentMethodDelete.php";
          }
          elseif($page == "accountDetails"){
              include "account/accountInfo.php";
          }
          elseif($page == "accountDelete"){
              include "account/accountDelete.php";
          }
          elseif($page == "pageAdd"){
              include "page/pageAdd.php";
          }
          elseif($page == "pageList"){
              include "page/pageList.php";
          }
          elseif($page == "pageEdit"){
              include "page/pageInfo.php";
          }
          elseif($page == "pageDelete"){
              include "page/pageDelete.php";
          }

          elseif($page == "imagesList"){
              include "image/imagesList.php";
          }
          elseif($page == "product"){
              include "product/productList.php";
          }
          elseif($page == "productAdd"){
              include "product/productAdd.php";
          }
          elseif($page == "productinfo"){
              include "product/productInfo.php";
          }
          elseif($page == "order"){
              include "order/orderList.php";
          }
          elseif($page == "orderInfor"){
              include "order/orderInfor.php";
          }

      }else {?>
        <div class="row">
          <div class="u-full-width text-center">
            <img width="100%" src="uploads/contents/JI8t1TduTijy_EqyS8fwa.jpg">
            <h4>ระบบบริหารจัดการร้านค้า</h4>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
</div>
