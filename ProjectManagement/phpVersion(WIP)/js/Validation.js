﻿var alertPopUp = (typeof alertPopUp == "undefined") ?  new AlertPopUp() : alertPopUp;

function validatePopUp(object)
{
	for(var i = 0; i < object.length; i++)
	{
		if ($(object[i]).val() == "")
		{
			alertPopUp.Populate("Validation Error","Task title and due date must be specified when making a task.");
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
	$.post(
		"../AJAXapps/tasks/addToTasks.php",
		{
			title: object[0].value,
			byWhom: object[1].value,
			dueDate: object[2].value,
			toWhom: object[3].value, 
			priority: object[4].value,
			description: object[5].value,
			finished: 0
		},
		function (res){
			//nothing.
		}
	).error(function(e){
		alertPopUp.populate("Server Error", e);
	});
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
        day = "0" + day.toString()
    }
    else {
        day = day.toString();
    }
    var CompareValue = Today.getFullYear().toString() + "-" + month + "-" + day;
    if (CompareValue >= Day) {
        alertPopUp.Populate("Validation Error", "The date must be set to a day in the future.");
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
function validatePasswords(passwords)
{
	if (passwords[0].value.length < 6 || passwords[1].value.length < 6)
	{
		alertPopUp.Populate("Validation Error", "Your password is too short")
		return;
	}
    else if (passwords[0].value.length > 20 || passwords[1].value.length > 20)
    {
        alertPopUp.Populate("Validation Error", "Your password is too Long")
        return;
    }
	else if(passwords[0].value != passwords[1].value)
	{
		alertPopUp.Populate("Validation Error", "Your passwords are not the same");
		return;
	}
}
