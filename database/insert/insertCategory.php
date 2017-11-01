<?php
    $valid = true;

    if(!empty($_POST['cate_name'])){
        $cate_name = mysqli_escape_string($DBConnect, $_POST['cate_name']);
    }else{
        $valid = false;
    }

    $sql = "SELECT COUNT(*) FROM `product_category` WHERE cate_name = '$cate_name'";
    $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
    $row = mysqli_fetch_assoc($result);
    $cateCHK=$row['COUNT(*)'];
    $result->close();

    if($cateCHK!=0){
      $valid = false;
    }

    if($valid){
      $sql = "INSERT INTO `product_category` (cate_name, cate_description, cate_date) VALUES ('$cate_name','ไม่ระบุ', now())";
      mysqli_query($DBConnect, $sql);
      echo "1";
    }else {
      echo "หมวดหมู่นี้มีในระบบแล้ว";
    }
