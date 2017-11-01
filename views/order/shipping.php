<?php
if (empty($_SESSION['user_id']) || empty($_SESSION['user_email'])) {
  echo"<script>window.location='?action=login&rdr=shipping';</script>";
  $_SESSION['rdr'] = "shipping";
  exit();
}
if(!isset($_SESSION['cart'])){
  echo"<script>window.location='?action=cart';</script>";
  exit();
}
if($_SESSION['user_group'] == 1){
  echo"<script>window.location='?action=cart';</script>";
  exit();
}
$free_shipping=1000;
?>
<div class="row">
  <div class="column">
    <?php
    if(!empty($_SESSION['cart'])){
      $cart=$_SESSION['cart'];
      if(sizeof($cart)>0){
    ?>
    <div class="alert-error" id="error"></div>
        <table class="u-full-width">
          <tbody>
            <tr>
                <th class="display-none">ภาพสินค้า</th>
                <th >รายการสินค้า</th>
                <th class="display-none">ราคา</th>
                <th >จำนวน</th>
                <th >รวม*</th>
            </tr>
    <?php
    $i=0;
    $sum=0;
    $old_price=0;
    $quantity=0;
    $sumold = 0;
    foreach($cart as $id=>$item){
      $sumold = $item['amount']*$item['price'];
      if ($sumold<0) {
        $sumold = 0;
      }
    ?>
                <tr>
                    <td class="text-center">
                        <img width="100" src="uploads/contents/<?php echo $item['image'];?>" alt="">
                    </td>
                    <td class="display-none text-center">
                        <?php echo $item['name'];?>
                    </td>
                    <td class="display-none text-center">
                        <?php echo number_format($item['price_lod'], 2, '.', ',');?><br>
                        <small><?php if($item['discount']>0) echo "(ลด ".$item['discount']." %)"?></small>
                    </td>
                    <td class="text-center">
                        <?php echo $item['amount'];?><br>
                    </td>
                    <td class="text-center">
                        <?php echo number_format($sumold, 2, '.', ',')?>
                    </td>
                </tr>
    <?php
    $sum += $sumold;
    $old_price +=$item['price_lod']*$item['amount'];

    $quantity +=$item['amount'];
    $i++;
    }?>
                </tbody>
        </table>
        <table class="u-full-width">
          <tbody>
            <tr>
                <td colspan="2" align="right"><small>*ราคารวมคือราคาที่ถูกคำนวณส่วนลดแล้ว ต่อชิ้น</small></td>
            </tr>
            <tr>
                <td align="right" width="70%"><b>ราคารวม</b></td>
                <td align="right"><?php echo number_format($old_price, 2, '.', ',');?></td>
            </tr>
            <tr>
                <td align="right" width="70%"><b>ส่วนลด</b></td>
                <td align="right">-<?php echo number_format($old_price-$sum, 2, '.', ',');?></td>
            </tr>
            <tr>
                <td align="right" width="70%"><b>ราคาสุทธิ</b></td>
                <td align="right"><?php echo number_format($sum, 2, '.', ',');?></td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="offset-by-three six columns">
            <form name="shipping_address" action="#" method="GET">
                <div class="u-full-width">
                    <label class="account_info">Fullname / ชื่อ-นามสกุล</label>
                    <input type="text" readonly="" style="background: transparent;" value="<?php echo $_SESSION['user_name'];?>"></input>
                </div>
                <div class="u-full-width">
                    <label class="account_info">Email / อีเมล์</label>
                    <input type="text" readonly="" style="background: transparent;" value="<?php echo $_SESSION['user_email']; ?>"></input>
                </div>
                <div class="six columns no-margin no-padding">
                    <label class="account_info">Gender / เพศ</label>
                    <input type="text" readonly="" style="background: transparent;" value="<?php echo $_SESSION['user_gender']; ?>"></input>
                </div>
                <div class="six columns no-padding">
                    <label class="account_info">Age / อายุ</label>
                    <input type="text" readonly="" style="background: transparent;" maxlength="2" value="<?php if ($_SESSION['user_age'] == null){echo " ไม่ระบุ ";} else {echo $_SESSION['user_age'];} ?>"></input>
                </div>
                <div class="u-full-width">
                    <label class="account_info">Tel / เบอร์โทรศัพท์</label>
                    <input type="text" readonly="" style="background: transparent;"  value="<?php if ($_SESSION['user_tel'] == null){echo " ไม่ระบุ ";} else {echo $_SESSION['user_tel'];} ?>"></input>
                </div>
                <div class="u-full-width">
                    <label class="account_info">Address / ที่อยู่</label>
                    <textarea rows="4" readonly="" style="background: transparent;" class="" cols="100"><?php if ($_SESSION['user_address'] == null){echo "ไม่ระบุ";} else {echo $_SESSION['user_address'];} ?></textarea>
                </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="four columns no-padding"><input type="button" onclick="window.location='?action=cart';" value="แก้ไขสินค้าในตะกร้า" /></div>
          <div class="four columns no-padding"><input type="button" onclick="window.location='?action=profile';" value="แก้ไขข้อมูลจัดส่ง" /></div>
          <div class="four columns no-padding"><input type="submit" onclick="window.location='?action=order';"class="button-primary" value="ยืนยันการสั่งซื้อ" /></div>
        </div>
        <?php }}else{?>
          <div class="row">
            <div class="offset-by-four four columns text-center">
              <p><i class="fa fa-4x fa-shopping-basket text-red" aria-hidden="true"></i></p>
              <p>ไม่มีสินค้าในตะกร้า</p>
              <input name="button" type="button" onclick="window.location='?p=1';" value="เลือกสินค้าต่อ" style="margin:10px 0 0 0;" />
            </div>
          </div>
        <?php }?>

  </div>
</div>
