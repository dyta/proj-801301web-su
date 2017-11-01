<?php
$valid = true;

if(!empty($_POST['invoice_id'])){
    $invoice_id = mysqli_escape_string($DBConnect, $_POST['invoice_id']);
}else{
    $valid = false;
}

if(!empty($_POST['value'])){
    $value = mysqli_escape_string($DBConnect, $_POST['value']);
}else{
    $valid = false;
}

if ($valid) {
  $sql = "UPDATE `order_details` SET ordstatus_id = '$value' WHERE order_id = '$invoice_id'";
  mysqli_query($DBConnect, $sql) or die();
  echo "1";
}
