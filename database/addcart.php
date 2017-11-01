<?php
$valid = true;
// Product Id
if(!empty($_POST['id'])){
    $idprod = mysqli_escape_string($DBConnect, $_POST['id']);
}else{
    $valid = false;
}

//จำนวนสินค้า
if(!empty($_POST['qty'])){
    $qty = mysqli_escape_string($DBConnect, $_POST['qty']);
}else{
    $valid = false;
}

if ($valid) {
  //ถ้าในตระกร้าไม่มีสินค้าอยู่ให้สร้าง Session array
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();
  }

  //Query สินค้า *อันนี้แก้คำสั่งเอง
  $sql = "SELECT * FROM `product_list`
          JOIN `product_image` ON `product_image`.`prod_id` = `product_list`.`prod_id`
          JOIN `images` ON `images`.`img_id` = `product_image`.`img_id`
          WHERE `product_list`.`prod_id` = '$idprod'";

  $result = mysqli_query($DBConnect, $sql);
  $row = mysqli_fetch_assoc($result);
  $price = $row['prod_price'];
  $discount = $row['prod_discount'];
  $total = $price-($price*$discount/100);
  $valid2 = true;

  //ถ้ามีสินค้าชนิดนี้แล้วในตะกร้า ก็ให้เพิ่มจำนวน
  if(!empty($_SESSION['cart'])){
    $cart=$_SESSION['cart'];
    if(sizeof($cart)>0){
      foreach($cart as $id=>$item){
        if ($item['id'] == $idprod) {
          $valid2=false;
          $_SESSION['cart'][$id]=array(
            'id'=>$item['id'],
            'name'=>$item['name'],
            'image'=>$item['image'],
            'price_lod'=>$item['price_lod'],
            'price'=>$total,
            'discount'=>$item['discount'],
            'amount'=>$item['amount']+1
          );
          echo "เพิ่มจำนวนสินค้าแล้ว";
        }
      }
    }
  }

  //เพิ่มสินค้าลงตะกร้า
  if ($valid2) {
    $_SESSION['cart'][]=array(
      'id'=>$row['prod_id'],
      'name'=>$row['prod_name'],
      'image'=>$row['img_path'],
      'price_lod'=>$row['prod_price'],
      'price'=>$total,
      'discount'=>$row['prod_discount'],
      'amount'=>$qty
    );
    echo "1";
  }




}
