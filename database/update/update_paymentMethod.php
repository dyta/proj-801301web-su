<?php

$valid = true;
$key = mysqli_escape_string($DBConnect, $_POST['key']);
$sql = "UPDATE `payment_method` SET ";
$sqlWh = "WHERE paymethod_id = '$key'";

if(!empty($_POST['paymethod_name'])){
    $paymethod_name = mysqli_escape_string($DBConnect, $_POST['paymethod_name']);
    $sql .= "paymethod_name = '$paymethod_name'";
}else{
    $valid = false;
}

if(!empty($_POST['paymethod_no'])){
    $paymethod_no = mysqli_escape_string($DBConnect, $_POST['paymethod_no']);
    $sql .= ", paymethod_no = '$paymethod_no'";
}else{
    $valid = false;
}

if(!empty($_POST['paymethod_bank'])){
    $paymethod_bank = mysqli_escape_string($DBConnect, $_POST['paymethod_bank']);
    $sql .= ", paymethod_bank = '$paymethod_bank'";
}else{
    $valid = false;
}

if(!empty($_POST['paymethod_type'])){
    $paymethod_type = mysqli_escape_string($DBConnect, $_POST['paymethod_type']);
    $sql .= ", paymethod_type = '$paymethod_type'";
}else{
    $valid = false;
}

if(!empty($_POST['paymethod_branch'])){
    $paymethod_branch = mysqli_escape_string($DBConnect, $_POST['paymethod_branch']);
    $sql .= ", paymethod_branch = '$paymethod_branch'";
}else{
    $valid = false;
}

if($valid){
  $sql .= $sqlWh;

  mysqli_query($DBConnect, $sql) or die('555');
  echo "1";

}else {
  echo"ไม่สามารถอัพเดทข้อมูลได้";
}

?>
