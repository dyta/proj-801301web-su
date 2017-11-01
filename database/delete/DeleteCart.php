<?php
$valid = true;

//?index=1h
//ส่งค่า Array Index ที่จะลบมา แต่มีจะมีตัวอักษร h มาด้วย เพราะว่ามันหา index 0 ไม่เจอ
if(!empty($_POST['index'])){
  $key=isset($_POST['index'])?$_POST['index']:array();
}else {
  $valid = false;
}

if ($valid) {
  // ตัด h ออก
  $search = 'h';
  $trimmed = str_replace($search, '', $key);
  //ลบสินค้าในตะกร้า
  unset($_SESSION['cart'][$trimmed]);

  echo "ลบแล้ว";
}
