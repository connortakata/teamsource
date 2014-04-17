<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
			<div id="AlertPopUp" class="PopupShadow" style="display:none; position:fixed; top:40%; left:35%; width:400px; height:auto">
			<div class="well" style="width:100%; height:100%;">
				<div class="panel panel-primary" style="height:100%;">
					<div class="panel-heading">
						<label id="AlertPopUpTitle"></label>
					</div>
					<div id="AlertPopUpBody" class="panel-body">

					</div>
					<div class="btn-group">
						<input type="button" value="Ok" style="margin-left:300px; width:50px" onclick="HideAlertPopUp()" />
					</div>
				</div>
			</div>
		</div>   
		<div id="pop-up" class="PopupShadow" style="display:none; position:fixed; top:150px; left:27%; width:600px; height:auto;">
			<div class="well" style="width:100%; height:auto;">
				<div class="panel panel-primary" style="height:auto">
				  <div class="panel-heading">
					<input name="popItem" id="TaskTitle" type="text" class="form-control" placeholder="Task Title">			    
				  </div>
				  <div class="panel-body">
			
					Task Issued By: <select name="popItem" id="IssuedBy"></select><br><br>
					Finish By: <input name="popItem" id="FinishBy" type="date" style="height:25px"/><br><br>
					Issued To: <select name="popItem" id="IssuedTo"></select><br><br>
					Priority: <select name="popItem" id="Priority"><option>High</option><option>Medium</option><option>Low</option></select><br><br>
					Task Description: <br>
					<div class="panel-info">
						<textarea name="popItem" id="TaskDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;"  ></textarea>
					</div>
					<div class="btn-group">
					  <button id="btnComplete" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-ok"></span> Submit</button>
					  <button id="btnDelete" type="button" class="btn btn-default" onclick="HidePopup()"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
			
				  </div>
				</div>
			</div>
		</div>
		<div id="SelectedPopup" class="PopupShadow" style="display:none; position:fixed; top:150px; left:20%; width:600px; height:auto;">
			<div class="well" style="width:100%; height:auto;">
				<div class="panel panel-primary" style="height:auto">
				  <div class="panel-heading">
					<input id="selTaskTitle" type="text" class="form-control" disabled="disabled" placeholder="Task Title">			    
				  </div>
				  <div class="panel-body">
			
					Task Issued By: <label id="selIssuedBy"></label><br><br>
					Finish By: <input id="selFinishBy" disabled="disabled" type="date" style="height:25px"/><br><br>
					Issued To: <label id="selIssuedTo"></label><br><br>
					Priority: <label id="selPriority"></label><br><br>
					Task Description: <br>
					<div class="panel-info">
						<label id="selTaskDes" rows="5" class="form-control" style="height:50%; width:100%;"  ></label>
					</div>
					<div class="btn-group">
					  <button id="btnSelComplete" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-ok"></span> Complete</button>
					  <button id="btnSelEdit" type="button" class="btn btn-default" onclick="HideSelectedPopup()"><span class="glyphicon glyphicon-wrench"></span> Edit</button>
					  <button id="btnSelDelete" type="button" class="btn btn-default" onclick="HideSelectedPopup()"><span class="glyphicon glyphicon-remove"></span> Delete</button>
					</div>
			
				  </div>
				</div>
			</div>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Task Manager</h1>
        </div>
        <div id="mainButtons" align="left" style="display:table; margin:0 auto; padding-bottom:10px">
            <!--<a href="add-task.html" rel="#overlay" stype="text-decoration:none">-->
              <button type="button" class="btn btn-default btn-med" onclick="DisplayPopup()">
                <span class="glyphicon glyphicon-plus"></span> Add Task
              </button>
            <!--</a>-->
          <button type="button" class="btn btn-default btn-med">
            <span class="glyphicon glyphicon-remove"></span> Remove Task(s)
          </button>
        </div>
		  <div id="mainContainer" style="display:table; margin:0 auto; float:none; width:60%" class="well">
		  	<div id="TaskList" class="list-group">
		    <!--<a href="#" class="list-group-item">
		    	<h4 class="list-group-item-heading">
		    	<table width="100%">
		    		<td><input type="checkbox">  Task 1</td>
		    		<td style="text-align:center;">Due Date: 03/16/2014</td>
		    		<td style="text-align:right;">Priority: <span class="glyphicon glyphicon-arrow-down"></span></td>
		    	</table>
		    	</h4>
		    </a>
		    <a href="#" class="list-group-item">
				<h4 class="list-group-item-heading">
				<table width="100%">
					<td><input type="checkbox">  Task 2</td>
					<td style="text-align:center;">Due Date: 03/16/2014</td>
					<td style="text-align:right;">Priority: <span class="glyphicon glyphicon-arrow-up"></span></td>
				</table>
				</h4>
		    </a>
		    <a href="#" class="list-group-item">
				<h4 class="list-group-item-heading">
				<table width="100%">
					<td><input type="checkbox">  Task 3</td>
					<td style="text-align:center;">Due Date: 03/16/2014</td>
					<td style="text-align:right;">Priority: <span class="glyphicon glyphicon-exclamation-sign"></span></td>
				</table>
				</h4>
		    </a>-->
		  	</div>
		  </div>

          </div>

        </div>
		<script>
				
			function DisplayPopup(){
				$("#pop-up").show();
				var pop = document.getElementById("pop-up");
				pop.style.zIndex = 10;
			}
			function HidePopup(){
				$("#pop-up").hide();
				clearTaskData();
			}
			function DisplaySelectedPopup(){
				$("#SelectedPopup").show();
				var pop = document.getElementById("SelectedPopup");
				pop.style.zIndex = 10;    
			}
			function HideSelectedPopup(){
				$("#SelectedPopup").hide();
						}
			function clearTaskData(){
				$("#TaskTitle").val("");
				$("#TaskDes").val("");
				$("#FinishBy").val("");
			}
			function EditPopup(task){
				var myDataRef = new Firebase("https://burning-fire-7708.firebaseio.com/tasks/" + task + "/");
				myDataRef.on("value", function(snapshot){
					var title = snapshot.val().Title;
					var TaskPri = snapshot.val().Priority;
					var IssuedTo = snapshot.val().To;
					var IssuedBy = snapshot.val().By;
					var FinishBy = snapshot.val().FinishDate;
					var TaskDes = snapshot.val().Description;
					$("#selTaskTitle").val(title);
					$("#selTaskTitle").attr("disable", "disable");
					$("#selTaskDes").text(TaskDes);
					$("#selIssuedTo").text(IssuedTo);
					$("#selIssuedBy").text(IssuedBy);
					$("#selFinishBy").val(FinishBy);
					$("#selFinishBy").attr("disable", "disable");
					$("#selPriority").text(TaskPri);
				});
				DisplaySelectedPopup();
			}
		</script>
		<script>
		/* 	this a prototype of how the javascript functions are going to work 
			this currently uses firebase as a way to track the chat, 
			which will only work for our chat for our group.
			This will be in place till we have a database in place.
		*/

			var myDataRefUsers = new Firebase("https://burning-fire-7708.firebaseio.com/users");
			var myDataRefTasks = new Firebase("https://burning-fire-7708.firebaseio.com/tasks");
			
			$("#btnComplete").click(function(){
			
				var validateSuccess = validatePopUp(document.getElementsByName("popItem"));
				//myDataRefTasks.push({Title: TaskTitle, Priority: TaskPri, To: IssuedTo, By: IssuedBy, FinishDate: FinishBy, Description: TaskDes});
				if (validateSuccess == 0)
				{
					HidePopup();
					clearTaskData();
				}
			});
			
			myDataRefUsers.on("child_added", function(snapshot){
				var data = snapshot.val();
				data += " ";
				document.getElementById("IssuedTo").innerHTML += ("<option>" + data + "</option>");
				document.getElementById("IssuedBy").innerHTML += ("<option>" + data + "</option>");
			});
			
			myDataRefTasks.on("child_added", function(snapshot){
				var data = snapshot.val();
				document.getElementById("TaskList").innerHTML += (
				"<a href="#" class="list-group-item">" +
					"<h4 class="list-group-item-heading">" +
					"<table width="100%">" +
						"<td name="TaskTitle" style="width:200px;" size="15";><input type="checkbox"> " + data.Title + "</td>" +
						"<td style="width:200px;text-align:right" onclick="EditPopup(" + """ + snapshot.name() + """ + ")" >" + "Due: " + data.FinishDate +"</td>" +
						"<td style="width:200px; text-align:center" onclick="EditPopup(" + """ + snapshot.name() + """ + ")" >To: " + data.To + "</td>" +
						"<td style="width:150px; text-align:right" onclick="EditPopup(" + """ + snapshot.name() + """ + ")" >Priority: " + data.Priority + "</td>" +
					"</table>" +
					"</h4>" +
				"</a>");
			});
    	
    </script>';
	
	require "includes/footer.php";
?>