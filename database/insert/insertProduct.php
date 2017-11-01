<?php
$valid = true;
if(!empty($_POST['prod_name'])){
    $prod_name = mysqli_escape_string($DBConnect, $_POST['prod_name']);
}else{
    $valid = false;
}

if(!empty($_POST['prod_cate'])){
    $prod_cate = mysqli_escape_string($DBConnect, $_POST['prod_cate']);
}else{
    $valid = false;
}

if(!empty($_POST['prod_price'])){
    $prod_price = mysqli_escape_string($DBConnect, $_POST['prod_price']);
}else{
    $valid = false;
}

if(isset($_POST['prod_discount'])){
    $prod_discount = mysqli_escape_string($DBConnect, $_POST['prod_discount']);
}else{
    $valid = false;
}

if(!empty($_POST['prod_description'])){
    $prod_description = mysqli_escape_string($DBConnect, $_POST['prod_description']);
}else{
    $prod_description = '';
}

if($valid){
  $sql = "INSERT INTO `product_list` (`prod_id`, `cate_id`, `prod_name`, `prod_price`, `prod_discount`, `prod_description`) VALUES (NULL, '$prod_cate', '$prod_name', '$prod_price', '$prod_discount', '$prod_description');";
  $result = mysqli_query($DBConnect, $sql);
  $return_lastid_product = mysqli_insert_id($DBConnect);

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
        mysqli_query($DBConnect, "INSERT INTO `images` (img_path, img_type, img_date) VALUES ('$fileName', 'product', now())");
        $return_lastid_img = mysqli_insert_id($DBConnect);
        mysqli_query($DBConnect,"INSERT INTO `product_image` (prod_id, img_id) VALUES ('$return_lastid_product', '$return_lastid_img');");
        echo "1";

    } else{
        echo"เกิดข้อผิดพลาดในการอัพโหลด";
    }
  }
}
