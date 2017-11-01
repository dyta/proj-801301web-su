<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
if (empty($_GET['key'])) {
  echo "<script>window.location='/?';</script>";
}
$key = mysqli_escape_string($DBConnect, base64_decode($_GET['key']));

$sql = "SELECT * FROM `page_content`WHERE `page_content`.`cont_id` = '$key'";

$sqlJoin = "SELECT * FROM `page_content`
        JOIN `page_image` ON `page_image`.`cont_id` = `page_content`.`cont_id`
        JOIN `images` ON `images`.`img_id` = `page_image`.`img_id`
        WHERE `page_content`.`cont_id` = '$key' ORDER BY `page_image`.`img_id` DESC";
$result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
$row = mysqli_fetch_assoc($result);
$result->close();
$result = mysqli_query($DBConnect, $sqlJoin, MYSQLI_USE_RESULT) or die('die');

if (!$row){
  echo "<script>window.location='/?action=admin&manage=pageList';</script>";
}

if (empty($_SESSION["img_sql"])) {
  # code...
}else {
  $count = count($_SESSION["img_sql"]);
  if ((count($_SESSION["img_sql"]) > 0)) {
    for ($i=0; $i < $count; $i++) {
      unset($_SESSION['img_sql'][$i]);
    }
  }
}
?>
    <div class="u-pull-right">
        <a class="text-red" style="float:right;" href="?action=admin&manage=pageList"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-money" aria-hidden="true"></i> แก้ไขหน้าเนื้อหา</h5>
    </div>
    <div class="u-full-width">
      <div class="alert-error" id="error"></div>
        <form name="textarea_oi" action="#" method="post">
            <div class="u-full-width">
                <label class="account_info">ชื่อหน้า</label>
                <input type="text" maxlength="140" name="cont_title" class="btn border-default" value="<?php echo $row['cont_title']; ?>"></input>
            </div>
            <div class="u-full-width">
                <label class="account_info">URL http://<?php echo $_SERVER['HTTP_HOST'];?>/?page=<?php echo $row['cont_url']; ?></label>
                <input type="text" maxlength="140" name="cont_url" class="btn border-default" value="<?php echo $row['cont_url']; ?>"></input>
            </div>
            <div class="">
              ตั้งเนื้อนี้เป็นสาธารณะ
              <select name="cont_published">
                <option <?php if($row['cont_published']=='on'){echo "selected";}?> value="on">On</option>
                <option <?php if($row['cont_published']=='off'){echo "selected";}?> value="off">Off</option>
              </select>
            </div>
            <div class="">
              แสดงหน้าเนื้อหานี้ในแถบเมนูด้านบน
              <select name="cont_showontop">
                <option <?php if($row['cont_showontop']=='on'){echo "selected";}?> value="on">On</option>
                <option <?php if($row['cont_showontop']=='off'){echo "selected";}?> value="off">Off</option>
              </select>
            </div>
            <div class="u-full-width">
                <label class="account_info">เครื่องมือ</label>
                <a target="_blank" href="?action=preview&key=<?php echo $_GET['key'];?>"><i class="fa fa-fw fa-eye" aria-hidden="true"></i> ตัวอย่าง</a>
                <a href="javascript:openPopup(<?php echo $key;?>, 'content');"><i class="fa fa-fw fa-picture-o" aria-hidden="true"></i> อัพโหลดรูปภาพ</a>
                <a href="javascript:toolsEtc();"><i class="fa fa-fw fa-code" aria-hidden="true"></i> คำสั่งการใช้งานอื่นๆ</a>
                <a title="ลบหน้าเนื้อหา" class=" text-red font12x fg" onclick="javascript:return deClick(<?php echo ($row['cont_id']); ?>);">
                    <i class="fa fa-fw fa-trash" aria-hidden="true"></i> ลบหน้า
                </a>
            </div>
            <div class="u-full-width">
                <label class="account_info">รูปภาพที่ถูกอัพโหลดลงในเนื้อหานี้ (แสดงรายการอัพโหลดล่าสุด)</label>
                <small>**ลากรูปลงในกล่องเนื้อหา</small>
                    <div class="imageCenterer">
                        <?php
                        for ($i=0; $i < $rowImage = mysqli_fetch_assoc($result); $i++) {
                          $_SESSION["img_sql"][$i] = $rowImage['img_id'];
                        ?>
                            <img width="100px" id="<?php echo $rowImage['img_path'];?>" draggable="true" ondragstart="drag(event)" src="uploads/contents/<?php echo $rowImage['img_path'];?>" alt="">

                            <?php } $result->close();?>
                    </div>
            </div>
            <div class="u-full-width">
                <label class="account_info">เนื้อหา</label>
                <textarea id="content_page" ondrop="drop(event)" ondragover="allowDrop(event)" name="content_page" style="height: 600px;"><?php echo $row['cont_details']; ?></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="button-primary" onclick="return updateData(<?php echo $key;?>)" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> อัพเดท</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        document.title = "แก้ไขหน้าเนื้อหา";

        function popupCallback(str) {
            if (str) {
                var post = document.getElementById("content_page").value;
                document.getElementById('content_page').value = post + '\n<img width="100%" src="uploads/contents/' + str + '"/>';
                updateData(<?php echo $key;?>);
            }
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            // ev.target.appendChild(document.getElementById(data));
            document.getElementById('content_page').value += '\n<img width="100%" src="uploads/contents/' + data + '"/>';
            // updateData();
        }

        function deClick(id) {
          var verified = window.confirm("คุณต้องการที่จะลบหน้านี้หรือไม่?");
          if (verified) {
            dePage(id);
          }
          return false;
        }
    </script>
