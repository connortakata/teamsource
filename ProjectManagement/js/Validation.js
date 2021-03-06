﻿$import_js('js/firebase.js');
function validatePopUp(object)
{
	for(var i = 0; i < object.length; i++)
	{
		if ($(object[i]).val() == "")
		{
			DisplayAlertPopUp("Validation Error","Task title and due date must be speificed when making a task.");
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
	var fb = new Firebase('https://burning-fire-7708.firebaseio.com/tasks');
	fb.push({Title: object[0].value, Priority: object[4].value, To: object[3].value, By: object[1].value, FinishDate: object[2].value, Description: object[5].value});
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
