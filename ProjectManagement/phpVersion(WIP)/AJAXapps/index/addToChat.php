<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
		$stmt = $mysqli->prepare("INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME, MESSAGE_DATE, MESSAGE_MESSAGE_BOARD_ID) VALUES (?, ?, ?, ?, ? )");
		$stmt->bind_param("sissi", $message, $user, $timestamp, $date, $boardID);

	    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $boardID=20;
	    $user = $_SESSION['id'];
	    $message = $_REQUEST['message'];
	    //$timestamp = $_REQUEST['TimeStamp'];
	    $timestamp = date('H:i:s');
	    $date = date('Y-m-d');
	    $stmt->execute();
	    //mysqli_query($con, "INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME, MESSAGE_DATE, MESSAGE_MESSAGE_BOARD_ID) VALUES ('$message', '$user', '$timestamp', '$date', '20' )");
		//mysqli_query($con, "INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME) VALUES ('$message', '$user', '$timestamp' );");
        $mysqli->close();
}
else
    header("Location:../../index.php");