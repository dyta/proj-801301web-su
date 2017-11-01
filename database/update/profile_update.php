<?php
    $valid = true;
    $sql = "UPDATE `accounts` SET ";
    $sqlWh = "WHERE user_id = ".$_SESSION['user_id']."";

    //Name
    if(!empty($_POST['user_name'])){
        $user_name = mysqli_escape_string($DBConnect, $_POST['user_name']);
        $sql .= "user_name = '$user_name'";
    }else{
        $valid = false;
    }

    //Gender
    if(!empty($_POST['gender'])){
        $gender = mysqli_escape_string($DBConnect, $_POST['gender']);
        $sql .= ", user_gender = '$gender'";
    }else{
        $gender = "";
    }

    //Age
    if(!empty($_POST['user_age'])){
        $user_age = mysqli_escape_string($DBConnect, $_POST['user_age']);
        $sql .= ", user_age = '$user_age'";
    }else{
        $user_age = "";
    }

    //Tel
    if(!empty($_POST['user_tel'])){
        $user_tel = mysqli_escape_string($DBConnect, $_POST['user_tel']);
        $sql .= ", user_tel = '$user_tel'";
    }else{
        $user_tel ="";
    }

    //Address
    if(!empty($_POST['user_address'])){
        $user_address = mysqli_escape_string($DBConnect, $_POST['user_address']);
        $sql .= ", user_address = '$user_address'";
    }else{
        $user_address ="";
    }

    if($valid){
      $sql .= $sqlWh;
      mysqli_query($DBConnect, $sql);
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_gender'] = $gender;
      $_SESSION['user_age'] = $user_age;
      $_SESSION['user_tel'] = $user_tel;
      $_SESSION['user_address'] = $user_address;
      echo "อัพเดทข้อมูลเรียบร้อยแล้ว";
    }
?>
