<?php
    $valid = true;

    if (empty($_COOKIE['_timeLog'])) {
      if(!empty($_POST['email'])){
          $email = mysqli_escape_string($DBConnect, $_POST['email']);
      }else{
          $valid = false;
      }

      if(!empty($_POST['password'])){
          $password = mysqli_escape_string($DBConnect, $_POST['password']);
      }else{
          $valid = false;
      }


      if($valid){
          $sql = "SELECT * FROM `accounts` WHERE user_email = '$email' AND user_pass = MD5('".$password."')";

          $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');

          $row = mysqli_fetch_assoc($result);
          if (!empty($row['user_id']) && !empty($row['user_email'])) {
            //assign query to SESSION
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_age'] = $row['user_age'];
            $_SESSION['user_gender'] = $row['user_gender'];
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['user_tel'] = $row['user_tel'];
            $_SESSION['user_address'] = $row['user_address'];
            $_SESSION['user_avatar'] = $row['user_avatar'];
            $_SESSION['user_group'] = $row['user_group'];
            $_SESSION['user_date'] = $row['user_date'];

            // echo"<script>alert('คุณได้ทำการเข้าสู่ระบบแล้ว ในชื่อ (".$_SESSION['user_name'].")');window.location='/';</script>";

            echo 'ok';
            if(!empty($_SESSION['rdr'])){
                unset($_SESSION['rdr']);
                echo "<script>window.location='?action=shipping';</script>";
            }
          }else {
            setcookie("_timeLog", 'on', time()+15);
            echo '<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ไม่พบอีเมล์นี้ในระบบ หรือรหัสผ่านไม่ถูกต้อง</p>';
          }
      }
    }else {
      echo '<p><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> กรุณารอ 15 วินาที ในการเข้าสู่ระบบครั้งต่อไป</p>';
    }


    if(!$valid){
      echo "<script>window.location='/';</script>";
    }
