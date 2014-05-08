<?php
if(isset($_POST["title"]) && isset($_POST["date"]) && isset($_POST["description"]))
{
    $title=$_POST["title"];
    $date=$_POST["date"];
    $description=$_POST["description"];

    $con = mysqli_connect("localhost", "root", "", "teamsource");
    $sql = "INSERT INTO EVENT (EVENT_CALENDAR_ID, EVENT_TITLE, EVENT_DATE, EVENT_DESCRIPTION) VALUES ('0','$title', '$date', '$description');";
    mysqli_close($con);
}