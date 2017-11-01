<?php
if(empty($_SESSION['user_id'])) {
  header("Location: /?action=login");
}
?>
    <div class="row">
        <section id="page">
            <div class="three columns sidebar display-none">
                <?php include 'views/navigator/menu_sidebar.php';?>
            </div>
            <div class="nine columns main">
                <div class="row">
                    <a class="border-black text-red" onclick="history.back()" style="float:right;" href="javascript:void(0)"><i class="fa fa-fw fa-angle-left" aria-hidden="true"></i> ย้อนกลับ</a>
                    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-edit" aria-hidden="true"></i> แก้ไขโปรไฟล์</h5>
                    <div class="alert-error" id="error"></div>

                    <div class="four columns text-center no-margin">
                        <img class="profiles_img" src="uploads/avatar/<?php echo $_SESSION['user_avatar'];?>">
                        <form method="post" onsubmit="return avatarImg()" name="uploadAvatar" id="uploadAvatar" enctype="multipart/form-data">
                            <div class="fileUpload">
                                <button><i class="fa fa-fw fa-cloud-upload" aria-hidden="true"></i> เลือกรูปภาพ</button>
                                <input type="file" class="upload" name="fileToUpload" id="fileToUpload">
                                <button type="submit" class="button-primary" name="img-profile" id="img-profile">เปลี่ยนรูปโปรไฟล์</button>
                            </div>
                        </form>
                    </div>
                    <div class="eight columns">
                        <form name="frmupdate" action="#" onsubmit="return updateInfor('<?php echo $_SESSION['user_name'].$_SESSION['user_gender'].$_SESSION['user_age'].$_SESSION['user_tel'].$_SESSION['user_address'];?>')" method="post">
                            <div class="u-full-width">
                                <label class="account_info">ระดับสมาชิก</label>
                                <input type="text" readonly="" style="background: transparent;" value="<?php if ($_SESSION['user_group'] == 0){echo " สมาชิกทั่วไป ";} else {echo 'ผู้ดูแลระบบ';} ?>"></input>
                            </div>
                            <div class="u-full-width">
                                <label class="account_info">Fullname / ชื่อ-นามสกุล</label>
                                <input type="text" name="user_name" pattern="[a-zA-Z0-9ก-๙]+" value="<?php echo $_SESSION['user_name'];?>"></input>
                            </div>
                            <div class="u-full-width">
                                <label class="account_info">Email / อีเมล์</label>
                                <input type="text" readonly="" style="background: transparent;" value="<?php echo $_SESSION['user_email']; ?>"></input>
                            </div>
                            <div class="six columns no-margin no-padding">
                                <label class="account_info">Gender / เพศ</label>
                                <select name="gender">
                              <option value="null"<?php if ($_SESSION['user_gender'] == ''){echo "selected";}?>>ไม่ระบุ</option>
                              <option value="ชาย"<?php if ($_SESSION['user_gender'] == 'ชาย'){echo "selected";}?>>ชาย</option>
                              <option value="หญิง"<?php if ($_SESSION['user_gender'] == 'หญิง'){echo "selected";}?>>หญิง</option>
                            </select>
                            </div>
                            <div class="six columns no-padding">
                                <label class="account_info">Age / อายุ</label>
                                <input type="text" name="user_age" pattern="[0-9]+" maxlength="2" value="<?php if ($_SESSION['user_age'] == null){echo " ไม่ระบุ ";} else {echo $_SESSION['user_age'];} ?>"></input>
                            </div>
                            <div class="six columns no-margin no-padding">
                                <label class="account_info">Tel / เบอร์โทรศัพท์</label>
                                <input type="text" name="user_tel" maxlength="10" pattern="[0-9]+" value="<?php if ($_SESSION['user_tel'] == null){echo " ไม่ระบุ ";} else {echo $_SESSION['user_tel'];} ?>"></input>
                            </div>
                            <div class="six columns no-padding">
                                <label class="account_info">Registered Date</label>
                                <input type="text" readonly="" style="background: transparent;" value="<?php echo DateFormate($_SESSION['user_date']);?>"></input>
                            </div>
                            <div class="u-full-width">
                                <label class="account_info">Address / ที่อยู่</label>
                                <textarea rows="4" name="user_address" pattern="[a-zA-Z0-9ก-๙]+" class="" cols="100"><?php if ($_SESSION['user_address'] == null){echo "ไม่ระบุ";} else {echo $_SESSION['user_address'];} ?></textarea>
                            </div>
                            <div class="u-full-width">
                                <button type="submit" class="button-primary" name="update-profile" id="update-profile">อัพเดทข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <h5 class="text-blue text-18x"><i class="fa fa-fw fa-lock" aria-hidden="true"></i> เปลี่ยนรหัสผ่าน</h5>
                    <form name="renewpassword" onsubmit="return renewPass()" action="#" method="post">
                      <div class="u-full-width">
                          <label class="account_info">รหัสผ่านเดิม</label>
                          <input type="password" name="old_pass" placeholder="******"></input>
                      </div>
                      <div class="six columns no-margin no-padding">
                          <label class="account_info">รหัสผ่านใหม่</label>
                          <input type="password" name="new_pass" placeholder="******"></input>
                      </div>
                      <div class="six columns no-padding">
                          <label class="account_info">ยืนยันรหัสผ่านใหม่</label>
                          <input type="password" name="pass_retype" placeholder="******"></input>
                      </div>
                      <div class="u-full-width">
                          <button type="submit" class="button-primary" name="update-profile-pass" id="update-profile-pass">เปลี่ยนรหัสผ่าน</button>
                      </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        document.title = "แก้ไขโปรไฟล์";
    </script>
