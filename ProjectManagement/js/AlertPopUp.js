function DisplayAlertPopUp(sTitle, sBody) {
    var aPopUp = document.getElementById("AlertPopUp");
    var aPopTitle = document.getElementById("AlertPopUpTitle");
    var aPopBody = document.getElementById("AlertPopUpBody");
    aPopTitle.innerText = sTitle;
    aPopTitle.textContent = sTitle;
    //Note: the 'duplicate' text changers here (innerText and textContent) are for firefox compatibility
    aPopBody.innerText = sBody;
    aPopBody.textContent = sBody;
    aPopUp.style.display = "inline";
    aPopUp.style.zIndex = 11;
}

function HideAlertPopUp() {
    var aPopUp = document.getElementById("AlertPopUp");
    var aPopTitle = document.getElementById("AlertPopUpTitle");
    var aPopBody = document.getElementById("AlertPopUpBody");
    aPopTitle.innerText = "";
    aPopTitle.textContent = "";
    aPopBody.innerText = "";
    aPopBody.textContent = "";
    aPopUp.style.display = "none";
}

function DisplayConfirmationPopUp(sTitle, sBody, func) {
    var aPopUp = document.getElementById("ConfirmationPopUp");
    var aPopTitle = document.getElementById("ConfirmationPopUpTitle");
    var aPopBody = document.getElementById("ConfirmationPopUpBody");
    var aPopConfirm = document.getElementById("PopUpConfirm");
    aPopTitle.innerText = sTitle;
    aPopTitle.textContent = sTitle;
    aPopBody.innerText = sBody;
    aPopBody.textContent = sBody;
    aPopConfirm.setAttribute("onClick", func+";");
    aPopUp.style.display = "inline";
    aPopUp.style.zIndex = 11;
}

function HideConfirmationPopUp() {
    var aPopUp = document.getElementById("ConfirmationPopUp");
    var aPopTitle = document.getElementById("ConfirmationPopUpTitle");
    var aPopBody = document.getElementById("ConfirmationPopUpBody");
    var aPopConfirm = document.getElementById("PopUpConfirm");
    aPopTitle.innerText = "";
    aPopTitle.textContent = "";
    aPopBody.innerText = "";
    aPopBody.textContent = "";
    aPopConfirm.onclick = null;
    aPopUp.style.display = "none";
}