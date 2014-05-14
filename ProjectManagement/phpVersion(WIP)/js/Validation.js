$import_js('js/firebase.js');
function validatePopUp(object)
{
	for(var i = 0; i < object.length; i++)
	{
		if ($(object[i]).val() == "")
		{
			DisplayAlertPopUp("Validation Error","Task title and due date must be specified when making a task.");
    		return 1;
		}
	}
	var DateSuccess = DateValidation(object[2].value);
	if (DateSuccess == 1)
	    return 1;
	pushValidatedTasks(object);
	return 0;
}
function pushValidatedTasks(object)
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
    xmlhttp.onreadystatechange=function()
	  {
	      if (xmlhttp.readyState==4 && xmlhttp.status==200)
	        {
	        	var ServerResponse = xmlhttp.responseText;
	        	if ( ServerResponse != "")
	        	{
                	DisplayAlertPopUp ("Server Error", ServerResponse);
                }
	        }
	  }
	xmlhttp.open("POST","../AJAXapps/tasks/addToTasks.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("title=" + object[0].value + "&byWhom=" + object[1].value + "&dueDate=" + object[2].value + "&toWhom=" + object[3].value +
					"&priority=" + object[4].value + "&description=" + object[5].value + "&finished= 0");
}
function DateValidation(Day) {
    var Today = new Date();
    var month, day;
    if ((month = Today.getMonth() + 1) < 10) {
        month = "0" + (Today.getMonth() + 1).toString();
    }
    else {
        month = month.toString();
    }
    if ((day = Today.getDate()) < 10) {
        day = "0" + Today.getDate.toString()
    }
    else {
        day = day.toString();
    }
    var CompareValue = Today.getFullYear().toString() + "-" + month + "-" + day;
    if (CompareValue >= Day) {
        DisplayAlertPopUp("Validation Error", "The date must be set to a day in the future.");
        return 1;
    }
    return 0;
}
function validateMessage(message) {
	if (message == "")
		return -1;
	else 
		return 0;
}
