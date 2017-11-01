<?php
$valid = true;

if(!empty($_POST['key'])){
    $key = mysqli_escape_string($DBConnect, $_POST['key']);
}else{
    $valid = false;
}

if($valid){
      $result = mysqli_query($DBConnect, "DELETE FROM `payment_method` WHERE paymethod_id = $key");
      echo "1";
}else {
  echo "ไม่พบรายการ";
}
?>
