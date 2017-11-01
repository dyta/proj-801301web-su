<?php
    $valid = true;

    if(!empty($_POST['page_name'])){
        $page_name = mysqli_escape_string($DBConnect, $_POST['page_name']);
    }else{
        $valid = false;
    }

    if(!empty($_POST['page_url'])){
        $page_url = mysqli_escape_string($DBConnect, $_POST['page_url']);
    }else{
        $valid = false;
    }

    $sql = "SELECT COUNT(*) FROM `page_content` WHERE cont_title = '$page_name'";
    $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
    $row = mysqli_fetch_assoc($result);
    $cateCHK=$row['COUNT(*)'];
    $result->close();

    if($cateCHK!=0){
      $valid = false;
    }

    if($valid){
      $sql = "INSERT INTO `page_content` (cont_title, cont_url, cont_details, cont_published, cont_showontop, cont_date) VALUES ('$page_name', '$page_url', '', 'off', 'off', now())";
      mysqli_query($DBConnect, $sql);
      echo "1";
    }else {
      echo "มีหน้านี้อยู่ในระบบแล้ว";
    }
