<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
    //Select the team's calendar to identify with
    $teamID = $_SESSION["team"];
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $sql = "SELECT ID FROM CALENDAR WHERE CALENDAR_TEAM_ID='$teamID'";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $calID = $row[0];
    }

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