function getChat(){
	$.ajax({
		url: "../AJAXapps/index/getChat.php",
		async: false,
		success: function (response){
			var box = document.getElementById("ChatBox");
			$("#ChatBox").html(response);
            box.scrollTop = box.scrollHeight;

		}, 
	});
}

function submitToChat() {
	var xmlhttp;
	var myMessage = $("#GrpChatTxtInput").val();
	if(validateMessage(myMessage) != 0)
	{
		DisplayAlertPopUp("Error", "no message entered");
		return;
	}
	$.post(
		"../AJAXapps/index/addToChat.php", 
		{message: MyMessage}, 
		function (res) {
			if(res != "") {
				DisplayAlertPopUp("Error", res);
			}
		}
	);
	$("#GrpChatTxtInput").val("");	
}

function updateName() {
    var firstName = $("#txt-edit-fname").val();
    var lastName = $("#txt-edit-lname").val();
    
    $.post(
    	"../AJAXapps/settings/updateUser.php",
    	{
    		firstName: firstName,
    		lastName: lastName
    	},
    	function (){
    		DisplayAlertPopUp("Changed Name", "Name was successfully changed"); 
    	}
    );
    $("#txt-edit-fname").val("");
    $("txt-edit-lname").val("");
    location.reload();
}

function updatePassword() {
    var xmlhttp;
    var pass = document.getElementById("txt-old-pass").value;
    var newPass = document.getElementById("txt-new-pass").value;
    var confirm = document.getElementById("txt-pass-confirm").value;
    
    if(newPass != confirm)
    {
        DisplayAlertPopUp("Error", "Passwords do not match, try again.");
        document.getElementById("txt-new-pass").value = "";
        document.getElementById("txt-pass-confirm").value = ""; 
        return;
    }
    if(newPass.length < 6 || newPass.length > 20)
    {
        DisplayAlertPopUp("Error", "Please enter a password between 6 and 20 characters");
        document.getElementById("txt-new-pass").value = "";
        document.getElementById("txt-pass-confirm").value = ""; 
        return;
    }

    $.post(
    		"../AJAXapps/settings/updateUser.php",
    		{
    			curPass: pass,
    			newPass: newPass
    		},
    		function(res) {
    			DisplayAlertPopUp("Success", "User was updated");
    		}
    ).error(
    	function (res) {
    		DisplayAlertPopUp("Error", res);
    	}
    );
    		
    $("#txt-old-pass").val("");
    $("#txt-new-pass").val("");
    $("#txt-pass-confirm").val("");
    location.reload();   
}

function updateEmail() {
    var xmlhttp;
    var newEmail = $("#txt-new-email").val();
    var confirmEmail = $("#txt-email-confirm").val();
    

    if(newEmail != confirmEmail),
    {
        DisplayAlertPopUp("Error", "Emails do not match, try again.");
        $("#txt-new-email").val("");
        $("#txt-email-confirm").val(""); 
        return;
    }
    
    $.post(
    	"../AJAXapps/settings/updateUser.php",
    	{
    		email: newEmail
    	},
    	function(){
    		DisplayAlertPopUp("Success", "Email was updated");
    	}
    ).error(function (res) { 
    	DisplayAlertPopUp("Error", res);
    });
    
    $("#txt-new-email").val("");
    $("#txt-email-confirm").val("");
    location.reload();
}

function EditPopup(task){
	var xmlhttp;
	$.post(
		"../AJAXapps/tasks/getTaskPopUp.php",
		{id: task},
		function (res)
		{
			$("#SelectedPopup").html(res);
            DisplaySelectedPopup();
		}
	).error(function (res) {DisplayAlertPopUp("Error", res});
}

function RefreshTasks(getItemSubset){
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
	      if ( xmlhttp.readyState==4 && xmlhttp.status==200 )
	        {
	        	document.getElementById("TaskList").innerHTML = xmlhttp.responseText;
	        }
	  }
	  xmlhttp.open("POST","../AJAXapps/tasks/getTasks.php",false);
	  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	  xmlhttp.send("finished=" + getItemSubset);
}

function UpdateTask(object, id){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else{
		xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
			var str = xmlhttp.responseText;
            if(str != "")
            {
                DisplayAlertPopUp("Error", str);
            }		
		}
	}
	
	xmlhttp.open("POST", "../AJAXapps/tasks/updateTask.php", false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id=" + id + "&title=" + object[0].value + "&byWhom=" + object[1].value + "&dueDate=" + object[2].value + "&toWhom=" + object[3].value +
					"&priority=" + object[4].value + "&description=" + object[5].value );
}
function EditTask(id){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else{
		xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
			var test = document.getElementById("SelectedPopup");
                test.innerHTML=xmlhttp.responseText;
                DisplaySelectedPopup();
		}
	}
	
	xmlhttp.open("POST", "../AJAXapps/tasks/getEditTask.php", false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id=" + id);

}

function isFinishTask(id, SetTo){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else{
		xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
			var str = xmlhttp.responseText;
            if(str != "")
            {
                DisplayAlertPopUp("Error", str);
            }	
		}
	}
	xmlhttp.open("POST", "../AJAXapps/tasks/SetTaskToFinish.php", false);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("id=" + id + "&Finished=" + SetTo);
}

function LogIn(email, pass){
    var email = typeof (email) !== 'undefined' ? email: $("#txtUsernameLog").val();
    var pass = typeof (pass) !== 'undefined' ? pass: $("#txtPasswordLog").val();
    
    $.post(
    	"../AJAXapps/splash/login.php",
    	{
    		email: email,
    		pass: pass
    	},
    	function(){}
    );
}

function CreateUser(){

    var xmlhttp;
    var firstName = $("#txtFirstName").val();
    var lastName = $("#txtLastName").val();
    var email = $("#txtEmail").val();
    var pass = $("#txtPassword").val();
    var passConfirm = $("#txtPasswordConfirm").val();
    var form_token = $("#token").val();

    if( (firstName=='') || (lastName==''))
    {
        $("#loginError").html("Error: Please enter a valid first and last name.");
    }

    else if((email==''))
    {
        $("#loginError").html("Error: Please enter a valid email.");
    }

    else if((pass==''))
    {
        $("#loginError").html("Error: Please enter a valid password over 6 characters and under 20.");
    }

    else if(pass != passConfirm)
    {
        $("#loginError").html("Error: Your passwords did not match.");
    }
    else
    {
    	$.post(
    		"../AJAXapps/splash/addUser.php",
    		{
    			firstName: firstName, 
    			lastName: lastName,
    			email: email,
    			pass: pass,
    			form_token: form_token
    		}
    		function () { 
	    		LogIn(email, pass);
		        window.location = "../team.php";
    		}
    	).error(
    		function() {
				DisplayAlertPopUp("Error", "System failed to add User");
			}
    	);
    }
}

function LogOut()
{
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if( xmlhttp.readyState==4 && xmlhttp.status==200 ){

        }
    }
    xmlhttp.open("POST", "../AJAXapps/splash/logout.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
    window.location = "../Splash.php";
}

function AddEvent(edit){

    var data = {};
    
    if(edit == true)
    {
    	data = {
	        title: 			$("#CalendarEditTitle").val(),
	        date: 			$("#CalendarEditDate").val(),
	        description: 	$("#CalendarEditDes").val(),
	        theTime:     	$("#CalendarEditTime").val(),
	        id:          	$("#CalendarEditId").val()
        };
    }
    else
    {
    	data = {
	        title:       $("#CalendarTitle").val(),
	        date:        $("#CalendarDate").val(),
	        description: $("#CalendarDes").val(),
	        theTime:     $("#CalendarTime").val()
    	};
    }

    data.theTime = data.theTime.replace(":", "");

    if((data.title != '') && (data.date != ''))
    {
        $.post(
        	"../AJAXapps/calendar/addEvent.php",
        	data,
        	function(){}
        );
    }
}

function EditEvent(id)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
            var test = document.getElementById("SelectedPopup");
            test.innerHTML=xmlhttp.responseText;
            DisplaySelectedPopup();
        }
    }
    xmlhttp.open("POST","../AJAXapps/calendar/getEventDetail.php",false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
}

function DeleteEvent()
{
    var id = document.getElementById("CalendarEditId").value;
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
            var test = document.getElementById("SelectedPopup");
            test.innerHTML=xmlhttp.responseText;
            DisplaySelectedPopup();
        }
    }
    xmlhttp.open("POST","../AJAXapps/calendar/deleteEvent.php",false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
    location.reload();
}

function SwitchDisplayedTasks(object)
{
	 RefreshTasks(object.value);	
}

function AddTeam()
{
    var xmlhttp;
    var teamName = document.getElementById("CreateTeamName").value;
    if(teamName == "")
    {
    	DisplayAlertPopUp("Error", "Team Name is empty");
    }

    if (teamName!=''){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
        }


        xmlhttp.onreadystatechange = function() {
            if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
				
            }
        }
        xmlhttp.open("POST", "../AJAXapps/team/addTeam.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("teamName=" + teamName);
        location.reload();
    }
}

function SelectTeam(id)
{
    var xmlhttp;

    if (id!=''){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if( xmlhttp.readyState==4 && xmlhttp.status==200 ){

            }
        }
        xmlhttp.open("POST", "../AJAXapps/team/selectTeam.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id);
        location.reload();
    }
}

function AddUserToTeam()
{
    var xmlhttp;
    var email = document.getElementById("AddUserToTeam").value;
    if (email == "")
    {
    	DisplayAlertPopUp("Error", "Email textbox is empty.");
    }

    if (email!=''){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if( xmlhttp.readyState==4 && xmlhttp.status==200 ){
				
            }
        }
        xmlhttp.open("POST", "../AJAXapps/team/addToTeam.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("email=" + email);
        location.reload();
    }
}

function LeaveTeam(id)
{
    var xmlhttp;

    if (id!=''){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if( xmlhttp.readyState==4 && xmlhttp.status==200 ){

            }
        }
        xmlhttp.open("POST", "../AJAXapps/team/leaveTeam.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id);
        location.reload();
    }
}

function RemoveFromTeam(id)
{
    var xmlhttp;

    if (id!=''){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if( xmlhttp.readyState==4 && xmlhttp.status==200 ){

            }
        }
        xmlhttp.open("POST", "../AJAXapps/team/removeFromTeam.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id);
        location.reload();
    }
}

function MakeManager(id)
{
    var xmlhttp;

    if (id!=''){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }
        else{
            xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if( xmlhttp.readyState==4 && xmlhttp.status==200 ){

            }
        }
        xmlhttp.open("POST", "../AJAXapps/team/makeManager.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id);
        location.reload();
    }
}