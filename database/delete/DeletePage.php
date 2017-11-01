<?php
$valid = true;

if(!empty($_POST['key'])){
    $key = mysqli_escape_string($DBConnect, $_POST['key']);
}else{
    $valid = false;
}

if($valid){
    $sqlJoin = "DELETE FROM `page_content`WHERE `page_content`.`cont_id` = '$key';";

    // $sqlJoin = "DELETE `page_content`, `page_image` FROM `page_content`
    //       JOIN `page_image` ON `page_image`.`cont_id` = `page_content`.`cont_id`
    //       WHERE `page_content`.`cont_id` = '$key'; ";

    $res = $DBConnect->query($sqlJoin);
    if (!$res) {
       printf("<br>Errormessage: %s\n", $DBConnect->error);
    }

    if (!empty($_SESSION["img_sql"])) {

      $select = "SELECT `img_path` FROM `images` WHERE ";
      $sqlJoin2 = "DELETE `images` FROM `images` WHERE ";

        for ($i=0; $i < count($_SESSION["img_sql"]); $i++) {
          if ($i>0) {
            $select .= " OR ";
            $sqlJoin2 .= " OR ";
          }
          $imgid = $_SESSION["img_sql"][$i];
          $select .= "`images`.`img_id` = '$imgid'";
          $sqlJoin2 .= "`images`.`img_id` = '$imgid'";
        }
          $result = mysqli_query($DBConnect, $select);
          while($row = mysqli_fetch_assoc($result)) {
              $path = 'uploads/contents/';
              unlink( $path . $row['img_path']);
          }
          $result->close();
          $res2 = $DBConnect->query($sqlJoin2);
          if (!$res2) {
             printf("<br>Errormessage: %s\n", $DBConnect->error);
          }

    }
    // echo $select."</br>";
    // echo $sqlJoin2.";</br>";
    // echo $sqlJoin;
    // unset($_SESSION["img_sql"]);
    echo "1";
}else {
  echo "ไม่สามารถลบได้";
}
?>
