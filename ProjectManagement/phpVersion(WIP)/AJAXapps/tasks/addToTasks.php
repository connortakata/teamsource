<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    //Select the team's task manager to identify with
    $teamID = $_SESSION["team"];
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $sql = "SELECT ID FROM TASK_MANAGER WHERE TASK_MANAGER_TEAM_ID='$teamID'";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $taskManID = $row[0];
    }

    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");

    $stmt= $mysqli->prepare("INSERT INTO task ( TASK_TASK_MANAGER_ID, TASK_TITLE, TASK_DESCRIPTION, TASK_DUE_DATE, TASK_PRIORITY, TASK_ASSIGNED_TO, TASK_ISSUED_BY, TASK_IS_FINISHED) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param('issssssi', $taskManID, $title, $description, $dueDate, $priority, $to, $by, $finished);

    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $dueDate = $_REQUEST['dueDate'];
    $priority = $_REQUEST['priority'];
    $to = $_REQUEST['toWhom'];
    $by = $_REQUEST['byWhom'];
    $finished = $_REQUEST['finished'];
    $stmt->execute();
    //$stmt->close();
    //mysqli_query($con, "INSERT INTO task (TASK_TITLE, TASK_DESCRIPTION, TASK_DUE_DATE, TASK_PRIORITY, TASK_ASSIGNED_TO, TASK_ISSUED_BY, TASK_IS_FINISHED) VALUES ('$title', '$description', '$dueDate', '$priority', '$to', '$by', $finished);");

    $mysqli->close();
	}
else
    header("Location:../../index.php");
