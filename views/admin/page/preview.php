<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
if (empty($_GET['key'])) {
  echo "<script>window.location='/?access_denied';</script>";
}
$key = mysqli_escape_string($DBConnect, base64_decode($_GET['key']));
    $sqlJoin = "SELECT * FROM `page_content` WHERE `page_content`.`cont_id` = '$key'
            ";
    $result = mysqli_query($DBConnect, $sqlJoin, MYSQLI_USE_RESULT) or die('die');
    $row = mysqli_fetch_assoc($result);
    $result->close();
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <title>ตัวอย่าง</title>
            <meta name="author" content="13580030">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

            <link rel="icon" href="lib/images/favicon.png" type="image/x-icon" />
            <link rel="shortcut icon" href="lib/images/favicon.png" type="image/x-icon" />

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" async defer></script>

            <link rel="stylesheet" type="text/css" href="lib/css/normalize.min.css">
            <link rel="stylesheet" type="text/css" href="lib/css/thirty-style.min.css">


        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="u-full-width">
                        <img width="100%" src="uploads/cover.jpg" alt="">
                        <img width="100%" src="uploads/free_shipping.jpg" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="u-full-width">
                        <ul class="topnav" id="nav-default">
                            <li><a href="#"><i class="fa fa-fw fa-file-o" aria-hidden="true"></i> แสดงหน้าตัวอย่าง</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-star" aria-hidden="true"></i> <?php echo $row['cont_title']; ?></h5>
                    </div>
                    <div class="u-full-width">
                        <?php echo $row['cont_details']; ?>
                    </div>
                </div>

                <?php include 'views/footer.php'; ?>
