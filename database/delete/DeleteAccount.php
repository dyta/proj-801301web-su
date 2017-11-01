<?php

  $valid = true;

  if(!empty($_POST['confirm_del'])){
      $confirm_del = mysqli_escape_string($DBConnect, $_POST['confirm_del']);
  }else{
      $valid = false;
  }

  if(!empty($_POST['user_id'])){
      $user_id = mysqli_escape_string($DBConnect, $_POST['user_id']);
  }else{
      $valid = false;
  }

  if($valid){
      if ($confirm_del != "ลบบัญชี") {
        echo "ยืนยันไม่ถูกต้อง";
      }else {
        $result = mysqli_query($DBConnect, "DELETE FROM `accounts` WHERE user_id = $user_id AND user_group != 1");
        echo "ลบบัญชีผู้ใช้เรียบร้อยแล้ว";
      }
  }
?>
