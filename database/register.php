<?php
    $valid = true;

    if (empty($_COOKIE['_timeIns'])) {
      setcookie("_timeIns", 'on', time()+300);
      if (!empty($_POST['name'])) {
          $name = mysqli_escape_string($DBConnect, $_POST['name']);
      }else{
          $valid = false;
      }

      if (!empty($_POST['email'])) {
          $email = mysqli_escape_string($DBConnect, $_POST['email']);
      }else{
          $valid = false;
      }

      if (!empty($_POST['password'])) {
          $password = mysqli_escape_string($DBConnect, $_POST['password']);
      }else{
          $valid = false;
      }

      if (!empty($_POST['repassword'])) {
          $repassword = mysqli_escape_string($DBConnect, $_POST['repassword']);
      }else{
          $valid = false;
      }

      if($valid){

          $sql = "SELECT COUNT(*) FROM `accounts` WHERE user_email = '$email'";
          $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
          $row = mysqli_fetch_assoc($result);
          $numEmail=$row['COUNT(*)'];
          $result->close();
          if($numEmail!=0){
            echo "2";
          }else {
            $sql = "INSERT INTO `accounts` (user_name, user_email, user_pass, user_avatar, user_group, user_date) VALUES ('$name', '$email', MD5('".$password."'), 'default.gif', 0, now())";
            $result = mysqli_query($DBConnect, $sql) or die("Error!");
            echo "คุณได้ทำการสมัครสมาชิกเรียบร้อยแล้ว คุณสามารถใช้อีเมล์ (".$email.") นี้ในการเข้าสู่ระบบ";
          }
        }
      }else {
        echo "1";
      }

    if(!$valid){
      echo "ERROR 123";
    }

    $DBConnect->close();
