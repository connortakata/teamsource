<?php 
    
    $con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
    
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $dueDate = $_REQUEST['dueDate'];
    $priority = $_REQUEST['priority'];
    $to = $_REQUEST['toWhom'];
    $by = $_REQUEST['byWhom']; 
    $finished = $_REQUEST['finished'];
    
	mysqli_query($con, "INSERT INTO task ( TASK_TITLE, TASK_DESCRIPTION, TASK_DUE_DATE, TASK_PRIORITY, TASK_ASSIGNED_TO, TASK_ISSUED_BY, TASK_IS_FINISHED) VALUES ('$title', '$description', '$dueDate', '$priority', '$to', '$by', $finished);");       
    
    mysqli_close($con);    
?>