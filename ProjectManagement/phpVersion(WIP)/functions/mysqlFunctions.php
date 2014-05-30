<?php
function getTeamSubId($teamID, $table)
{
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    if($table=="MESSAGE")
    {
        $sql = "SELECT ID FROM MESSAGEBOARD WHERE MESSAGE_BOARD_TEAM_ID='$teamID'";
    }
    else if($table=="EVENT")
    {
        $sql = "SELECT ID FROM CALENDAR WHERE CALENDAR_TEAM_ID='$teamID'";
    }
    else if($table=="FILE")
    {
        $sql = "SELECT ID FROM FILEMANAGER WHERE FILE_MANAGER_TEAM_ID='$teamID'";
    }
    else if($table=="TASK")
    {
        $sql = "SELECT ID FROM TASK_MANAGER WHERE TASK_MANAGER_TEAM_ID='$teamID'";
    }
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $fileID = $row[0];
    }
    return $fileID;
}

function getTeamName($teamID)
{
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $sql = "SELECT TEAM_NAME FROM TEAM WHERE ID='$teamID'";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $teamName = $row[0];
    }
    return $teamName;
}