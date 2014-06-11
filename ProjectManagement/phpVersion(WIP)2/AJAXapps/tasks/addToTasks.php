<?php
require "../../includes/userAuth.php";
require "../../functions/mysqlFunctions.php";
if(isLoggedIn()&&isInTeam())
{
    //Select the team's task manager to identify with
    $teamID = $_SESSION["team"];
    $taskManID = getTeamSubId($teamID,"TASK");

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

    $mysqli->close();
	}
else
    header("Location:../../index.php");
