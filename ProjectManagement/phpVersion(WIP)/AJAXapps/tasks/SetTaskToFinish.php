<?php
	session_start();
	if(isset($_SESSION['id']))
	{

        $mysqli = new mysqli("localhost", "root", "", "teamsource");
		$stmt =$mysqli->prepare("UPDATE task SET TASK_IS_FINISHED = ? WHERE ID = ?");
		$stmt->bind_param("si", $fin, $fid);

	    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
    	
	    $fid = $_REQUEST['id'];
	    $fin = $_REQUEST['Finished'];		
		//mysqli_query($con, "UPDATE task SET TASK_IS_FINISHED = $finished WHERE ID = $id;"); 
		$stmt->execute();      
	    $mysqli->close();
	}
?>