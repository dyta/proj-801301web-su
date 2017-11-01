<?php
$valid = true;

if(!empty($_POST['order_id'])){
    $order_id = mysqli_escape_string($DBConnect, $_POST['order_id']);
}else{
    $valid = false;
}
if ($valid) {
  $sql = "UPDATE `order_details` SET ordstatus_id = '7' WHERE order_id = '$order_id' AND user_id = ".$_SESSION['user_id']."";
  mysqli_query($DBConnect, $sql) or die();
  echo "1";
}
