<?php
	$con = mysqli_connect("localhost", "root", "", "chat");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	$id = $_REQUEST['id'];
	mysqli_select_db($con, "chat");
	$sql = "SELECT * FROM mytasks WHERE id =" . $id . ";";
	
	$result = mysqli_query($con, $sql);
		
	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="well" style="width:100%; height:auto;">';
		echo '	<div class="panel panel-primary" style="height:auto">';
		echo '	  <div class="panel-heading">';
		echo '			<input id="selTaskTitle" type="text" value="'. $row['title'] .'" class="form-control" disabled="disabled" placeholder="Task Title">';			    
		echo '		  </div>';
		echo '		  <div class="panel-body">';	
		echo '			Task Issued By: <label id="selIssuedBy">' . $row['toWhom'] . '</label><br><br>';
		echo '			Finish By: ' . $row['dueDate'] . '<br><br>';
		echo '			Issued To: <label id="selIssuedTo">' . $row['toWhom'] . '</label><br><br>';
		echo '			Priority: <label id="selPriority">' . $row['priority'] . '</label><br><br>';
		echo '			Task Description: <br>';
		echo '			<div class="panel-info">';
		echo '				<label id="selTaskDes" rows="5" class="form-control" style="height:50%; width:100%;">' . $row['description'] . '</label>';
		echo '			</div>';
		echo '			<div class="btn-group">';
		echo '			  <button id="btnSelComplete" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-ok"></span> Complete</button>';
		echo '			  <button id="btnSelEdit" type="button" class="btn btn-default" onclick="HideSelectedPopup()"><span class="glyphicon glyphicon-wrench"></span> Edit</button>';
		echo '			  <button id="btnSelDelete" type="button" class="btn btn-default" onclick="HideSelectedPopup()"><span class="glyphicon glyphicon-remove"></span> Delete</button>';
		echo '			</div>';
		echo '	  </div>';
		echo '	</div>';
		echo '</div>';
	}    
?>