<?php
$sql = "SELECT * , SUM(`order_items`.`ordit_price`) AS totalprice FROM `invoices`
    JOIN `order_details` ON `order_details`.`order_id` = `invoices`.`order_id`
    JOIN `order_items` ON `order_details`.`order_id` = `order_items`.`order_id`
    JOIN `order_status` ON `order_status`.`ordstatus_id` = `order_details`.`ordstatus_id`
    JOIN `payments` ON `payments`.`invoice_id` = `invoices`.`invoice_id`
    JOIN `payment_method` ON `payment_method`.`paymethod_id` = `payments`.`paymethod_id`
    JOIN `product_list` ON `product_list`.`prod_id` = `order_items`.`prod_id`
    JOIN `accounts` ON `accounts`.`user_id` = `order_details`.`user_id`
    WHERE `invoices`.`invoice_id` = '".$_GET['receipt']."'AND `order_details`.`user_id` = '".$_GET['user']."'";
$query = mysqli_query($DBConnect, $sql) or die ($sql);
$num_row = mysqli_num_rows($query);
if ($num_row < 1) {
  echo "<script>window.location='?action=admin&manage=order'</script>";
}
$row= mysqli_fetch_assoc($query);

if (empty($row['user_name'])) {
  echo "<script>window.location='?action=admin&manage=order'</script>";
}
if (empty($row['invoice_id'])) {
  echo "<script>window.location='?action=admin&manage=order'</script>";
}
 ?>
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        font-size:16px;
        line-height:24px;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }

    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }

    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="../lib/images/invoice.png" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                Invoice #: <?php echo $row['invoice_id']; ?><br>
                                <small>วันที่สร้าง: <?php echo DateFormateFull($row['invoice_date']); ?>5<br>
                                วันที่ชำระ : <?php echo DateFormateFull($row['pay_date']); ?><br>
                                สถานะ: <?php echo ($row['ordstatus_title']); ?><br></small>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                1 หมู่ที่3 ถนนชะอำ-ปราณบุรี <br>
                                ตำบลสามพระยา อำเภอชะอำ <br>
                                จังหวัดเพชรบุรี 76120
                            </td>

                            <td>
                                <?php echo $row['user_name']; ?><br>
                                <?php echo $row['user_email']; ?><br>
                                <?php echo $row['user_tel']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                  ช่องทางการชำระ
                </td>

                <td>
                    ค่าธรรมเนียม
                </td>
            </tr>

            <tr class="details">
                <td>
                    <?php echo $row['paymethod_bank']; ?>
                </td>

                <td>
                    0.00
                </td>
            </tr>

            <tr class="heading">
                <td>
                    สินค้า
                </td>

                <td>
                    ราคา
                </td>
            </tr>
            <?php
            $sql2 = "SELECT * FROM `order_items`
              JOIN `product_list` ON `product_list`.`prod_id` = `order_items`.`prod_id`
              WHERE `order_items`.`order_id` = '".$row['order_id']."'";
              $query2 = mysqli_query($DBConnect, $sql2) or die ($sql2);
            while ($row2= mysqli_fetch_assoc($query2)) {?>
            <tr class="item">
                <td>
                  <?php echo $row2['prod_name']; ?>
                  Qty: <?php echo $row2['ordit_qty']; ?>
                </td>

                <td>
                    <?php echo number_format($row2['ordit_qty']*$row2['prod_price']-($row2['prod_price']*$row2['prod_discount']/100), 2, '.', ',');?>
                </td>
            </tr>
          <?php } ?>

            <tr class="total">
                <td></td>

                <td>
                   Total: <?php echo number_format($row['totalprice'], 2, '.', ',');?>
                </td>
            </tr>
        </table>
    </div>
