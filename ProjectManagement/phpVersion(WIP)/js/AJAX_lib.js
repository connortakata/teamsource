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
		
		}
	}
	xmlhttp.open("POST", "../AJAXapps/tasks/SetTaskToFinish.php", false);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("id=" + id + "&Finished=" + SetTo);
}

function LogIn(){
    var xmlhttp;
    var email = document.getElementById("txtUsernameLog").value;
    var pass = document.getElementById("txtPasswordLog").value;

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
    xmlhttp.open("POST", "login.php", false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + email + "&pass=" + pass);
    window.location = "index.php";
}

function CreateUser(){

    var xmlhttp;
    var firstName = document.getElementById("txtFirstName").value;
    var lastName = document.getElementById("txtLastName").value;
    var email = document.getElementById("txtEmail").value;
    var pass = document.getElementById("txtPassword").value;
    var passConfirm = document.getElementById("txtPasswordConfirm").value;

    if( (firstName!='') && (lastName!='') && (email!='') && (pass!='') && (pass==passConfirm) ){
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
        xmlhttp.open("POST", "addUser.php", false);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("firstName=" + firstName + "&lastName=" + lastName + "&email=" + email + "&pass=" + pass);
    }
    else
    {
        document.getElementById("loginError").innerHTML = "Error: Your passwords did not match or you left a field empty.";
    }
    //window.location = "index.php";
}