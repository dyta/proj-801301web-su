<?php
$valid = true;

if(!empty($_POST['key'])){
    $key = mysqli_escape_string($DBConnect, $_POST['key']);
}else{
    $valid = false;
}

if(!empty($_POST['type'])){
    $type = mysqli_escape_string($DBConnect, $_POST['type']);
}else{
    $valid = false;
}

if($valid){
    $sqlJoin = "SELECT `img_path` FROM `images` WHERE `images`.`img_id` = '$key'; DELETE FROM `images` WHERE `images`.`img_id` = '$key';";
    $result = mysqli_multi_query($DBConnect, $sqlJoin);
    $setValue = mysqli_store_result($DBConnect);
    $row = mysqli_fetch_assoc($setValue);
    $path = 'uploads/contents/';
    unlink( $path . $row['img_path']);
    echo "1";
}else {
  echo "ไม่สามารถลบรูปได้";
}
