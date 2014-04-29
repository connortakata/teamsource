<?php 
    
    $con = mysqli_connect("localhost", "root", "", "root");

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
    
	mysqli_query($con, "INSERT INTO mytasks ( title, description, dueDate, priority, toWhom, byWhom) VALUES ('$title', '$description', '$dueDate', '$priority', '$to', '$by');");       
    
    mysqli_close($con);    
?>
