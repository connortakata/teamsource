<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
		$stmt = $mysqli->prepare("INSERT INTO message ( MESSAGE_TEXT, MESSAGE_USER_ID, MESSAGE_TIME, MESSAGE_DATE, MESSAGE_MESSAGE_BOARD_ID) VALUES (?, ?, ?, ?, ? )");
		$stmt->bind_param("sissi", $message, $user, $timestamp, $date, $boardID);
        //Insertion prepared...
	    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        //Select the team's message board to identify with
        $teamID = $_SESSION["team"];
        $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
        $sql = "SELECT ID FROM MESSAGEBOARD WHERE MESSAGE_BOARD_TEAM_ID='$teamID'";
        $result = mysqli_query($con,$sql);
        $boardID = mysqli_fetch_array($result)["ID"];

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