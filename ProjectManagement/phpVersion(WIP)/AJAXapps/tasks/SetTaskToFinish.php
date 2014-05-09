<?php
	$con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
        
    $id = $_REQUEST['id'];
    $finished = $_REQUEST['finished'];
	
	mysqli_query($con, "UPDATE task SET TASK_FINISHED = $finished WHERE ID = $id;");       
    mysqli_close($con); 

?>