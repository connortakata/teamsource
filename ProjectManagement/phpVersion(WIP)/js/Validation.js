$import_js('js/firebase.js');
function validatePopUp(object, DataSet)
{
	for(var i = 0; i < object.length; i++)
	{
		if ($(object[i]).val() == "")
		{
		    var message;
		    if (DataSet == "Task")
		        message = "Task title and due date must be speificed when making a task.";
		    if (DataSet == "Calendar")
		        message = "This pop-up needs to have a set date and title";
			DisplayAlertPopUp("Validation Error", message);
    		return 1;
		}
	}
	if (DataSet == "Task") {
	    var DateSuccess = DateValidation(object[2].value);
	    if (DateSuccess == 1)
	        return 1;
	    pushValidatedTasks(object);
	}
	if (DataSet == "Calendar") {
	    var DateSuccess = DateValidation(object[1].value);
	    if (DateSuccess == 1)
	        return 1;
	    //pushValidatedCalendar(object);
	}
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
	xmlhttp.open("POST","addToTasks.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("title=" + object[0].value + "&byWhom=" + object[1].value + "&dueDate=" + object[2].value + "&toWhom=" + object[3].value +
					"&priority=" + object[4].value + "&description=" + object[5].value );
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
