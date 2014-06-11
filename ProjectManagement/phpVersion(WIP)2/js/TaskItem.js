var transferTask = {
	var id, title, byWhom, dueDate,  toWhom, description;
	
	function loadObject(myObject)
	{
		if (myObject.length != 5)
			return;
		
		title = myObject[0];
		byWhom = myObject[1];
		dueDate = myObject[2];
		toWhom = myObject[3];
		description = myObject[4];
		
	} 
	
	function clearData() {
		
		id = "";
		title = "";
		byWhom = "";
		dueDate = "";
		toWhom = "";
		description = "";

	}
	
}