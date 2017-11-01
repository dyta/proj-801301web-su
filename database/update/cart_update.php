<?php
if (!empty($_POST['remove'])) {
  $removes = isset($_POST['remove'])?$_POST['remove']:array();
  
  foreach($removes as $id){
    unset($cart[$id]);
  }
}else {
  echo "ไม่พบรายการ";
}
