<?php
require_once 'database/config.inc.php';
session_start();

if(!empty($_GET['auth'])){

    switch (mysqli_escape_string($DBConnect, $_GET['auth'])) {
        case 'login':
            include "database/login.php";
            break;
        case 'register':
            include "database/register.php";
            break;
        case 'avatar':
            include "database/update/profile_avatar.php";
            break;
        case 'updateprofile':
            include "database/update/profile_update.php";
            break;
        case 'updateprofile_p':
            include "database/update/profile_password.php";
            break;
        case 'deleteaccount':
            include 'database/delete/DeleteAccount.php';
            break;
        case 'createCate':
            include 'database/insert/insertCategory.php';
            break;
        case 'updateCate':
            include 'database/update/cate_update.php';
            break;
        case 'deleteCate':
            include 'database/delete/DeleteCategory.php';
            break;
        case 'payMetAdd':
            include 'database/insert/insertPaymentMethod.php';
            break;
        case 'payMetDel':
            include 'database/delete/DeletePaymentMethod.php';
            break;
        case 'payMetUpd':
            include 'database/update/update_paymentMethod.php';
            break;
        case 'createPage':
            include 'database/insert/insertPage.php';
            break;
        case 'updatePage':
            include 'database/update/update_page.php';
            break;
        case 'deletePage':
            include 'database/delete/DeletePage.php';
            break;
        case 'deleteImage':
            include 'database/delete/DeleteImage.php';
            break;
        case 'createProduct':
            include 'database/insert/insertProduct.php';
            break;
        case 'updateProduct':
            include 'database/update/update_product.php';
            break;
        case 'deleteProduct':
            include 'database/delete/DeleteProduct.php';
            break;
        case 'addcart':
            include 'database/addcart.php';
            break;
        case 'removecart':
            include 'database/delete/DeleteCart.php';
            break;
        case 'addqty':
            include 'database/insert/insertQty.php';
            break;
        case 'deorder':
            include 'database/delete/DeleteOrder.php';
            break;
        case 'doinvoice':
            include 'database/insert/insertInvoice.php';
            break;
        case 'updateorderad':
            include 'database/update/order_update.php';
            break;
    }
  }
