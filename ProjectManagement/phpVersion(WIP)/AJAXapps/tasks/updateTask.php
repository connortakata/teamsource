<?php
	$con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
        
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $dueDate = $_REQUEST['dueDate'];
    $priority = $_REQUEST['priority'];
    $to = $_REQUEST['toWhom'];
    $by = $_REQUEST['byWhom']; 
    
	mysqli_query($con, "UPDATE task SET TASK_TITLE = 'addSlashes($title)' , TASK_DESCRIPTION = 'addSlashes($description)', TASK_DUE_DATE = '$dueDate', TASK_PRIORITY = '$priority', TASK_ASSIGNED_TO = '$to', TASK_ISSUED_BY = '$by' WHERE ID = $id;");       
    mysqli_close($con); 
?>