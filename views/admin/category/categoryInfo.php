<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
$key = mysqli_escape_string($DBConnect, base64_decode($_GET['key']));
if (empty($_GET['key'])) {
  echo "<script>window.location='/?access_denied';</script>";
}
$sql = "SELECT * FROM `product_category` WHERE cate_id = '$key'";
$result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
$row = mysqli_fetch_assoc($result);
$result->close();
if (!$row){
  echo "<script>window.location='/?action=admin&manage=category';</script>";
}
?>
    <div class="u-pull-right">
        <a class="text-red" onclick="history.back()" style="float:right;" href="javascript:void(0)"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-edit" aria-hidden="true"></i> แก้ไขหมวดหมู่ <small>Category ID: <?php echo $row['cate_id']; ?></small></h5>
    </div>
    <div class="row">
        <div class="col-m12">
          <div class="alert-error" id="error"></div>
            <form name="cateupdate" action="#" onsubmit="return cateUpdateInfor('<?php echo $key;?>')" method="post">
                <div class="form-group no-margin">
                    <label class="account_info">ชื่อหมวดหมู่</label>
                    <input type="text" maxlength="140" name="cate_name" class="btn border-transparent" value="<?php echo $row['cate_name']; ?>"></input>
                </div>
                <div class="form-group no-margin">
                    <label class="account_info">คำอธิบาย</label>
                    <textarea rows="3" maxlength="200" name="cate_description" class="btn border-transparent"><?php if (isset($row['cate_description'])){echo "ไม่ระบุ";} else {echo $row['cate_description'];}?></textarea>
                </div>
                <div class="form-group">
                    <label class="account_info">สร้างเมื่อวันที่</label>
                    <input type="text" readonly class="btn border-transparent" value="<?php echo DateFormate($row['cate_date']);?>"></input>
                </div>
                <div class="form-group">
                    <input type="submit" class="button-primary" name="submit" value="อัพเดทข้อมูล">
                </div>
            </form>
        </div>
        <div class="u-full-width">
            <h5 class="text-blue text-18x"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> ลบหมวดหมู่สินค้านี้</h5>
        </div>
        <div class="col-m12 text-left">
            <a class="text-red fg" href="" onclick="return deClick(<?php echo $row['cate_id']; ?>);">
              ลบหมวดหมู่
            </a>
        </div>
    </div>
    <script type="text/javascript">
    function deClick(cate_id) {
      var verified = window.confirm("คุณต้องการที่จะลบหมวดหมู่นี้หรือไม่?");
      if (verified) {
        deCate(cate_id);
      }
      return false;
    }
    </script>
