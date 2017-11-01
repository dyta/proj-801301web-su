
    <?php if(!empty($_SESSION['user_email'])) {?>
    <div class="row">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-sliders" aria-hidden="true"></i> เมนูสมาชิก</h5>
        <div class="nav-category">
            <ul>
                <li><a class="text-black" href="?action=profile"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> แก้ไขโปรไฟล์</a></li>
                <?php if (!empty($_SESSION['user_group']) && $_SESSION['user_group'] != "0") {?>
                <li><a class="text-black" href="?action=admin"><i class="fa fa-fw fa-caret-right" aria-hidden="true"></i> จัดการระบบ</a></li>
                <?php }else{ ?>
                  <li><a class="text-black" href="?action=histories"><i class="fa fa-fw fa-shopping-basket" aria-hidden="true"></i> ประวัติการสั่งซื้อ</a></li>
                <?php } ?>
                <li><a class="text-black" href="?action=logout"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
    <?php }?>
