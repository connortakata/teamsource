<?php 
    
    $con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
    
    $user = $_REQUEST['user'];
    $message = $_REQUEST['message'];
    //$timestamp = $_REQUEST['TimeStamp'];
    $timestamp = date('H:i:s');
    $date = date('Y-m-d');
    
    mysqli_query($con, "INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME, MESSAGE_DATE, MESSAGE_MESSAGE_BOARD_ID) VALUES ('$message', '$user', '$timestamp', '$date', '20' )");
	//mysqli_query($con, "INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME) VALUES ('$message', '$user', '$timestamp' );");
    mysqli_close($con);    
?>
