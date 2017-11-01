<?php

    if(!empty($_FILES["file"]["tmp_name"]) && !empty($_SESSION['user_avatar'])) {
      if ( 0 < $_FILES['file']['error'] ) {
          echo 'อัพโหลดได้เฉพาะรูปภาพ ที่มีนามสกุล jpg, jpeg, png เท่านั้น';
      } else {

        $fileData = pathinfo(basename($_FILES["file"]["name"]));
        $fileName = md5($_SESSION['user_id']). '.' . $fileData['extension'];
        $target_path = ($_SERVER['DOCUMENT_ROOT'] . "/uploads/avatar/" . $fileName);
        $imageFileType = pathinfo($target_path, PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($_FILES["file"]["size"] > 200000) {
            echo "1";
            $uploadOk = 0;
        }elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "2";
            $uploadOk = 0;
        }

          if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)){
                mysqli_query($DBConnect, "UPDATE `accounts` SET user_avatar = '$fileName' WHERE user_id = ".$_SESSION['user_id']."");
                $_SESSION['user_avatar'] = $fileName;
                echo "อัพเดทข้อมูลเรียบร้อยแล้ว";
            } else{
                echo "เกิดข้อผิดพลาดในการอัพโหลด";
            }
          }
        }
    }
