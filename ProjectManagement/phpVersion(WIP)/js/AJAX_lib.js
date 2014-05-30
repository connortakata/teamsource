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
	                test.scrollTop = test.scrollHeight;
		        }
		  }
	var my = document.getElementById("ChatBox");
	xmlhttp.open("GET","../AJAXapps/index/getChat.php",false);
	xmlhttp.send();
}

function submitToChat() {
	var xmlhttp;
	var myMessage = document.getElementById("GrpChatTxtInput").value;
	if(validateMessage(myMessage) != 0)
	{
		DisplayAlertPopUp("Error", "no message entered");
		return;
	}
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
	xmlhttp.open("POST","../AJAXapps/index/addToChat.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("message=" + myMessage);
    document.getElementById("GrpChatTxtInput").value = "";
	
}

function updateName() {
    var xmlhttp;
    var firstName = document.getElementById("txt-edit-fname").value;
    var lastName = document.getElementById("txt-edit-lname").value;
    
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
    xmlhttp.open("POST","../AJAXapps/settings/updateUser.php",false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("firstName=" + firstName + "&lastName=" + lastName);
    document.getElementById("txt-edit-fname").value = "";
    document.getElementById("txt-edit-lname").value = "";
    location.reload();

}

function updatePassword() {
    var xmlhttp;
    var pass = document.getElementById("txt-old-pass").value;
    var newPass = document.getElementById("txt-new-pass").value;
    var confirm = document.getElementById("txt-pass-confirm").value;
    
    if(password != confirm)
    {
        DisplayAlertPopUp("Error", "Passwords do not match, try again.");
        document.getElementById("txt-new-pass").value = "";
        document.getElementById("txt-pass-confirm").value = ""; 
        return;
    }
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
    xmlhttp.open("POST","../AJAXapps/settings/updateUser.php",false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("oldPass=" + pass + "&newPass=" + newPass);
    document.getElementById("txt-new-pass").value = "";
    document.getElementById("txt-pass-confirm").value = "";   
}

function EditPopup(task){
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
	            var test = document.getElementById("SelectedPopup");
                test.innerHTML=xmlhttp.responseText;
                DisplaySelectedPopup();
	        }
	  }
	xmlhttp.open("POST","../AJAXapps/tasks/getTaskPopUp.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id=" + task);
	
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
    var xmlhttp;
    var email = typeof email !== 'undefined' ? email: document.getElementById("txtUsernameLog").value;
    var pass = typeof pass !== 'undefined' ? pass: document.getElementById("txtPasswordLog").value;
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
    xmlhttp.open("POST", "../AJAXapps/splash/login.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + email + "&pass=" + pass);
}

function CreateUser(){

    var xmlhttp;
    var firstName = document.getElementById("txtFirstName").value;
    var lastName = document.getElementById("txtLastName").value;
    var email = document.getElementById("txtEmail").value;
    var pass = document.getElementById("txtPassword").value;
    var passConfirm = document.getElementById("txtPasswordConfirm").value;
    var form_token = document.getElementById("token").value;

    if( (firstName=='') || (lastName==''))
    {
        document.getElementById("loginError").innerHTML = "Error: Please enter a valid first and last name.";
    }

    else if((email==''))
    {
        document.getElementById("loginError").innerHTML = "Error: Please enter a valid email.";
    }

    else if((pass==''))
    {
        document.getElementById("loginError").innerHTML = "Error: Please enter a valid password over 6 characters and under 20.";
    }

    else if(pass != passConfirm)
    {
        document.getElementById("loginError").innerHTML = "Error: Your passwords did not match.";
    }
    else
    {
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
        xmlhttp.open("POST", "../AJAXapps/splash/addUser.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("firstName=" + firstName + "&lastName=" + lastName + "&email=" + email + "&pass=" + pass + "&form_token=" + form_token);
        LogIn(email, pass);
        window.location = "../team.php";
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

    var xmlhttp;
    var title;
    var date;
    var description;
    var theTime;
    var id;
    if(edit==true)
    {
        title       = document.getElementById("CalendarEditTitle").value;
        date        = document.getElementById("CalendarEditDate").value;
        description = document.getElementById("CalendarEditDes").value;
        theTime     = document.getElementById("CalendarEditTime").value;
        id          = document.getElementById("CalendarEditId").value;
    }
    else
    {
        title       = document.getElementById("CalendarTitle").value;
        date        = document.getElementById("CalendarDate").value;
        description = document.getElementById("CalendarDes").value;
        theTime     = document.getElementById("CalendarTime").value;
    }

    theTime = theTime.replace(":","");

    if( (title!='') && (date!=''))
    {
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
        xmlhttp.open("POST", "../AJAXapps/calendar/addEvent.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if(edit==true)
            xmlhttp.send("title=" + title + "&date=" + date  + "&theTime=" + theTime + "&description=" + description + "&edit=" + edit + "&id=" + id);
        else
            xmlhttp.send("title=" + title + "&date=" + date  + "&theTime=" + theTime + "&description=" + description);

    }
}

function EditEvent(id){

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

function SwitchDisplayedTasks(object)
{
	 RefreshTasks(object.value);	
}




function AddTeam()
{
    var xmlhttp;
    var teamName = document.getElementById("CreateTeamName").value;

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

function DownloadFile(teamID, fileName)
{
    var xmlhttp;
    if (teamID!=''&&fileName!='')
    {
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
        xmlhttp.open("POST", "../AJAXapps/resources/download.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("teamID=" + teamID + "&fileName=" + fileName);
    }
}