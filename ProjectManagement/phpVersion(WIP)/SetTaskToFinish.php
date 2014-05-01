<?php
	$con = mysqli_connect("localhost", "root", "", "chat");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
        
    $id = $_REQUEST['id'];
    $finished = $_REQUEST['finished']
	
	mysqli_query($con, "UPDATE tasks SET finished = $finished WHERE id = $id;");       
    mysqli_close($con); 

?>