<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Thirty Online Store</title>
    <meta name="author" content="13580030">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link rel="icon" href="lib/images/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="lib/images/favicon.png" type="image/x-icon" />
    <meta property="fb:app_id" content="1719253731620682" />
    <meta property="og:url" content="<?php echo " https://$_SERVER[HTTP_HOST] ";?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="ร้านค้า | Thirty Online Store" />
    <meta property="og:description" content="This website is for educational purpose. There is no intention of copyright infringement and no actual trade activities." />
    <meta property="og:image" content="<?php echo "https://$_SERVER[HTTP_HOST]";?>/uploads/SB02_Drape_Pants_Easy_Shots_20161209.jpg"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" async defer></script>

    <link rel="stylesheet" type="text/css" href="lib/css/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/thirty-style.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>
  <div class="container">
      <div class="row">
          <?php
            if(!empty($_GET['action'])){
            $page = mysqli_escape_string($DBConnect, $_GET['action']);
            if(
              $page != "admin" &&
              $page != "profile"
            ){?>
              <div class="u-full-width">
                  <img width="100%" src="uploads/cover.jpg" alt="">
                  <img width="100%" src="uploads/free_shipping.jpg" alt="">
              </div>
              <?php }}else {?>
              <div class="u-full-width">
                  <img width="100%" src="uploads/cover.jpg" alt="">
                  <img width="100%" src="uploads/free_shipping.jpg" alt="">
              </div>
              <?php }?>
      </div>
      <div class="row">
          <div class="u-full-width">
              <?php include 'navigator/navigator.php'; ?>
          </div>
      </div>
