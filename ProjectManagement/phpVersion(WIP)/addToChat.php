<?php 
    
    $con = mysqli_connect("localhost", "root", "", "chat");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
    
    $user = $_REQUEST['user'];
    $message = $_REQUEST['message'];
    $timestamp = $_REQUEST['TimeStamp']; 
    
	mysqli_query($con, "INSERT INTO mychat ( Message, UserName, TimpStamp) VALUES ('$message', '$user', '$timestamp' );");       
    mysqli_close($con);    
?>
