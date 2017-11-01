<div class="u-pull-right">
    <a class="text-red" style="float:right;" href="?action=admin&manage=pageList"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
</div>
<div class="u-full-width">
    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-money" aria-hidden="true"></i> เพิ่มหน้าเนื้อหา</h5>
</div>
<div class="alert-error" id="error"></div>
<form action="#" name="page" onsubmit="return createPage()" method="POST">
    <div class="">
        <label class="account_info">ระบุชื่อหน้า</label>
        <input type="text" autofocus="" autocomplete="off" name="page_name" pattern="[a-zA-Z0-9ก-๙]+" placeholder="Ex. วิธีการชำระเงิน">
    </div>
    <div class="">
        <label class="account_info">SHORTCUT URL * เฉพาะภาษาอังกฤษ</label>
        <input type="text" autofocus="" autocomplete="off" name="page_url" pattern="[a-zA-Z0-9]+" placeholder="Ex. howtopayment">
    </div>
    <p>* หน้าที่ถูกสร้างขึ้นจะยังไม่ถูกเผยแพร่ คุณสามารถตั้งค่าได้หลังจากที่สร้างไปแล้ว</p>
    <div class="">
        <button type="submit" class="button-primary" name="submit"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> เพิ่ม</button>
    </div>
</form>
<script type="text/javascript">
    document.title = "เพิ่มหน้า";
</script>
