<?php
	if(isset($_COOKIE['id'])
	{
	    $mysqli = new mysqli("localhost", "root", "", "teamsource");
	    $stmt= $mysqli->prepare("INSERT INTO EVENT (EVENT_CALENDAR_ID, EVENT_TITLE, EVENT_DATETIME, EVENT_DESCRIPTION) VALUES (?,?,?,?);");
	    $stmt->bind_param('isss', $calID, $title, $date, $description);
	
	    $calID=0;
	    $title=$_POST["title"];
	    $date=$_POST["date"];
	    $theTime=$_POST["theTime"];
	    $description=$_POST["description"];
	
	    $theTime = substr_replace($theTime, ":", 2, 0);
	    $date = $date." ".$theTime.":00";
	    $stmt->execute();
	    $mysqli->close();
	}
?>