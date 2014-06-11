<?php
function getTeamSubId($teamID, $table)
{
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    if($table=="MESSAGE")
    {
        $stmt= $mysqli->prepare("SELECT ID FROM MESSAGEBOARD WHERE MESSAGE_BOARD_TEAM_ID='$teamID'");
    }
    else if($table=="EVENT")
    {
        $stmt= $mysqli->prepare("SELECT ID FROM CALENDAR WHERE CALENDAR_TEAM_ID='$teamID'");
    }
    else if($table=="FILE")
    {
        $stmt= $mysqli->prepare("SELECT ID FROM FILEMANAGER WHERE FILE_MANAGER_TEAM_ID='$teamID'");
    }
    else if($table=="TASK")
    {
        $stmt= $mysqli->prepare("SELECT ID FROM TASK_MANAGER WHERE TASK_MANAGER_TEAM_ID='$teamID'");
    }
    $stmt->execute();
    $res = $stmt->get_result();
    $fileID = $res->fetch_assoc();
    $fileID = $fileID["ID"];
    $mysqli->close();
    return $fileID;
}

function getTeamName($teamID)
{
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT TEAM_NAME FROM TEAM WHERE ID='$teamID'");
    $stmt->execute();
    $res = $stmt->get_result();
    $teamName = $res->fetch_assoc();
    $teamName = $teamName["TEAM_NAME"];
    $mysqli->close();
    return $teamName;
}