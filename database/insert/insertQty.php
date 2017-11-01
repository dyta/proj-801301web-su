<?php
$valid = true;
if(!empty($_POST['id'])){
    $idprod = mysqli_escape_string($DBConnect, $_POST['id']);
}else{
    $valid = false;
}

if(!empty($_POST['array'])){
    $array = mysqli_escape_string($DBConnect, $_POST['array']);
}else{
    $valid = false;
}

if(!empty($_POST['func'])){
    $func = mysqli_escape_string($DBConnect, $_POST['func']);
}else{
    $valid = false;
}

if ($valid) {
  $search = 'h';
  $array = str_replace($search, '', $array);

  $sql = "SELECT * FROM `product_list`
          JOIN `product_image` ON `product_image`.`prod_id` = `product_list`.`prod_id`
          JOIN `images` ON `images`.`img_id` = `product_image`.`img_id`
          WHERE `product_list`.`prod_id` = '$idprod'";

  $result = mysqli_query($DBConnect, $sql);
  $row = mysqli_fetch_assoc($result);
  $price = $row['prod_price'];
  $discount = $row['prod_discount'];
  $total = $price-($price*$discount/100);

  //ถ้ามีสินค้าชนิดนี้แล้วในตะกร้า ก็ให้เพิ่มจำนวน
  if(!empty($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    if(sizeof($cart)>0){
      if ($func == "add") {
        foreach($cart as $array=>$item){
          if ($item['id'] == $idprod) {
            $_SESSION['cart'][$array]=array(
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
      }else {
        foreach($cart as $array=>$item){
          if ($item['id'] == $idprod && $item['amount'] >1) {
            $_SESSION['cart'][$array]=array(
              'id'=>$item['id'],
              'name'=>$item['name'],
              'image'=>$item['image'],
              'price_lod'=>$item['price_lod'],
              'price'=>$total,
              'discount'=>$item['discount'],
              'amount'=>$item['amount']-1
            );
            echo "เพิ่มจำนวนสินค้าแล้ว";
          }
        }
      }
    }
  }



}
