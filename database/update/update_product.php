<?php
$valid = true;
if(!empty($_POST['key'])){
    $key = mysqli_escape_string($DBConnect, $_POST['key']);
}else{
    $valid = false;
}
if(!empty($_POST['img'])){
    $img = mysqli_escape_string($DBConnect, $_POST['img']);
}
if(!empty($_POST['prod_name'])){
    $prod_name = mysqli_escape_string($DBConnect, $_POST['prod_name']);
}

if(!empty($_POST['prod_cate'])){
    $prod_cate = mysqli_escape_string($DBConnect, $_POST['prod_cate']);
}

if(!empty($_POST['prod_price'])){
    $prod_price = mysqli_escape_string($DBConnect, $_POST['prod_price']);
}

if(isset($_POST['prod_discount'])){
    $prod_discount = mysqli_escape_string($DBConnect, $_POST['prod_discount']);
}

if(!empty($_POST['prod_description'])){
    $prod_description = mysqli_escape_string($DBConnect, $_POST['prod_description']);
}

$sql = "UPDATE `product_list` SET prod_name = '$prod_name', cate_id = '$prod_cate',
prod_price = '$prod_price', prod_discount = '$prod_discount', prod_description = '$prod_description' WHERE prod_id = '$key';";

if($valid){
  if(!empty($_FILES["file"]["tmp_name"])) {
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'อัพโหลดได้เฉพาะรูปภาพ ที่มีนามสกุล jpg, jpeg, png เท่านั้น';
    } else {

      $fileData = pathinfo(basename($_FILES["file"]["name"]));
      $filename_old = basename($_FILES["file"]["name"]);
      $fileName = RandomString(12).'_'.RandomString(8).'.'.$fileData['extension'];
      $target_path = ($_SERVER['DOCUMENT_ROOT'] . "/uploads/contents/" . $fileName);
      $imageFileType = pathinfo($target_path, PATHINFO_EXTENSION);

      $check = getimagesize($_FILES["file"]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          $uploadOk = 0;
      }

      if ($_FILES["file"]["size"] > 2000000) {
          echo"<script>alert('ขนาดไฟล์ต้องไม่เกิน 2MB');window.close();</script>";
          $uploadOk = 0;
      }elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
          echo"<script>alert('เฉพาะไฟล์นามสกุล jpg, jpeg, png, gifเท่านั้น');window.close();</script>";
          $uploadOk = 0;
      }

        if ($uploadOk != 0) {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)){
            $sql = "SELECT `img_path` FROM `images` WHERE `images`.`img_id` = '$img'; DELETE FROM `images` WHERE `images`.`img_id` = '$img';";
            mysqli_query($DBConnect, "INSERT INTO `images` (img_path, img_type, img_date) VALUES ('$fileName', 'product', now())");
            $return_lastid_img = mysqli_insert_id($DBConnect);
            $sql4 = "INSERT INTO `product_image` (prod_id, img_id) VALUES ('$key', '$return_lastid_img');";
            mysqli_query($DBConnect, $sql4);

            $result = mysqli_multi_query($DBConnect, $sql);
            $setValue = mysqli_store_result($DBConnect);
            $row = mysqli_fetch_assoc($setValue);

            $path = 'uploads/contents/';
            unlink($path . $row['img_path']);
            echo "1";


          } else{
              echo "เกิดข้อผิดพลาดในการอัพโหลด";
          }
        }
      }
  }else {
      mysqli_query($DBConnect, $sql);
      echo "1";
  }
}else {
  echo"เกิดข้อผิดพลาด";
}
