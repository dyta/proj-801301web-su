/**
 * เข้าสู่ระบบ
 */
function loginProcess() {
    var email = document.forms['login']['email'].value;
    var pass = document.forms['login']['password'].value;
    var message = "โปรดกรอก:";
    var valid = true;
    if (email == null || email == '') {
        valid = false;
        message = message + " อีเมล์";
    }
    if (pass == null || pass == '') {
        valid = false;
        message = message + (" รหัสผ่าน");
    }
    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=login',
            data: "email=" + email + "&password=" + pass,
            beforeSend: function() {
                $("#btn-login").html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> กรุณารอสักครู่...');
            },
            success: function(response) {
                if (response == 'ok') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html('<p><i class="fa fa-check fa-fw"></i> เข้าสู่ระบบสำเร็จ</p>');
                    $(".dimmer").removeClass("overlay-none");
                    $(".dimmer").addClass("overlay");
                    setTimeout('location.reload();', 1000);
                } else {
                    $("#error").fadeIn(100, function() {
                        $("#error").html(response);
                        $("#btn-login").html('เข้าสู่ระบบ');
                    });
                }
            }
        })
    }
    return false;
}

/**
 * เปลี่ยนรหัสผ่าน
 */
function renewPass() {
    var new_pass = document.forms['renewpassword']['new_pass'].value;
    var old_pass = document.forms['renewpassword']['old_pass'].value;
    var pass_retype = document.forms['renewpassword']['pass_retype'].value;

    var message = "โปรดกรอก:";
    var valid = true;
    if (new_pass == null || new_pass == '') {
        valid = false;
        message = message + " รหัสผ่านเดิม";
    }
    if (old_pass == null || old_pass == '') {
        valid = false;
        message = message + (" รหัสผ่านใหม่");
    }
    if (pass_retype == null || pass_retype == '') {
        valid = false;
        message = message + (" ยืนยันรหัสผ่านใหม่");
    }
    if (new_pass !== pass_retype) {
        valid = false;
        message = message + (" ยืนยันรหัสผ่านไม่ตรงกัน");
    }
    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=updateprofile_p',
            data: "new_pass=" + new_pass + "&old_pass=" + old_pass + "&pass_retype=" + pass_retype,
            beforeSend: function() {
                $("#update-profile-pass").html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> กรุณารอสักครู่...');
            },
            success: function(response) {
                if (response == "0") {
                    $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> รหัสที่คุณเปลี่ยนยังเหมือนเดิม</p>');
                    setTimeout(function() {
                        $("#update-profile-pass").html('เปลี่ยนรหัสผ่าน');
                    }, 1000);
                } else if (response == "same") {
                    $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> รหัสผ่านเดิมไม่ถูกต้อง</p>');
                    setTimeout(function() {
                        $("#update-profile-pass").html('เปลี่ยนรหัสผ่าน');
                    }, 1000);
                } else {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html(response);
                    setTimeout('location.reload();', 1000);
                }
            }
        })
    }
    return false;
}
/**
 * สมัครสมาชิก
 */
function regisProcess() {
    var name = document.forms['register']['name'].value;
    var email = document.forms['register']['email'].value;
    var password = document.forms['register']['password'].value;
    var repassword = document.forms['register']['repassword'].value;

    var message = "เกิดข้อผิดพลาด: ";
    var message2 = '';
    var valid = true;

    if (name == null || name == '' || email == null || email == '' || password == null || password == '' || repassword == null || repassword == '') {
        message = message + " โปรดกรอก";
        valid = false;
    }

    if (name == null || name == '') {
        valid = false;
        message = message + " ชื่อ-นามสกุล";
    }

    if (email == null || email == '') {
        valid = false;
        message = message + (" อีเมล์");
    }

    if (password == null || password == '') {
        valid = false;
        message = message + (" รหัสผ่าน");
    }

    if (repassword == null || repassword == '') {
        valid = false;
        message = message + (" ยืนยันรหัสผ่าน");
    }

    if (password != repassword) {
        valid = false;
        message2 += " ยืนยันรหัสผ่านไม่ตรงกัน";
    }

    if (valid == false)
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + message2 + '</p>');
    else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=register',
            data: "name=" + name + "&email=" + email + "&password=" + password + "&repassword=" + repassword,
            beforeSend: function() {
                $("#btn-regis").html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> กรุณารอสักครู่...');
            },
            success: function(response) {
                if (response == "1") {
                    $("#error").html('<p><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> กรุณารอ 5 นาที ในการทำรายการครั้งต่อไป</p>');
                    setTimeout(function() {
                        $("#btn-regis").html('สมัครสมาชิก');
                    }, 1000);
                } else if (response == "2") {
                    $("#error").html('<p><i class="fa fa-fw fa-times" aria-hidden="true"></i> อีเมล์นี้ถูกใช้งานแล้ว</p>');
                    setTimeout(function() {
                        $("#btn-regis").html('สมัครสมาชิก');
                    }, 1000);
                } else {
                    $(".dimmer").removeClass("overlay-none");
                    $(".dimmer").addClass("overlay");
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#btn-regis").html('<i class="fa fa-check fa-fw"></i> สมัครสมาชิกเรียบร้อยแล้ว');
                    $("#error").html("<p>" + response + "</p>");
                    setTimeout("window.location.href = '/';", 1000);
                }
            }
        })
    }
    return false;
}
/**
 * เปลี่ยน Avatar
 */
function avatarImg() {
    var data = document.forms['uploadAvatar']['fileToUpload'].value;
    var file_data = $('#fileToUpload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    var message = "โปรดเลือกรูปภาพ";
    var valid = true;

    if (data == null || data == '') {
        valid = false;
    }

    if (valid == false)
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=avatar',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function() {
                $("#img-profile").html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> กำลังอัพโหลด...');
            },
            success: function(response) {
                if (response == "1") {
                    $("#error").html("<p>ขนาดไฟล์ต้องไม่เกิน 200KB</p>");
                    setTimeout(function() {
                        $("#img-profile").html('เปลี่ยนรูปโปรไฟล์');
                    }, 1000);
                } else if (response == "2") {
                    $("#error").html("<p>เฉพาะไฟล์นามสกุล jpg, jpeg, png เท่านั้น</p>");
                    setTimeout(function() {
                        $("#img-profile").html('เปลี่ยนรูปโปรไฟล์');
                    }, 1000);
                } else {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>" + response + "</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        })
    }
    return false;
}

function imagesCHK() {
    var data = document.forms['uploadAvatar']['fileToUpload'].value;

    var message = "โปรดเลือกรูปภาพ";
    var valid = true;

    if (data == null || data == '') {
        valid = false;
    }

    if (valid == false)
        alert(message);
    return valid;
}

/**
 * อัพเดทโปรไฟล์
 */
function updateInfor(name) {
    var user_name = document.forms['frmupdate']['user_name'].value;
    var gender = document.forms['frmupdate']['gender'].value;
    var user_age = document.forms['frmupdate']['user_age'].value;
    var user_tel = document.forms['frmupdate']['user_tel'].value;
    var user_address = document.forms['frmupdate']['user_address'].value;

    var message = "เกิดข้อผิดพลาด: ";
    var valid = true;

    if (user_name == null || user_name == '') {
        message += "โปรดกรอก ชื่อ-นามสกุล";
        valid = false;
    } else if (name == user_name + gender + user_age + user_tel + user_address) {
        message += "ไม่พบการเปลี่ยนแปลงของข้อมูล";
        valid = false;
    }

    if (valid == false)
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=updateprofile',
            data: "user_name=" + user_name + "&gender=" + gender + "&user_age=" + user_age + "&user_tel=" + user_tel + "&user_address=" + user_address,
            beforeSend: function() {
                $("#img-profile").html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> กรุณารอสักครู่...');
                $("#update-profile").html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> กรุณารอสักครู่...');
            },
            success: function(response) {
                if (response) {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>" + response + "</p>");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        })
    }
    return false;
}

/**
 * ลบบัญชีผู้ใช้
 */
function DeleteAccount(id) {
    var confirm_del = document.forms['comfirm']['confirm_del'].value;

    var message = "กรุณาพิมพ์คำว่า ลบบัญชี เพื่อยืนยัน";
    var valid = true;

    if (confirm_del == null || confirm_del == '') {
        valid = false;
    }

    if (valid == false)
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=deleteaccount',
            data: "user_id=" + id + "&confirm_del=" + confirm_del,
            success: function(response) {
                if (response) {
                    $("#error").html("<p>" + response + "</p>");
                    setTimeout(function() {
                        $("#error").html("");
                        window.location.reload();
                    }, 1000);
                }
            }
        })
    }
    return false;
}
/**
 * ค้นหาบัญชีสมาชิก
 */
function validSearch() {
    var search = document.forms['search']['search'].value;

    var message = "กรุณากรอกชื่อที่คุณต้องการค้นหา";
    var valid = true;

    if (search == null || search == '') {
        valid = false;
    }

    if (valid == false)
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    else {
        return true;
    }

    return false;
}
/**
 * สร้างหมวดหมู่สินค้า
 */
function CreateCate() {
    var cate = document.forms['cate']['cate_name'].value;
    var message = "โปรดกรอก: ";
    var valid = true;

    if (cate == null || cate == '') {
        message += "ชื่อหมวดหมู่";
        valid = false;
    }

    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=createCate',
            data: "cate_name=" + cate,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>เพิ่มหมวดหมู่เรียบร้อยแล้ว</p>");
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
/**
 * อัพเดทหมวดหมู่สินค้า
 */
function cateUpdateInfor(key) {
    var cate_name = document.forms['cateupdate']['cate_name'].value;
    var cate_description = document.forms['cateupdate']['cate_description'].value;
    var message = "โปรดกรอก: ";
    var valid = true;

    if (cate_name == null || cate_name == '') {
        message += "ชื่อหมวดหมู่";
        valid = false;
    }

    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=updateCate',
            data: "cate_name=" + cate_name + "&cate_description=" + cate_description + "&key=" + key,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>อัพเดทข้อมูลเรียบร้อยแล้ว</p>");
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

/**
 * เพิ่มช่องทางการชำระเงิน
 */
function paymethodCHK() {
    var paymethod_name = document.forms['payment_methodAdd']['paymethod_name'].value;
    var paymethod_no = document.forms['payment_methodAdd']['paymethod_no'].value;
    var paymethod_bank = document.forms['payment_methodAdd']['paymethod_bank'].value;
    var paymethod_type = document.forms['payment_methodAdd']['paymethod_type'].value;
    var paymethod_branch = document.forms['payment_methodAdd']['paymethod_branch'].value;

    var message = "โปรดกรอก: ";
    var valid = true;

    if (paymethod_name == null || paymethod_name == '') {
        message += "ชื่อบัญชี";
        valid = false;
    }
    if (paymethod_no == null || paymethod_no == '') {
        message += " เลขที่บัญชี";
        valid = false;
    }
    if (paymethod_branch == null || paymethod_branch == '') {
        message += " สาขา";
        valid = false;
    }

    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=payMetAdd',
            data: "paymethod_name=" + paymethod_name + "&paymethod_no=" + paymethod_no + "&paymethod_bank=" + paymethod_bank + "&paymethod_type=" + paymethod_type + "&paymethod_branch=" + paymethod_branch,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>เพิ่มช่องทางการชำระเงินเรียบร้อยแล้ว</p>");
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

/**
 * ลบหมวดหมู่
 */
function deCate(key) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?auth=deleteCate',
        data: "key=" + key,
        success: function(response) {
            if (response == '1') {
                $("#error").removeClass("alert-error");
                $("#error").addClass("alert-success");
                $("#error").html("<p>ลบหมวดหมู่เรียบร้อยแล้ว</p>");
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
/**
 * ลบช่องทางการชำระเงิน
 */
function dePaymethod(key) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?auth=payMetDel',
        data: "key=" + key,
        success: function(response) {
            if (response == '1') {
                $("#error").removeClass("alert-error");
                $("#error").addClass("alert-success");
                $("#error").html("<p>ลบช่องทางการชำระเงินเรียบร้อยแล้ว</p>");
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

function updatePaymentMethod(key) {
    var paymethod_name = document.forms['payment_methodAdd']['paymethod_name'].value;
    var paymethod_no = document.forms['payment_methodAdd']['paymethod_no'].value;
    var paymethod_bank = document.forms['payment_methodAdd']['paymethod_bank'].value;
    var paymethod_type = document.forms['payment_methodAdd']['paymethod_type'].value;
    var paymethod_branch = document.forms['payment_methodAdd']['paymethod_branch'].value;

    var message = "โปรดกรอก: ";
    var valid = true;

    if (paymethod_name == null || paymethod_name == '') {
        message += "ชื่อบัญชี";
        valid = false;
    }
    if (paymethod_no == null || paymethod_no == '') {
        message += " เลขที่บัญชี";
        valid = false;
    }
    if (paymethod_branch == null || paymethod_branch == '') {
        message += " สาขา";
        valid = false;
    }

    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=payMetUpd',
            data: "key=" + key + "&paymethod_name=" + paymethod_name + "&paymethod_no=" + paymethod_no + "&paymethod_bank=" + paymethod_bank + "&paymethod_type=" + paymethod_type + "&paymethod_branch=" + paymethod_branch,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>อัพเดทข้อมูลเรียบร้อยแล้ว</p>");
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
/**
 * สร้างหน้า
 */
function createPage() {
    var page_name = document.forms['page']['page_name'].value;
    var page_url = document.forms['page']['page_url'].value;
    var message = "โปรดกรอก: ";
    var valid = true;

    if (page_name == null || page_name == '') {
        message += "ชื่อหน้า";
        valid = false;
    }

    if (page_url == null || page_url == '') {
        message += " SHORTCUT URL";
        valid = false;
    }

    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=createPage',
            data: "page_name=" + page_name + "&page_url=" + page_url,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>เพิ่มหน้าเรียบร้อยแล้ว</p>");
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

/**
 * อัพเดทหน้า
 */
function updateData(key) {

    var value = document.forms['textarea_oi']['content_page'].value;
    var cont_title = document.forms['textarea_oi']['cont_title'].value;
    var cont_url = document.forms['textarea_oi']['cont_url'].value;
    var cont_published = document.forms['textarea_oi']['cont_published'].value;
    var cont_showontop = document.forms['textarea_oi']['cont_showontop'].value;

    var message = "โปรดกรอก: ";
    var valid = true;

    if (cont_title == null || cont_title == '') {
        message += "ชื่อหน้า";
        valid = false;
    }

    if (cont_url == null || cont_url == '') {
        message += " URL";
        valid = false;
    }

    if (valid == false) {
        $("#error").html('<p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> ' + message + '</p>');
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?auth=updatePage',
            data: "cont_showontop=" + cont_showontop + "&cont_published=" + cont_published + "&cont_url=" + cont_url + "&cont_title=" + cont_title + "&content_page=" + value + "&key=" + key,
            success: function(response) {
                if (response == '1') {
                    $("#error").removeClass("alert-error");
                    $("#error").addClass("alert-success");
                    $("#error").html("<p>เนื้อหาได้รับการเปลี่ยนแปลง</p>");
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
/**
 * ลบหน้า
 */
function dePage(key) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?auth=deletePage',
        data: "key=" + key,
        success: function(response) {
            if (response == '1') {
                $("#error").removeClass("alert-error");
                $("#error").addClass("alert-success");
                $("#error").html("<p>ลบหน้าเรียบร้อยแล้ว</p>");
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
/**
 * Add to cart
 */
function addcrt(id, qty) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?auth=addcart',
        data: "id=" + id + "&qty=" + qty,
        success: function(response) {
            if (response == '1') {
                $("#error").removeClass("alert-error");
                $("#error").addClass("alert-success");
                $("#error").html("<p>เพิ่มสินค้าลงตะกร้าเรียบร้อยแล้ว</p>");
            } else {
                $("#error").removeClass("alert-error");
                $("#error").addClass("alert-success");
                $("#error").html("<p>" + response + "</p>");
            }
            setTimeout(function() {
                document.location = "?action=cart";
            }, 1000);
        }
    })
    return false;
}
