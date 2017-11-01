<?php


  $valid = true;

  if(!empty($_POST['key'])){
      $key = mysqli_escape_string($DBConnect, $_POST['key']);
  }else{
      $valid = false;
  }

  if(!empty($_POST['cont_title'])){
      $cont_title = mysqli_escape_string($DBConnect, $_POST['cont_title']);
  }else{
      $valid = false;
  }
  if(!empty($_POST['cont_url'])){
      $cont_url = mysqli_escape_string($DBConnect, $_POST['cont_url']);
  }else{
      $valid = false;
  }

  if(!empty($_POST['cont_published'])){
      $cont_published = mysqli_escape_string($DBConnect, $_POST['cont_published']);
  }

  if(!empty($_POST['cont_showontop'])){
      $cont_showontop = mysqli_escape_string($DBConnect, $_POST['cont_showontop']);
  }
  $value = mysqli_escape_string($DBConnect, $_POST['content_page']);


  if($valid){
        $result = mysqli_query($DBConnect, "UPDATE `page_content` SET cont_title = '$cont_title', cont_url = '$cont_url', cont_published = '$cont_published',cont_showontop = '$cont_showontop', cont_details = '$value', cont_date = now() WHERE cont_id = '$key'");
        echo "1";
  }else {
    echo"เกิดข้อผิดพลาด";
  }
