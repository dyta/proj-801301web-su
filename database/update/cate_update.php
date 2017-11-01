<?php

$key = mysqli_escape_string($DBConnect, $_POST['key']);
$valid = true;
$sql = "UPDATE `product_category` SET ";
$sqlWh = "WHERE cate_id = '$key'";

  if(!empty($_POST['cate_name'])){
      $cate_name = mysqli_escape_string($DBConnect, $_POST['cate_name']);
      $sql .= "cate_name = '$cate_name'";
  }else{
      $valid = false;
  }

  if(!empty($_POST['cate_description'])){
      $cate_description = mysqli_escape_string($DBConnect, $_POST['cate_description']);
      $sql .= ", cate_description = '$cate_description' ";
  }

  if($valid){
    $sql .= $sqlWh;
      mysqli_query($DBConnect, $sql) or die("ชื่อซ้ำหมวดหมู่อื่น");
      echo "1";
  }else {
    echo "ไม่สามารถอัพเดทข้อมูลได้";
  }
?>
