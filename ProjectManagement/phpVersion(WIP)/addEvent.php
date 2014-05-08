<?php

    $title=$_POST["title"];
    $date=$_POST["date"];
    $time=$_POST["time"];
    $datetime = $date . " " . $time;
    $description=$_POST["description"];

    $con = mysqli_connect("localhost", "root", "", "teamsource");
    $sql = "INSERT INTO EVENT (EVENT_CALENDAR_ID, EVENT_TITLE, EVENT_DATE, EVENT_DESCRIPTION) VALUES ('0','$title', '$date', '$description');";
    mysqli_query($con, $sql);
    mysqli_close($con);
