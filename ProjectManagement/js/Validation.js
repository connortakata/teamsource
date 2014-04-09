$import_js('js/firebase.js');
function validatePopUp(object)
{
	for(var i = 0; i < object.length; i++)
	{
		if ($(object[i]).val() == "")
		{
			alert("Task title and due date must be speificed when making a task.");
    		return 1;
		}
	}
	pushValidatedTasks(object);
	return 0;
}
function pushValidatedTasks(object)
{
	var fb = new Firebase('https://burning-fire-7708.firebaseio.com/tasks');
	fb.push({Title: object[0].value, Priority: object[4].value, To: object[3].value, By: object[1].value, FinishDate: object[2].value, Description: object[5].value});
} 
