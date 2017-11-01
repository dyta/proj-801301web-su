<?php
    $valid = true;

    if(!empty($_POST['old_pass'])){
        $old_pass = mysqli_escape_string($DBConnect, $_POST['old_pass']);
    }else{
        $valid = false;
    }

    if(!empty($_POST['new_pass'])){
        $new_pass = mysqli_escape_string($DBConnect, $_POST['new_pass']);
    }else{
        $valid = false;
    }

    if(!empty($_POST['pass_retype'])){
        $pass_retype = mysqli_escape_string($DBConnect, $_POST['pass_retype']);
    }else{
        $valid = false;
    }

    if ($new_pass == $old_pass) {
      $valid = false;
      echo "0";
    }

    if($valid){
      $sql = "SELECT user_id,user_pass FROM `accounts` WHERE user_id = ".$_SESSION['user_id']." AND user_pass = MD5('".$old_pass."');";
      $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
      $row = mysqli_fetch_assoc($result);
      $result->close();
      if (!empty($row['user_id']) && !empty($row['user_pass'])) {
        $setPass = md5($new_pass);
        mysqli_query($DBConnect, "UPDATE `accounts` SET user_pass = '$setPass' WHERE user_id = ".$_SESSION['user_id']." AND user_pass = MD5('".$old_pass."');") or die('');
        echo "<p><i class='fa fa-check fa-fw'></i> อัพเดทข้อมูลเรียบร้อยแล้ว</p>";
      }else {
        echo "same";
      }
    }
?>
