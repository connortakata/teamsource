<?php
require "../../includes/userAuth.php";

if(isLoggedIn())
{
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    if(isset($_POST["id"])&&$_POST["id"]==true)
    {
        $stmt= $mysqli->prepare("UPDATE EVENT SET EVENT_TITLE=?, EVENT_DATETIME=?, EVENT_DESCRIPTION=? WHERE ID=?");
        $stmt->bind_param('sssi', $title, $date, $description, $id);
        $id=$_POST["id"];
    }
    else
    {
        $stmt= $mysqli->prepare("INSERT INTO EVENT (EVENT_CALENDAR_ID, EVENT_TITLE, EVENT_DATETIME, EVENT_DESCRIPTION) VALUES (?,?,?,?);");
        $stmt->bind_param('isss', $calID, $title, $date, $description);
        $calID=0;
    }
    $title=$_POST["title"];
    $date=$_POST["date"];
    $theTime=$_POST["theTime"];
    $description=$_POST["description"];

    $theTime = substr_replace($theTime, ":", 2, 0);
    if($_POST["edit"])
    {
        $date = $date." ".$theTime;
        $theTime = substr_replace($theTime, ":", 2, 0);
    }
    else
        $date = $date." ".$theTime.":00";
    $stmt->execute();
    $mysqli->close();
}
else
    header("Location:../../index.php");