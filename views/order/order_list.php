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
?>
<div class="row">
  <div class="column">
    <div class="alert-error" id="error"></div>
  </div>
  <div class="column no-margin text-center">
    <p><i class="fa fa-spinner fa-spin fa-4x fa-fw"></i></p>
    <p>กรุณารอสักครู่...</p>
    <small class="text-red">ห้ามปิดหน้านี้ หรือรีเฟรชเนื่องจากระบบกำลังทำงานอยู่</small>
  </div>
</div>
<?php
if(!empty($_SESSION['cart'])){
$order = "INSERT INTO `order_details` (order_id, user_id, ordstatus_id, order_description, order_date) VALUES (0, '".$_SESSION['user_id']."', '2', '', now());";
$DBConnect->multi_query($order);
$orderid = $DBConnect->insert_id;

$order ="INSERT INTO `invoices` (order_id, invoice_date) VALUES ('$orderid', now());";
$DBConnect->multi_query($order);
$cart = $_SESSION['cart'];
  if(sizeof($cart)>0){
    $i=0;
    $sum=0;
    $old_price=0;
    $sumold = 0;
    foreach($cart as $id=>$item){
    $sumold = $item['amount']*$item['price'];
    if ($sumold<0) {
      $sumold = 0;
    }
      $prod_id = $item['id'];
      $ordit_qty = $item['amount'];
      $sum += $sumold;
      $old_price +=$item['price_lod']*$item['amount'];
      $i++;


      $query = "INSERT INTO `order_items` (order_id, ordit_id, prod_id, ordit_qty, ordit_price) VALUES ('$orderid', 0, '$prod_id', '$ordit_qty', '$sumold');";

      $DBConnect->multi_query($query);

      $ids = array();
      do{
          $ids[] = $DBConnect->insert_id;
          $DBConnect->next_result();
      } while($DBConnect->more_results());
      unset($_SESSION['cart']);
      echo "<script>setTimeout(function() {window.location='/?action=histories';}, 5000);</script>";
    }
  }
}
?>
  <script type="text/javascript">
      document.title = "กรุณารอสักครู่...";
  </script>
