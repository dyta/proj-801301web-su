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
                        <p><small><a class="text-red" onclick="return deClick('<?php echo $id?>')" href="#">ลบ</a></small></p>
                    </td>
                    <td class="display-none text-center">
                        <?php echo $item['name'];?>
                    </td>
                    <td class="display-none text-center">
                        <?php echo number_format($item['price_lod'], 2, '.', ',');?><br>
                        <small><?php if($item['discount']>0) echo "(ลด ".$item['discount']." %)"?></small>
                    </td>
                    <td class="text-center">
                        <i onclick="return minusqty('<?php echo $id?>h', '<?php echo $item['id'];?>')" class="fa fa-minus-square-o" aria-hidden="true"></i><br>
                        <?php echo $item['amount'];?><br>
                        <i onclick="return addqty('<?php echo $id?>h', '<?php echo $item['id'];?>')" class="fa fa-plus-square-o" aria-hidden="true"></i>
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
          <div class="one-half column"><input type="button" onclick="window.location='?p=1';" value="เลือกสินค้าต่อ" /></div>
          <div class="one-half column"><input type="button" class="button-primary" onclick="window.location='?action=shipping';" value="ดำเนินการต่อ..." /></div>
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

    <script type="text/javascript">
    document.title = "ตะกร้าสินค้า";
    function deClick(id) {
        var verified = window.confirm("ยืนยันการลบสินค้า?");
        if (verified) {
          RemoveCArt(id+'h');
        }
        return false;
    }
    function plus(id, idpod) {

        addqty(id+'h', idpod);

        return false;
    }
    function RemoveCArt(id) {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=removecart',
            data: "index=" + id,
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>ลบสินค้าในตะกร้าออกแล้ว</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        })
        return false;
    }
    function addqty(id, idpod) {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=addqty',
            data: "array=" + id + "&id=" + idpod + "&func=add",
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>เพิ่มจำนวนแล้ว</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 100);
                }
            }
        })
        return false;
    }
    function minusqty(id, idpod) {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=addqty',
            data: "array=" + id + "&id=" + idpod + "&func=minus",
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>ลดจำนวนแล้ว</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 100);
                }
            }
        })
        return false;
    }
    </script>
