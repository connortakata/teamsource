<?php
require "../../includes/userAuth.php";
require "../../functions/mysqlFunctions.php";
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
        $boardID=getTeamSubId($teamID,"MESSAGE");

	    $user = $_SESSION['id'];
	    $message = $_REQUEST['message'];
	    $timestamp = date('H:i:s');
	    $date = date('Y-m-d');
	    $stmt->execute();
        $mysqli->close();
}
else
    header("Location:../../index.php");