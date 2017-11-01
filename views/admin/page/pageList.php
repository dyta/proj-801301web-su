<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
$sql = "SELECT * FROM `page_content`";
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("<script>window.location='/?access_denied';</script>");
$num_row = mysqli_num_rows($query);
?>
<div class="u-full-width">
    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-file-text-o" aria-hidden="true"></i> หน้าเนื้อหา <small><a title="สร้างหน้าเนื้อหา" class="border-green font14x" href="?action=admin&amp;manage=pageAdd"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> เพิ่ม</a></small></h5>
</div>
<div class="row">
  <div class="col-m12">
    <table width="100%">
      <tr>
        <th>ชื่อ</th>
        <th>ลิงค์</th>
        <th>ตัวเลือก</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($query)){?>
        <tr>
          <td><?php echo $row['cont_title'];?></td>
          <td class="text-center">
            <small>
              <a title="เปิดดู" href="?page=<?php echo $row['cont_url']; ?>"><i class="fa fa-external-link" aria-hidden="true"></i> เปิดลิงค์</a>
            </small>
          </td>
          <td class="text-center" width="170px">
            <a title="แก้ไขหน้าเนื้อหา" class="border-black font12x" href="?action=admin&manage=pageEdit&key=<?php echo base64_encode($row['cont_id'])?>"><i class="fa fa-fw fa-cog" aria-hidden="true"></i>แก้ไข</a>
          </td>
        </tr>
      <?php } if($num_row == 0) {?>
      <tr>
        <td class="text-center" colspan="3">ไม่พบรายการ</td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>
<script type="text/javascript">
  document.title = "หน้าเนื้อหา";
</script>
