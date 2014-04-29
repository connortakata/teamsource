/* 	this a prototype of how the javascript functions are going to work
 this currently uses firebase as a way to track the chat,
 which will only work for our chat for our group.
 This will be in place till we have a database in place.
 */

function submitToChat() {
    var xmlhttp;
    var user = "Joe"
    var date = new Date();
    var myMessage = document.getElementById("GrpChatTxtInput").value;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var str = xmlhttp.responseText;
            if(str != "")
            {
                DisplayAlertPopUp("Error", str);
            }
        }
    }
    xmlhttp.open("POST","addToChat.php",false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("user=" + user +  "&message=" + myMessage + "&TimeStamp=" + date.toLocaleString());
    document.getElementById("GrpChatTxtInput").value = "";

}
function getChat(){
    setTimeout(function(){}, 1000);
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var test = document.getElementById("ChatBox");
            test.innerHTML=xmlhttp.responseText;
        }
    }
    var my = document.getElementById("ChatBox");
    xmlhttp.open("GET","getChat.php",false);
    xmlhttp.send();
};