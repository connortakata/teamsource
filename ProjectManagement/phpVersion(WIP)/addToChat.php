<?php 
    
    $con = mysqli_connect(localhost, "", "", chat);

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
    
    $user = $_REQUEST['user'];
    $message = $_REQUEST['message'];
    $timestamp = $_REQUEST['timestamp']; 
    
	mysqli_query($con, "INSERT INTO myChat ( Message, UserName, TimpStamp) VALUES (" . 
	$message . ", " . $user . ", " . $timestamp . ");");       
    
    mysqli_close($con);    
?>
