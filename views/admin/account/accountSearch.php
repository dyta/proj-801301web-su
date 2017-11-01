<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
?>
<div class="alert-error" id="error"></div>
<form action="#" name="search" onsubmit="return validSearch()" method="POST">
    <div class="ten columns no-margin no-padding">
      <input type="search" name="search" pattern="[a-zA-Z0-9ก-๙]+" placeholder="ค้นหาชื่อจากคำใดคำหนึ่งที่มีอยู่ในชื่อ แล้วกดค้นหา" value="<?php if(!empty($_GET['search'])) echo $_GET['search'];?>" />
    </div>
    <div class="two columns no-padding">
      <button type="submit" class="button-primary" name="submit"><i class="fa fa-fw fa-search" aria-hidden="true"></i> ค้นหา</button>
    </div>
</form>
<div class="column no-margin no-padding">
  <p><i class="fa fa-fw fa-filter" aria-hidden="true"></i> ตัวกรอง:
      <a href="?action=admin&amp;manage=account&amp;search=<?php echo $search;?>&amp;page=<?php echo $page; ?>&amp;sort=desc" />ใหม่ล่าสุด</a> -
      <a href="?action=admin&amp;manage=account&amp;search=<?php echo $search;?>&amp;page=<?php echo $page; ?>&amp;sort=asc" />เก่าที่สุด</a> -
      <a href="?action=admin&amp;manage=account&amp;search=&amp;sort=&amp;clear=true" />ล้างรายการค้นหา</a>
  </p>
</div>

<?php
    $valid = true;
    if(!empty($_POST['search'])){
        $search = mysqli_escape_string($DBConnect, $_POST['search']);
    }else{
        $valid = false;
    }
    if($valid){
      echo "<script>window.location='?action=admin&manage=account&search=$search'</script>";
    }
?>
