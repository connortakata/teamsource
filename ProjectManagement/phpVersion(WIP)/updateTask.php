<?php
	$con = mysqli_connect("localhost", "root", "", "chat");

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
    
	mysqli_query($con, "UPDATE mytasks SET title = '$title' , description = '$description', dueDate = '$dueDate', priority = '$priority', toWhom = '$to', byWhom = '$by' WHERE id = $id;");       
    mysqli_close($con); 
?>