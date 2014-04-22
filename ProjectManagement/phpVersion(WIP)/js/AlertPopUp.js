function DisplayAlertPopUp(sTitle, sBody) {
    var aPopUp = document.getElementById("AlertPopUp");
    var aPopTitle = document.getElementById("AlertPopUpTitle");
    var aPopBody = document.getElementById("AlertPopUpBody");
    aPopTitle.innerText = sTitle;
    aPopBody.innerText = sBody;
    aPopUp.style.display = "inline";
    aPopUp.style.zIndex = 11;
}

function HideAlertPopUp() {
    var aPopUp = document.getElementById("AlertPopUp");
    var aPopTitle = document.getElementById("AlertPopUpTitle");
    var aPopBody = document.getElementById("AlertPopUpBody");
    aPopTitle.innerText = "";
    aPopBody.innerText = "";
    aPopUp.style.display = "none";
}
function DisplayPopUp(PopId) {
    $("#" + PopId).show()
}
function HidePopUp(PopId, ItemsInPopId) {
    var aPopUp = document.getElementById(PopId);
    aPopUp.style.display = "none";
    var popItems = document.getElementsByName(ItemsInPopId);
    ClearData(ItemsInPopId);
}
function ClearData(object) {
    for (var i = 0; i < object.length; i++) {
        object[i].value = "";
    }
}