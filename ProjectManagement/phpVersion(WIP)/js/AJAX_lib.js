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
    

    if(newEmail != confirmEmail)
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
	$.post(
        "../AJAXapps/tasks/getTasks.php",
        {finished: getItemSubset},
        function(res) {
            document.getElementById("TaskList").innerHTML = res;
        }
    );
}

function UpdateTask(object, id){
	$.post(
        "../AJAXapps/tasks/updateTask.php",
        {
            id: id,
            title: object[0].value,
            byWhom: object[1].value,
            dueDate: object[2].value,
            toWhom: object[3].value,
            priority: object[4].value,
            description: object[5].value
        },
        function(res) {
            console.log(res);     
        }
    ).error(function(e) { 
        DisplayAlertPopUp("Error", e); 
    });
}
function EditTask(id){
	$.post(
        "../AJAXapps/tasks/getEditTask.php",
        {id: id},
        function(res){
            var test = document.getElementById("SelectedPopup");
                test.innerHTML = res;
                DisplaySelectedPopup();
        }
    );
}

function isFinishTask(id, SetTo){
	$.post(
        "../AJAXapps/tasks/SetTaskToFinish.php",
        {
            id:id, 
            Finished:SetTo
        },
        function(res){
            
        }
    ).error(function(e){ DisplayAlertPopUp("Error", e); });
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

function CreateUser() { 
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
    		},
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
	$.post(
		"../AJAXapps/splash/logout.php",
		{},
		function() {
			window.location = "../Splash.php";
		}
	);
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
        	function(){
        		location.reload();
        	}
        );
    }
}

function EditEvent(id)
{
	$.post(
		"../AJAXapps/calendar/getEventDetail.php",
		{id: id},
		function (res){
			$("#SelectedPopup").html(res);
			DisplaySelectedPopup();
		}
	);
}

function DeleteEvent()
{
    var id = $("#CalendarEditId").val();
    $.post(
    	"../AJAXapps/calendar/deleteEvent.php",
    	{id: id},
    	function (res) {
    		$("#SelectedPopup").html(res);
    		DisplaySelectedPopup();	
    		location.reload();
    	}	
    ).error(function (){ DisplayAlertPopup("Error", "Failed to Delete") });
}

function SwitchDisplayedTasks(object)
{
	 RefreshTasks(object.value);	
}

function AddTeam()
{
    var teamName = document.getElementById("CreateTeamName").value;
    if(teamName == "")
    {
    	DisplayAlertPopUp("Error", "Team Name is empty");
    }

    if (teamName!=''){
        $.post(
        	"../AJAXapps/team/addTeam.php",
        	{teamName: teamName},
        	function() {
        		location.reload();
        	}
        ).error(function() { DisplayAlertPopup("Error", "failed to add team")});
    }
}

function SelectTeam(id)
{
	$.post(
		"../AJAXapps/team/selectTeam.php",
		{id: id},
		function () {
		    location.reload();
		}
	).error();    
}

function AddUserToTeam()
{
    var xmlhttp;
    var email = $("#AddUserToTeam").val();
    if (email == "")
    {
    	DisplayAlertPopUp("Error", "Email textbox is empty.");
    }
	else {
		$.post(
			"../AJAXapps/team/addToTeam.php",
			{email: email},
			function() {
				location.reload();
			}
		).error(function(){
			DisplayAlertPopUp("Error", "Failed to add user to team. please try again");
		});
    }
}

function LeaveTeam(id)
{
    if (id!=''){
    	$.post(
    		"../AJAXapps/team/leaveTeam.php",
    		{id: id},
    		function() {
    			location.reload();
    		}
    	).error(function() {
    		DisplayAlertPopup("Error", "Failed to leave team please try again");
    	});
    }
}

function RemoveFromTeam(id)
{
    if (id!=''){
    	$.post(
    		"../AJAXapps/team/removeFromTeam.php",
    		{id: id},
    		function() {
    			location.reload();	
    		}
    	).error(function() {
    	
    	});
    }
}

function MakeManager(id)
{
    if (id!=''){
    	$.post(
    		"../AJAXapps/team/makeManager.php",
    		{id: id},
    		function() {
		        location.reload();
    		}
    	).error(function () { DisplayAlert("Error", "User was not made a manager please try again") });    }
}