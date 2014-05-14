<?php 
    if (isset($_COOKIE['id']))
    {
	    $con = mysqli_connect("localhost", "root", "", "teamsource");
		$stmt = $con->prepare("INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME, MESSAGE_DATE, MESSAGE_MESSAGE_BOARD_ID) VALUES (?, ?, ?, ?, 20 )");
		$stmt->bind_param("siss", $message, $user, $timestamp, $date);
	    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	    $user = $_COOKIE['id'];
	    $message = $_REQUEST['message'];
	    //$timestamp = $_REQUEST['TimeStamp'];
	    $timestamp = date('H:i:s');
	    $date = date('Y-m-d');
	    $stmt->execute();
	    //mysqli_query($con, "INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME, MESSAGE_DATE, MESSAGE_MESSAGE_BOARD_ID) VALUES ('$message', '$user', '$timestamp', '$date', '20' )");
		//mysqli_query($con, "INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME) VALUES ('$message', '$user', '$timestamp' );");
	    mysqli_close($con);
	}
?>
