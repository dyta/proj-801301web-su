<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
$perpage = 12;
if(!empty($_GET['page'])){
  $page = mysqli_escape_string($DBConnect, $_GET['page']);
} else {
  $page = 1;
}
$start = ($page - 1) * $perpage;

$sqlPagination = "SELECT * FROM `images`";
$query2 = mysqli_query($DBConnect, $sqlPagination);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);

$sql = "SELECT * FROM `images` ORDER BY img_id DESC LIMIT $start , $perpage";
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT);
$num_row = mysqli_num_rows($query);

?>
<div class="u-full-width">
    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-database" aria-hidden="true"></i> จัดการรูปภาพ</h5>
    <div class="alert-error" id="error"></div>
</div>
<div class="row">
  <?php while($row = mysqli_fetch_assoc($query)){?>
    <div class="three columns no-margin">
      <div class="img-grid text-center">
        <img src="uploads/contents/<?php echo $row['img_path'];?>" alt="">
        <p class="text-12x no-margin"><?php echo DateFormateFull($row['img_date']);?></p>
        <p class="text-12x no-margin">รูป: <?php echo $row['img_type'];?></p>
        <a class="text-red text-12x" onclick="return deClick(<?php echo $row['img_id'];?>, '<?php echo $row['img_type'];?>')"href="#">ลบ</a>
      </div>
    </div>
  <?php } if($num_row == 0) {?>
    <p>ไม่พบรูปภาพ</p>
  <?php } ?>
</div>
<div class="u-full-width">
  <ul class="pagination text-12x">
  <?php for($i=1 ; $i<=$total_page ; $i++){ ?>
  <li><a <?php if ($page==$i) { echo 'class="active"'; };?> href="?action=admin&amp;manage=imagesList&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php } ?>
  </ul>
</div>
<script type="text/javascript">
    function deClick(id, type) {
        var verified = window.confirm("คุณต้องการที่จะลบรูปนี้หรือไม่?");
        if (verified) {
          deImage(id, type);
        }
        return false;
    }
    /**
     * ลบรูป
     */
    function deImage(key, type) {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=deleteImage',
            data: "key=" + key + "&type=" + type,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>ลบรูปเรียบร้อยแล้ว</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 200);
                } else {
                    $("#error").html("<p>" + response + "</p>");
                }
            }
        })
        return false;
    }
</script>
