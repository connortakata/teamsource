<?php
	$con = mysqli_connect("localhost", "root", "", "chat");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	$id = $_REQUEST['id'];
	
	mysqli_select_db($con, "chat");
	$query = "SELECT * FROM users;";
	$sql = "SELECT * FROM mytasks WHERE id =" . $id . ";";
	$userResult = mysqli_query($con, $query);
	$result = mysqli_query($con, $sql);
	$users = array();
	while($userRow = mysqli_fetch_array($userResult))
	{
		$users[] = $userRow['name'];
	}
		
	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="well" style="width:100%; height:auto;">';
		echo '	<div class="panel panel-primary" style="height:auto">';
		echo '	  <div class="panel-heading">';
		echo '			<input name="EditTaskItem" id="selTaskTitle" type="text" value="'. $row['title'] .'" class="form-control" placeholder="Task Title">';			    
		echo '		  </div>';
		echo '		  <div class="panel-body">';	
		echo '			Task Issued By: <select name="EditTaskItem" id="selIssuedBy">';
					for($x = 0; $x < count($users); $x++)
					{
						echo ' //test';
						 if ( $row['byWhom'] == $users[$x])
						 {
						 	echo ' <option selected> ' . $users[$x] . ' </option>';
						 }
						 else
						 {
						 	echo ' <option> ' . $users[$x] . '</option>';
						 }
					} 
		echo '							</select><br><br>';
		echo '			Finish By: <input name="EditTaskItem" type="date" style="height:25px" value="' . $row['dueDate'] . '"/><br><br>';
		echo '			Issued To: <select name="EditTaskItem" id="selIssuedTo">';
		 			for ($y = 0; $y < count($users); $y++)
		 			{ 
		 				if ( $row['toWhom'] == $users[$y])
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
		 				if($row['priority'] == $priorities[$z])
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
		echo '				<textarea name="EditTaskItem" id="selTaskDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;" >'. $row['description'] . '</textarea>'; 
		echo '			</div>';
		echo '			<div class="btn-group">';
		echo '			  <button id="btnSelComplete" type="button" class="btn btn-default" onclick="UpdateTask(document.getElementsByName(\'EditTaskItem\'), '. $id .'); location.reload();"><span class="glyphicon glyphicon-ok"></span> Save</button>';
		echo '			  <button id="btnSelDelete" type="button" class="btn btn-default" onclick="HideSelectedPopup()"><span class="glyphicon glyphicon-remove"></span>Cancel </button>';
		echo '			</div>';
		echo '	  </div>';
		echo '	</div>';
		echo '</div>';
	}    
?>