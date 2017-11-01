<?php

if(!empty($_GET['action'])){

    $page = mysqli_escape_string($DBConnect, $_GET['action']);
    if (
        $page != "uploadimages" &&
        $page != "preview" &&
        $page != "alltools"
      ) {
      require 'views/header.php';
    }

    /**
     * Login
     */
    if($page == "login"){
        include "views/account/login.php";
    }

    /**
     * Register
     */
    elseif ($page == "register") {
        include "views/account/register.php";
    }

    /**
     * Logout
     */
    elseif ($page == "logout"){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_age']);
        unset($_SESSION['user_gender']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_tel']);
        unset($_SESSION['user_address']);
        unset($_SESSION['user_avatar']);
        unset($_SESSION['user_group']);
        unset($_SESSION['user_date']);
        header("Location: /");
    }
    elseif ($page == "admin"){
        include "views/admin/dashboard.php";
    }
    elseif ($page == "profile"){
        include "views/account/profile.php";
    }
    elseif ($page == "uploadimages"){
        include "database/uploadImages.php";
    }
    elseif($page == "preview"){
        include "views/admin/page/preview.php";
    }
    elseif($page == "alltools"){
        include "views/alltools.php";
    }
    elseif ($page == "cart") {
        include "views/cart/cart.php";
    }
    elseif ($page == "product") {
        include "views/product/ProductInfo.php";
    }
    elseif ($page == "shipping") {
        include "views/order/shipping.php";
    }
    elseif ($page == "order") {
        include "views/order/order_list.php";
    }
    elseif ($page == "histories") {
        include "views/account/history.php";
    }
    elseif ($page == "payment") {
        include "views/payment/payment.php";
    }
    elseif ($page == "invoice") {
        include "views/payment/invoice.php";
    }
    elseif ($page == "cate") {
        include "views/category.php";
    }
    if ($page != "uploadimages" && $page != "preview" && $page != "alltools") {
      require 'views/footer.php';
    }
}else {
  require 'views/header.php';
  require 'views/main.php';
  require 'views/footer.php';
}
?>
