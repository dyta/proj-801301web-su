<?php
if ($_SESSION['user_group'] !=1) {
  echo "access denied";
}else {?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name=”viewport” content=”width=device-width, maximum-scale=3, minimum-scale=1″ />
    <title>อัพโหลดรูปภาพ</title>
    <link rel="stylesheet" type="text/css" href="lib/css/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="lib/css/thirty-style.min.css">

    <link rel="icon" href="lib/images/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="lib/images/favicon.png" type="image/x-icon" />

</head>

  <body>
    <form action="#" method="post" onsubmit="return imagesCHK()" name="uploadAvatar" enctype="multipart/form-data" style="text-align:center;">
      <table border="1" class="text-center">
        <tbody>
            <tr>
              <td style="vertical-align: middle;" width="300px">
                <div class="form-group no-margin">
                  <input type="file" class="btn btn-default border-transparent" name="fileToUpload" id="fileToUpload">
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="form-group no-margin">
                  <input type="submit" class="btn btn-green" style="margin-top: 10px;" value="อัพโหลดรูปภาพ" name="submit">
                </div>
              </td>
            </tr>
        </tbody>
      </table>
    </form>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="assets/js/validation.js"></script>
  </body>
</html>
<?php
if(isset($_POST["submit"]) && $_POST["submit"] == 'อัพโหลดรูปภาพ') {
    $fileData = pathinfo(basename($_FILES["fileToUpload"]["name"]));
    $filename_old = basename($_FILES["fileToUpload"]["name"]);
    $fileName = RandomString(12).'_'.RandomString(8).'.'.$fileData['extension'];
    $target_path = ($_SERVER['DOCUMENT_ROOT'] . "/uploads/contents/" . $fileName);
    $imageFileType = pathinfo($target_path, PATHINFO_EXTENSION);

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        echo"<script>alert('ขนาดไฟล์ต้องไม่เกิน 2MB');window.close();</script>";
        $uploadOk = 0;
    }elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo"<script>alert('เฉพาะไฟล์นามสกุล jpg, jpeg, png, gifเท่านั้น');window.close();</script>";
        $uploadOk = 0;
    }

    if(!empty($_GET['key'])){
        $key = mysqli_escape_string($DBConnect, $_GET['key']);
    }else{
        $uploadOk = 0;
    }

    if(!empty($_GET['_wh'])){
        $_wh = mysqli_escape_string($DBConnect, $_GET['_wh']);
    }else{
        $uploadOk = 0;
    }

    if ($uploadOk != 0) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_path)){
          mysqli_query($DBConnect, "INSERT INTO `images` (img_path, img_type, img_date) VALUES ('$fileName', '$_wh', now())");
          $return_lastid_img = mysqli_insert_id($DBConnect);
          mysqli_query($DBConnect,"INSERT INTO `page_image` (cont_id, img_id) VALUES ('$key', '$return_lastid_img');");
          echo"<script>window.opener.popupCallback('$fileName');window.close();</script>";

      } else{
          echo"<script>alert('เกิดข้อผิดพลาดในการอัพโหลด');window.close();</script>";
      }
    }
  }
?>
<?php } ?>
