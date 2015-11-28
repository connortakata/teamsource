var AlertPopUp = (function(){
    function AlertPopUp() {
        this.modal = document.getElementById("AlertPopUp");
        this.title = document.getElementById("AlertPopUpTitle");
        this.body = document.getElementById("AlertPopUpBody");
        this.modal.style.display = "none";
        this.model.style.zIndex = "11";
    }
    
    AlertPopUp.prototype.Show = function() {
        this.model.style.display = "inline";
    }
    AlertPopUp.prototype.Hide = function() {
        this.model.style.display = "none";
    }
    AlertPopUp.prototype.Populate = function (title, body) {
        this.title.innerText = (typeof(title) != "string") ? "" : title;
        this.body.innerText = (typeof(body) != "string") ? "" : body;
        this.Show();
    }
    
    return AlertPopUp;
})();