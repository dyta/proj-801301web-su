
    <div class="u-pull-right">
        <a class="text-red" style="float:right;" href="?action=admin&manage=product"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
    </div>
    <div class="u-full-width">
        <h5 class="text-blue text-18x"><i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i> เพิ่มรายการสินค้า</h5>
    </div>
    <div class="u-full-width">
      <div class="alert-error" id="error"></div>
        <form name="productfrm" action="#" method="post">
            <div class="u-full-width">
                <label class="account_info">ชื่อสินค้า</label>
                <input type="text" maxlength="140" name="prod_name"></input>
            </div>
            <div class="u-full-width">
                <label class="account_info">หมวดหมู่</label>
                <select name="prod_cate">
                  <?php
                  $sql = "SELECT * FROM `product_category` ORDER BY cate_name DESC";
                  $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
                  $num_row = mysqli_num_rows($query);
                  while($row = mysqli_fetch_assoc($query)){?>
                    <option value="<?php echo $row['cate_id']?>"><?php echo $row['cate_name']?></option>
                  <?php } if($num_row == 0) {?>
                    <option value="0">ไม่มีหมวดหมู่</option>
                  <?php } $query->close();?>
                </select>
            </div>
            <div class="u-full-width">
                <label class="account_info">ราคา</label>
                <input type="text" maxlength="140" name="prod_price"></input>
            </div>
            <div class="u-full-width">
                <label class="account_info">ส่วนลด</label>
                <input type="text" maxlength="140" name="prod_discount" value="0"></input>
            </div>
            <div class="u-full-width" id="">
                <label class="account_info">รูปภาพ</label>
                <div class="fileUpload">
                    <button><i class="fa fa-fw fa-cloud-upload" aria-hidden="true"></i> เลือกรูปภาพ</button>
                    <input type="file" class="upload" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <div class="u-full-width">
                <label class="account_info">คำอธิบายสินค้า</label>
                <input type="text" name="prod_description"></input>
            </div>
            <div class="form-group">
                <button type="submit" class="button-primary" onclick="return prodAdd()" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> สร้างสินค้า</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        document.title = "เพิ่มรายการสินค้า";
        function prodAdd() {
            var prod_name = document.forms['productfrm']['prod_name'].value;
            var prod_price = document.forms['productfrm']['prod_price'].value;
            var prod_discount = document.forms['productfrm']['prod_discount'].value;
            var prod_description = document.forms['productfrm']['prod_description'].value;
            var prod_cate = document.forms['productfrm']['prod_cate'].value;

            var data = document.forms['productfrm']['fileToUpload'].value;
            var file_data = $('#fileToUpload').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('prod_name', prod_name);
            form_data.append('prod_cate', prod_cate);
            form_data.append('prod_price', prod_price);
            form_data.append('prod_discount', prod_discount);
            form_data.append('prod_description', prod_description);

            var message = "กรุณากรอก ";
            var valid = true;

            if (data == null || data == '') {
                valid = false;
            }

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
                    url: 'controller.php?auth=createProduct',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(response) {
                        if (response == '1') {
                            $("#error").removeClass("alert-error");
                            $("#error").addClass("alert-success");
                            $("#error").html("<p>สร้างรายการสินค้าเรียบร้อยแล้ว</p>");
                            setTimeout(function() {
                                window.location.assign('?action=admin&manage=product');
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
