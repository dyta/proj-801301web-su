<?php
if (empty($_GET['pid'])) {
  echo "<script>window.location='/?';</script>";
}
$key = mysqli_escape_string($DBConnect, $_GET['pid']);

$sql = "SELECT * FROM `product_list`WHERE `product_list`.`prod_id` = '$key'";

$sqlJoin = "SELECT * FROM `product_list`
        JOIN `product_image` ON `product_image`.`prod_id` = `product_list`.`prod_id`
        JOIN `images` ON `images`.`img_id` = `product_image`.`img_id`
        WHERE `product_list`.`prod_id` = '$key' ORDER BY `product_image`.`img_id` DESC";
$result = mysqli_query($DBConnect, $sql, MYSQLI_USE_RESULT) or die('die');
$row = mysqli_fetch_assoc($result);
$result->close();
$result = mysqli_query($DBConnect, $sqlJoin, MYSQLI_USE_RESULT) or die('die');
$pic = mysqli_fetch_assoc($result);
$result->close();
if (!$row){
  echo "<script>window.location='/?action=admin&manage=product';</script>";
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
    <div class="row">
        <div class="column">
            <h5 class="text-blue text-18x"><i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i> แก้ไขรายการสินค้า
              <small><a class="text-red font14x" onclick="return deClick(<?php echo $row['prod_id'];?>,<?php echo $pic['img_id'];?>)" href="#"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> ลบสินค้า</a></small></h5>
        </div>
        <div class="u-full-width">
          <div class="alert-error" id="error"></div>
            <form name="productfrm" action="#" method="post" onsubmit="return prodUpdatePRO();">
                <div class="u-full-width">
                    <label class="account_info">ชื่อสินค้า</label>
                    <input type="text" maxlength="140" name="prod_name" value="<?php echo $row['prod_name']?>"></input>
                </div>
                <div class="u-full-width">
                    <label class="account_info">หมวดหมู่</label>
                    <select name="prod_cate">
                      <?php
                      $sql = "SELECT * FROM `product_category` ORDER BY cate_name DESC";
                      $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
                      $num_row = mysqli_num_rows($query);
                      while($row2 = mysqli_fetch_assoc($query)){?>
                        <option value="<?php echo $row2['cate_id']?>" <?php if ($row['cate_id'] == $row2['cate_id']) {echo 'selected';}?>><?php echo $row2['cate_name']?></option>
                      <?php } if($num_row == 0) {?>
                        <option value="0">ไม่มีหมวดหมู่</option>
                      <?php } $query->close();?>
                    </select>
                </div>
                <div class="u-full-width">
                    <label class="account_info">ราคา</label>
                    <input type="text" maxlength="140" name="prod_price" value="<?php echo $row['prod_price']?>"></input>
                </div>
                <div class="u-full-width">
                    <label class="account_info">ส่วนลด</label>
                    <input type="text" maxlength="140" name="prod_discount" value="<?php echo $row['prod_discount']?>"></input>
                </div>
                <div class="u-full-width" id="">
                    <label class="account_info">รูปภาพ</label>
                    <img width="100%" src="uploads/contents/<?php echo $pic['img_path']?>" alt="">
                    <div class="fileUpload">
                        <button><i class="fa fa-fw fa-cloud-upload" aria-hidden="true"></i> เลือกรูปภาพ</button>
                        <input type="file" class="upload" name="fileToUpload" id="fileToUpload">
                    </div>
                </div>
                <div class="u-full-width">
                    <label class="account_info">คำอธิบายสินค้า</label>
                    <textarea name="prod_description" rows="8" cols="80"><?php echo $row['prod_description']?></textarea>
                </div>
                <div class="form-group">
                  <input type="hidden" name="img" value="<?php echo $pic['img_id']?>">
                    <input type="hidden" name="key" value="<?php echo $row['prod_id']?>">
                    <button type="submit" class="button-primary" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> อัพเดท</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        document.title = "แก้ไขรายการสินค้า";
        function deClick(id, img) {
            var verified = window.confirm("คุณต้องการที่จะลบรายการสินค้านี้หรือไม่?");
            if (verified) {
              deProd(id,img);
            }
            return false;
        }
        /**
         * ลบสินค้า
         */
        function deProd(id, img) {
            $.ajax({
                type: 'POST',
                url: 'controller.php?auth=deleteProduct',
                data: "key=" + id + "&img=" + img,
                success: function(response) {
                    if (response == '1') {
                        $("#error").removeClass("alert-error");
                        $("#error").addClass("alert-success");
                        $("#error").html("<p>ลบรายการสินค้าเรียบร้อยแล้ว</p>");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        $("#error").html("<p>" + response + "</p>");
                    }
                }
            })
            return false;
        }

        function prodUpdatePRO() {
            var prod_name = document.forms['productfrm']['prod_name'].value;
            var prod_price = document.forms['productfrm']['prod_price'].value;
            var prod_discount = document.forms['productfrm']['prod_discount'].value;
            var prod_description = document.forms['productfrm']['prod_description'].value;
            var prod_cate = document.forms['productfrm']['prod_cate'].value;
            var key = document.forms['productfrm']['key'].value;
            var img = document.forms['productfrm']['img'].value;
            var message = "กรุณากรอก ";
            var valid = true;
            var data = document.forms['productfrm']['fileToUpload'].value;
            var file_data = $('#fileToUpload').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('key', key);
            form_data.append('img', img);
            form_data.append('prod_name', prod_name);
            form_data.append('prod_cate', prod_cate);
            form_data.append('prod_price', prod_price);
            form_data.append('prod_discount', prod_discount);
            form_data.append('prod_description', prod_description);


            if (prod_name == null || prod_name == '') {
                message += "ชื่อสินค้า";
                valid = false;
            }
            if (prod_price == null || prod_price == '') {
                message += " ราคา";
                valid = false;
            }
            if (prod_discount == null || prod_discount == '') {
                message += " ส่วนลด";
                valid = false;
            }
            if (prod_description == null || prod_description == '') {
                message += " คำอธิบายสินค้า";
                valid = false;
            }

            if (valid == false) {
                $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'controller.php?auth=updateProduct',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(response) {
                        if (response == '1') {
                            $("#error").removeClass("alert-error");
                            $("#error").addClass("alert-success");
                            $("#error").html("<p>อัพเดทรายการสินค้าเรียบร้อยแล้ว</p>");
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $("#error").html("<p>" + response + "</p>");
                        }
                    }
                })
            }
            return false;
        }
    </script>
