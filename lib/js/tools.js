function openPopup(data, where) {
    popname = window.open("?action=uploadimages&key=" + data + "&_wh=" + where, "Insert image", "status=0, height=130, width=450, toolbar=false,resizable=false");
    popname.window.focus();
}

function toolsEtc() {
    popname = window.open("?action=alltools", "การใช้งาน", "status=0, height=800, width=800, toolbar=false,resizable=false");
    popname.window.focus();
}

function navResponsive() {
    var x = document.getElementById("nav-default");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
