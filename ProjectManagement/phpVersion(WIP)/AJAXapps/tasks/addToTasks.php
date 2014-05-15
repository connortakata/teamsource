<?php
session_start();
    if(isset($_SESSION['id']))
    {
        $mysqli = new mysqli("localhost", "root", "", "teamsource");
	
	    if (mysqli_connect_errno())
	        {
	            echo "Failed to connect to MySQL: " . mysqli_connect_error();
	        }    
	    $stmt= $mysqli->prepare("INSERT INTO task ( TASK_TITLE, TASK_DESCRIPTION, TASK_DUE_DATE, TASK_PRIORITY, TASK_ASSIGNED_TO, TASK_ISSUED_BY, TASK_IS_FINISHED) VALUES (?, ?, ?, ?, ?, ?, ?);");
	    $stmt->bind_param('ssssssi', $title, $description, $dueDate, $priority, $to, $by, $finished);
	    
	    $title = $_REQUEST['title'];
	    $description = $_REQUEST['description'];
	    $dueDate = $_REQUEST['dueDate'];
	    $priority = $_REQUEST['priority'];
	    $to = $_REQUEST['toWhom'];
	    $by = $_REQUEST['byWhom']; 
	    $finished = $_REQUEST['finished'];
	    $stmt->execute();
	  	//$stmt->close();
		//mysqli_query($con, "INSERT INTO task (TASK_TITLE, TASK_DESCRIPTION, TASK_DUE_DATE, TASK_PRIORITY, TASK_ASSIGNED_TO, TASK_ISSUED_BY, TASK_IS_FINISHED) VALUES ('$title', '$description', '$dueDate', '$priority', '$to', '$by', $finished);");       

        $mysqli->close();
	}
