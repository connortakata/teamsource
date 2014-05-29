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
    mysql_close();

    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    if(isset($_POST["id"])&&$_POST["id"]==true)//Are we updating a current event or adding a new one?
    {
        $stmt= $mysqli->prepare("UPDATE EVENT SET EVENT_TITLE=?, EVENT_DATETIME=?, EVENT_DESCRIPTION=? WHERE ID=?");
        $stmt->bind_param('sssi', $title, $date, $description, $id);
        $id=$_POST["id"];//In this case, we are updating a current event
    }
    else
    {
        $stmt= $mysqli->prepare("INSERT INTO EVENT (EVENT_CALENDAR_ID, EVENT_TITLE, EVENT_DATETIME, EVENT_DESCRIPTION) VALUES (?,?,?,?);");
        $stmt->bind_param('isss', $calID, $title, $date, $description);//In this case, we are adding a brand new event
    }
    $title=$_POST["title"];
    $date=$_POST["date"];
    $theTime=$_POST["theTime"];
    $description=$_POST["description"];

    $theTime = substr_replace($theTime, ":", 2, 0);
    if($_POST["edit"])//String formatting for correct insertion into mysql column of type DATETIME
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