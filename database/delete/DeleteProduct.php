<?php
$valid = true;

if(!empty($_POST['key'])){
    $key = mysqli_escape_string($DBConnect, $_POST['key']);
}else{
    $valid = false;
}

if(!empty($_POST['img'])){
    $img = mysqli_escape_string($DBConnect, $_POST['img']);
}else{
    $valid = false;
}

if ($valid) {
  $dePrd = "DELETE FROM `product_list`WHERE `product_list`.`prod_id` = '$key'; DELETE FROM `images` WHERE `images`.`img_id` = '$img';";
  $result = mysqli_multi_query($DBConnect, $dePrd);
  echo "1";
}
