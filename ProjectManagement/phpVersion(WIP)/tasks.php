<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
			<div id="pop-up" class="PopupShadow" style="display:none; position:fixed; top:150px; left:27%; width:600px; height:auto;">
			<div class="well" style="width:100%; height:auto;">
				<div class="panel panel-primary" style="height:auto">
				  <div class="panel-heading">
					<input name="popItem" id="TaskTitle" type="text" class="form-control" placeholder="Task Title">			    
				  </div>
				  <div class="panel-body">
			
					Task Issued By: <Label><input type="hidden" name="popItem" id="IssuedBy" value="';
					$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");

				    if (mysqli_connect_errno())
			        {
			            echo "Failed to connect to MySQL: " . mysqli_connect_error();
			        }    
   					$Current_User_SQL = "SELECT USER_FIRSTNAME FROM user WHERE ID = '$id'";
					$User = mysqli_query($con, $Current_User_SQL); 
					while($row = mysqli_fetch_array($User))
					{
						echo $row['USER_FIRSTNAME'] . '"/>'. $row['USER_FIRSTNAME'];
					}					
					print '</label><br><br>
					Finish By: <input name="popItem" id="FinishBy" type="date" style="height:25px"/><br><br>
					Issued To: <select name="popItem" id="IssuedTo">';
					
					$sql = "SELECT * FROM user;";
					$result = mysqli_query($con, $sql);
					
					while($row = mysqli_fetch_array($result))
					{
						echo'<option>' . $row['USER_FIRSTNAME'] . '</option>'; 
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
		<div id="SelectedPopup" class="PopupShadow" style="display:none; position:fixed; top:150px; left:27%; width:600px; height:auto;">
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
          <!--<button type="button" class="btn btn-default btn-med">
            <span class="glyphicon glyphicon-remove"></span> Remove Task(s)
          </button>-->
          <select class="btn btn-default" onchange="SwitchDisplayedTasks(this)">
          	<option value="0">Active</option>
          	<option value="1">Finished</option>
          </select>
        </div>
		  <div id="mainContainer" style="display:table; margin:0 auto; float:none; width:60%" class="well">
		  	<div id="TaskList" class="list-group">';
		  	
   				$sql = "SELECT * FROM task where TASK_IS_FINISHED = 0 ORDER BY TASK_DUE_DATE ASC;";
				$result = mysqli_query($con, $sql);

		    	while($row = mysqli_fetch_array($result))
				{
						echo "<a href='#' class='list-group-item'>";
			       		echo	"<h4 class='list-group-item-heading'>"; 
					    echo	"<table width='100%'>";
					    echo		"<td name='TaskTitle' style='width:200px;' size='15';><input type='checkbox'> " . $row['TASK_TITLE'] . "</td>";
					    echo	    "<td style='width:200px;text-align:right' onclick='EditPopup(" .  $row['ID'] . ")' > Due: " . $row['TASK_DUE_DATE'] ."</td>";
					    echo		"<td style='width:200px; text-align:center' onclick='EditPopup(" . $row['ID'] . ")' >To: " . $row['TASK_ASSIGNED_TO'] . "</td>";
					    echo		"<td style='width:150px; text-align:right' onclick='EditPopup(" . $row['ID']  . ")' >Priority: " . $row['TASK_PRIORITY'] . "</td>";
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
    		$(\'#SelectedPopup\').show();
    		var pop = document.getElementById("SelectedPopup");
    		pop.style.zIndex = 10;    
    	}
    	function HideSelectedPopup(){
    		$(\'#SelectedPopup\').hide();
    		    	}
    	function clearTaskData(){
    		$(\'#TaskTitle\').val("");
    		$(\'#TaskDes\').val("");
    		$(\'#FinishBy\').val("");
    	}
    </script>
    <script>
    /* 	this a prototype of how the javascript functions are going to work 
     	this currently uses firebase as a way to track the chat, 
    	which will only work for our chat for our group.
    	This will be in place till we have a database in place.
    */
    	
    	$(\'#btnComplete\').click(function(){
    	
    		var validateSuccess = validatePopUp(document.getElementsByName("popItem"));
       		if (validateSuccess == 0)
    		{
    			HidePopup();
    			clearTaskData();
    			location.reload();
    		}
    	});
    	    	    	
    </script>';
	
	require "includes/footer.php";
?>