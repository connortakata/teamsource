<?php
	if(isset($_COOKIE['id']))
	{
        $mysqli = new mysqli("localhost", "root", "", "teamsource");
		$stmt =$mysqli->prepare("UPDATE task SET TASK_IS_FINISHED = ? WHERE ID = ?");
		$stmt->bind_param("si", $finished, $fid);
	    if (mysqli_connect_errno())
	        {
	            echo "Failed to connect to MySQL: " . mysqli_connect_error();
	        }    
	        
	    $fid = $_REQUEST['id'];
	    $finished = $_REQUEST['finished'];
		
		//mysqli_query($con, "UPDATE task SET TASK_IS_FINISHED = $finished WHERE ID = $id;"); 
		$stmt->execute();      
	    $mysqli->close();
	}