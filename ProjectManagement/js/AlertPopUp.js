function DisplayAlertPopUp(sTitle, sBody) {
    $("#AlertPopUpTitle").text(sTitle);
    $("#AlertPopUpBody").text(sBody);
    $("#AlertPopUp").show().css({"z-index": 11});
}

function HideAlertPopUp() {
    $("#AlertPopUp").hide();
    $("#AlertPopUpTitle").text("");
    $("#AlertPopUpBody").text("");
}