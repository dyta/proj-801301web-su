<?php
$valid = true;

if(!empty($_POST['order_id'])){
    $order_id = mysqli_escape_string($DBConnect, $_POST['order_id']);
}else{
    $valid = false;
}

//Payment
if(!empty($_POST['invoice_id'])){
    $invoice_id = mysqli_escape_string($DBConnect, $_POST['invoice_id']);
}else{
    $valid = false;
}

if(!empty($_POST['pay_amount'])){
    $pay_amount = mysqli_escape_string($DBConnect, $_POST['pay_amount']);
}else{
    $valid = false;
}

if(!empty($_POST['paymethod_id'])){
    $paymethod_id = mysqli_escape_string($DBConnect, $_POST['paymethod_id']);
}else{
    $valid = false;
}

if(!empty($_POST['pay_date'])){
    $pay_date = mysqli_escape_string($DBConnect, $_POST['pay_date']);
}else{
    $valid = false;
}

if ($valid) {
  $sql = "UPDATE `order_details` SET ordstatus_id = '1' WHERE order_id = '$order_id' AND user_id = ".$_SESSION['user_id'].";";
  $sql .= "INSERT INTO `payments` (invoice_id, pay_date, pay_amount, paymethod_id) VALUES ('$invoice_id', '$pay_date', '$pay_amount', '$paymethod_id');";
  $DBConnect->multi_query($sql);
  echo $pay_date;
}
