<?php
require_once 'database/config.inc.php';
session_start();

if(!empty($_GET['auth'])){

    $page = mysqli_escape_string($DBConnect, $_GET['auth']);

    if($page == "login"){
        include "database/login.php";
    }
    elseif ($page == "register") {
        include "database/register.php";
    }
    elseif ($page == "avatar") {
        include "database/update/profile_avatar.php";
    }
    elseif ($page == "updateprofile") {
        include "database/update/profile_update.php";
    }
    elseif ($page == "updateprofile_p") {
        include "database/update/profile_password.php";
    }
    elseif ($page == "deleteaccount") {
        include 'database/delete/DeleteAccount.php';
    }
    elseif ($page == "createCate") {
        include 'database/insert/insertCategory.php';
    }
    elseif ($page == "updateCate") {
        include 'database/update/cate_update.php';
    }
    elseif ($page == "deleteCate") {
        include 'database/delete/DeleteCategory.php';
    }
    elseif ($page == "payMetAdd") {
        include 'database/insert/insertPaymentMethod.php';
    }
    elseif ($page == "payMetDel") {
        include 'database/delete/DeletePaymentMethod.php';
    }
    elseif ($page == "payMetUpd") {
        include 'database/update/update_paymentMethod.php';
    }
    elseif ($page == "createPage") {
        include 'database/insert/insertPage.php';
    }
    elseif ($page == "updatePage") {
        include 'database/update/update_page.php';
    }
    elseif ($page == "deletePage") {
        include 'database/delete/DeletePage.php';
    }
    elseif ($page == "deleteImage") {
        include 'database/delete/DeleteImage.php';
    }
    elseif ($page == "createProduct") {
        include 'database/insert/insertProduct.php';
    }
    elseif ($page == "updateProduct") {
        include 'database/update/update_product.php';
    }
    elseif ($page == "deleteProduct") {
        include 'database/delete/DeleteProduct.php';
    }
    elseif ($page == "addcart") {
        include 'database/addcart.php';
    }
    elseif ($page == "removecart") {
        include 'database/delete/DeleteCart.php';
    }
    elseif ($page == "addqty") {
        include 'database/insert/insertQty.php';
    }
    elseif ($page == "deorder") {
        include 'database/delete/DeleteOrder.php';
    }
    elseif ($page == "doinvoice") {
        include 'database/insert/insertInvoice.php';
    }
    elseif ($page == "updateorderad") {
        include 'database/update/order_update.php';
    }

  }
