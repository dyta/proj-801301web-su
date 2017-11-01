<?php
$valid = true;
if (!empty($_POST['paymethod_name'])) {
    $paymethod_name = mysqli_escape_string($DBConnect, $_POST['paymethod_name']);
}else{
    $valid = false;
}

if (!empty($_POST['paymethod_no'])) {
    $paymethod_no = mysqli_escape_string($DBConnect, $_POST['paymethod_no']);
}else{
    $valid = false;
}

if (!empty($_POST['paymethod_bank'])) {
    $paymethod_bank = mysqli_escape_string($DBConnect, $_POST['paymethod_bank']);
}else{
    $valid = false;
}

if (!empty($_POST['paymethod_type'])) {
    $paymethod_type = mysqli_escape_string($DBConnect, $_POST['paymethod_type']);
}else{
    $valid = false;
}

if (!empty($_POST['paymethod_branch'])) {
    $paymethod_branch = mysqli_escape_string($DBConnect, $_POST['paymethod_branch']);
}else{
    $valid = false;
}

if($valid){

    $sql = "SELECT COUNT(*) FROM `payment_method` WHERE paymethod_no = '$paymethod_no'";
    $result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
    $row = mysqli_fetch_assoc($result);
    $numBank=$row['COUNT(*)'];
    $result->close();

    if($numBank!=0){
      echo "หมายเลขบัญชีนี้มีอยู่ในระบบแล้ว";
    }else {
      $sql = "INSERT INTO `payment_method` (paymethod_name, paymethod_no, paymethod_bank, paymethod_type, paymethod_branch) VALUES ('$paymethod_name','$paymethod_no','$paymethod_bank','$paymethod_type','$paymethod_branch')";
      mysqli_query($DBConnect, $sql) or die("Insert error!");
      echo "1";
    }
}else {
  echo "ไม่สามารถเพิ่มบัญชีได้";
}
?>
