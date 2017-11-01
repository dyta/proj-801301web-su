<?php
if ($_SESSION['user_group'] !=1) {
  echo "<script>window.location='/?access_denied';</script>";
}
/* เช็คค่าการเรียงลำดับข้อมูล*/
if(!empty($_GET['sort'])){
    $sort = mysqli_escape_string($DBConnect, $_GET['sort']);
}else {
    $sort = mysqli_escape_string($DBConnect, '');
}

/* แสดง 15 รายการต่อหน้า*/
$perpage = 15;
if(!empty($_GET['page'])){
  $page = mysqli_escape_string($DBConnect, $_GET['page']);
} else {
  $page = 1;
}
$start = ($page - 1) * $perpage;

/* เช็คค่าคำค้นหา*/
if (empty($_GET['search'])) {
  $search = "";
  $sql = "SELECT * FROM `accounts` ORDER BY user_id ".$sort." LIMIT $start , $perpage";
  $sqlPagination = "SELECT * FROM `accounts`";
}else {
  $search = mysqli_escape_string($DBConnect, $_GET['search']);
  $sql = "SELECT * FROM `accounts` WHERE user_name LIKE '%$search%' ORDER BY user_id ".$sort." LIMIT $start , $perpage";
  $sqlPagination = "SELECT * FROM `accounts` WHERE user_name LIKE '%$search%'";
}

/* แบ่งหน้า*/
$query2 = mysqli_query($DBConnect, $sqlPagination);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);

/* คิวรีข้อมูล*/
$query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("<script>window.location='/?action=login';</script>");
$num_row = mysqli_num_rows($query);

/*ล้างคำค้นหา*/
if (!empty($_GET['search']) && !empty($_GET['clear']) && $_GET['search'] == 'true') {

  header("location: ?action=admin&manage=account&search=&sort=$sort");
}
?>
    <div class="row">
        <div class="column no-padding">
            <h5 class="text-blue text-18x"><i class="fa fa-fw fa-user-circle-o" aria-hidden="true"></i> จัดการสมาชิก <small>ทั้งหมด <?php echo $total_record; ?> รายการ</small></h5>
        </div>
    </div>
    <div class="row">
        <div class="u-full-width">
            <?php include 'accountSearch.php'; ?>
        </div>
    </div>
    <div class="row">
        <?php if(!empty($_GET['search'])){?>
        <h6>ผลการค้นหาพบ <?php echo $total_record;?> รายการ</h6>
        <?php } ?>
        <div class="col-m12">
            <table width="100%">
                <tr>
                    <th class="text-center">โปรไฟล์</th>
                    <th class="display-none">ชื่อ-นามสกุล</th>
                    <th>อีเมล์</th>
                    <th class="display-none">ระดับสมาชิก</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($query)){?>
                <tr>
                    <td class="text-center">
                        <a class="border-black font12x" href="?action=admin&amp;manage=accountDetails&amp;user=<?php echo base64_encode($row['user_id'])?>"><img class="profiles_img-list" src="uploads/avatar/<?php echo $row['user_avatar'];?>"></a>
                    </td>
                    <td class="display-none">
                        <?php echo $row['user_name'];?>
                    </td>
                    <td>
                        <a class="border-black font12x" href="?action=admin&amp;manage=accountDetails&amp;user=<?php echo base64_encode($row['user_id'])?>">
                            <?php echo $row['user_email'];?>
                        </a>
                    </td>
                    <td class="display-none">
                        <?php if ($row['user_group'] == 0){echo "สมาชิกทั่วไป";} else {echo 'ผู้ดูแลระบบ';} ?>
                    </td>
                </tr>
                <?php } if($num_row == 0) {?>
                <tr>
                    <td class="text-center" colspan="4">ไม่พบรายการ</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="row text-center">
        <ul class="pagination text-12x">
            <?php for($i=1 ; $i<=$total_page ; $i++){ ?>
            <li><a <?php if ($page==$i) { echo 'class="active"'; };?> href="?action=admin&amp;manage=account&amp;search=<?php echo $search;?>&amp;page=<?php echo $i; ?>&amp;sort=<?php echo $sort;?>"><?php echo $i; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <script type="text/javascript">
        document.title = "จัดการสมาชิก";
    </script>
