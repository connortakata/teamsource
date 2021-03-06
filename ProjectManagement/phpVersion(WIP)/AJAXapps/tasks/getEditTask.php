<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
	$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	$id = $_REQUEST['id'];
    $teamID = $_SESSION["team"];
    //Assign task to someone on your team
    $sql = "SELECT USER_FIRSTNAME
            FROM USER
            INNER JOIN TEAM_MEMBER_LIST
            ON USER.ID=TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID
            WHERE TEAM_MEMBER_LIST_TEAM_ID='$teamID'";
    $userResult = mysqli_query($con, $sql);

	$sql = "SELECT * FROM task WHERE id =" . $id . ";";
	$result = mysqli_query($con, $sql);
	$users = array();
	while($userRow = mysqli_fetch_array($userResult))
	{
		$users[] = $userRow['USER_FIRSTNAME'];
	}
		
	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="well" style="width:100%; height:auto;">';
		echo '	<div class="panel panel-primary" style="height:auto">';
		echo '	  <div class="panel-heading">';
		echo '			<input name="EditTaskItem" id="selTaskTitle" type="text" value="'. $row['TASK_TITLE'] .'" class="form-control" placeholder="Task Title">';			    
		echo '		  </div>';
		echo '		  <div class="panel-body">';	
		echo '			Issued by:<Label><input type="hidden" name="EditTaskItem" id="selIssuedBy" value="';
						echo  $row['TASK_ISSUED_BY'] . '"/>' . $row['TASK_ISSUED_BY'];
						echo '	</Label><br><br>';
		echo '			Finish By: <input name="EditTaskItem" type="date" max="9999-12-31" style="height:25px" value="' . $row['TASK_DUE_DATE'] . '"/><br><br>';
		echo '			Issued To: <select name="EditTaskItem" id="selIssuedTo">';
		 			for ($y = 0; $y < count($users); $y++)
		 			{ 
		 				if ( $row['TASK_ASSIGNED_TO'] == $users[$y])
						 {
						 	echo ' <option selected> ' . $users[$y] . ' </option>';
						 }
						 else
						 {
						 	echo ' <option> ' . $users[$y] . '</option>';
						 }
		 			} 
		echo 						'</select><br><br>';
		echo '			Priority: <select name="EditTaskItem" "id="selPriority">';
		 			$priorities = array("High", "Medium", "Low");
		 			for($z = 0; $z < count($priorities); $z++)
		 			{ 
		 				if($row['TASK_PRIORITY'] == $priorities[$z])
		 				{
		 					echo ' <option selected>' . $priorities[$z] . ' </option>';
		 				} 
		 				else
		 				{
		 					echo ' <option> ' . $priorities[$z] . ' </option> ';
		 				}
		 			}
		echo					 '</select><br><br>';
		echo '			Task Description: <br>';
		echo '			<div class="panel-info">';
		echo '				<textarea name="EditTaskItem" id="selTaskDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;" >'. $row['TASK_DESCRIPTION'] . '</textarea>'; 
		echo '			</div>';
		echo '			<div class="btn-group">';
		echo '			  <button id="btnSelComplete" type="button" class="btn btn-default" onclick="UpdateTask(document.getElementsByName(\'EditTaskItem\'), '. $id .'); location.reload();"><span class="glyphicon glyphicon-ok"></span> Save</button>';
		echo '			  <button id="btnSelDelete" type="button" class="btn btn-default" onclick="HideSelectedPopup()"><span class="glyphicon glyphicon-remove"></span>Cancel </button>';
		echo '			</div>';
		echo '	  </div>';
		echo '	</div>';
		echo '</div>';
	}
}
else
    header("Location:../../index.php");