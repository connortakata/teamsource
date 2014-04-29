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
			
					Task Issued By: <select name="popItem" id="IssuedBy">';
					$con = mysqli_connect("localhost", "root", "", "root");

				    if (mysqli_connect_errno())
			        {
			            echo "Failed to connect to MySQL: " . mysqli_connect_error();
			        }    
    				mysqli_select_db($con, "chat");
					$sql = "SELECT * FROM users;";
					$result = mysqli_query($con, $sql);
	
			    	while($row = mysqli_fetch_array($result))
					{
						echo'<option>' . $row['name'] . '</option>'; 
					}
					
					print'</select><br><br>
					Finish By: <input name="popItem" id="FinishBy" type="date" style="height:25px"/><br><br>
					Issued To: <select name="popItem" id="IssuedTo">';
					
					mysqli_select_db($con, "root");
					$sql = "SELECT * FROM users;";
					$result = mysqli_query($con, $sql);
					
					while($row = mysqli_fetch_array($result))
					{
						echo'<option>' . $row['name'] . '</option>'; 
					}

					
					print'</select><br><br>
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
		<div id="EditPopup" class="PopupShadow" style="display:none; position:fixed; top:150px; left:20%; width:600px; height:auto;">
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
              <button id="btnComplete" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-ok"></span> Submit</button>
              <button id="btnDelete" type="button" class="btn btn-default" onclick="HidePopup()"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
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
		  	<div id="TaskList" class="list-group">';
		  	
   				$sql = "SELECT * FROM mytasks;";
				$result = mysqli_query($con, $sql);

		    	while($row = mysqli_fetch_array($result))
				{
						echo "<a href='#' class='list-group-item'>";
			       		echo	"<h4 class='list-group-item-heading'>"; 
					    echo	"<table width='100%'>";
					    echo		"<td name='TaskTitle' style='width:200px;' size='15';><input type='checkbox'> " . $row['title'] . "</td>";
					    echo	    "<td style='width:200px;text-align:right' onclick='EditPopup(" .  $row['id'] . ")' > Due: " . $row['dueDate'] ."</td>";
					    echo		"<td style='width:200px; text-align:center' onclick='EditPopup(" . $row['id'] . ")' >To: " . $row['toWhom'] . "</td>";
					    echo		"<td style='width:150px; text-align:right' onclick='EditPopup(" . $row['id']  . ")' >Priority: " . $row['priority'] . "</td>";
					    echo	"</table>";
					    echo	"</h4>";
					    echo "</a>";	
				}
			mysqli_close($con); 
				
		print	' 	
			</div>
		  </div>

          </div>

        </div>
		<script src="js/tasks.js"></script>';
	require "includes/footer.php";
?>