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
    
	mysqli_query($con, "INSERT INTO tasks ( title, description, dueDate, priority, toWhom, byWhom, finished) VALUES ('$title', '$description', '$dueDate', '$priority', '$to', '$by', finished);");       
    
    mysqli_close($con);    
?>
