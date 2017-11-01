<?php
$valid = true;

if(!empty($_POST['key'])){
    $key = mysqli_escape_string($DBConnect, $_POST['key']);
}else{
    $valid = false;
}

if($valid){
      mysqli_query($DBConnect, "DELETE FROM `product_category` WHERE cate_id = $key");
      echo "1";
}else {
  echo "ไม่สามารถลบหมวดหมู่นี้ได้";
}
?>
