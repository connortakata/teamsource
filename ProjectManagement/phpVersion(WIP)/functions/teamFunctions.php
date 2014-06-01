<?php
function countTeams()
{
    $userID =  $_SESSION["id"];
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $sql = "SELECT COUNT(*) FROM TEAM_MEMBER_LIST WHERE TEAM_MEMBER_LIST_USER_ID='$userID';";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $teamCount = $row[0];
    }
    return $teamCount;
}

function printTeamSelector()
{
    print'      <div class="panel-heading">Welcome Back!</div>
                    <div class="panel-body" style="height: 100%;">
                    <div class="col-lg-6" style="padding-left: 0;width: 400px"></br>
                        Please select a team to use or create a new team.</br></br>Team(s):</br>
                        <ul class="nav nav-pills nav-stacked">';
    $id = $_SESSION["id"];
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT TEAM_NAME, ID
            FROM TEAM
            INNER JOIN TEAM_MEMBER_LIST ON TEAM.ID = TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_TEAM_ID
            WHERE TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID='$id'
            ORDER BY TEAM_NAME ASC;");
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = mysqli_fetch_array($res))
    {
        if(isset($_SESSION["team"])&&($row["ID"]==$_SESSION["team"]))
            print '<li class="active">';
        else
            print '<li>';
        print '<a href="#" onclick="SelectTeam('.$row["ID"].');">';
        print $row["TEAM_NAME"];
        print '</a></li>';
    }
    print '</ul></br>';
    $mysqli->close();
}

function printUsersInTeam()
{
    print'<div class="col-lg-6" style="padding-left: 0;width: 800px"></br>
                <div class="well" style="height: 330px; width:50%;overflow-y: scroll;">
                        Team members for current team:</br>
                        <div class="list-group" style="width: 350px">';
    if(isset($_SESSION["team"]))
    {
    $id = $_SESSION["team"];
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT USER_FIRSTNAME, USER_LASTNAME, ID
                            FROM USER
                            INNER JOIN TEAM_MEMBER_LIST
                            ON USER.ID = TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID
                            WHERE TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_TEAM_ID ='$id'
                            ORDER BY USER_LASTNAME ASC ");
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = mysqli_fetch_array($res))
    {
        if(($row["ID"]==$_SESSION["id"]))
            print '<a class="list-group-item list-group-item-info"';
        else
            print '<a class="list-group-item" ';
        if(isManager())
            print ' href="#" onclick="RemoveFromTeam('.$row["ID"].');">';
        else
            print ' >';
        print $row["USER_FIRSTNAME"].' '.$row["USER_LASTNAME"];
        if(isManager($row["ID"]))
            print ' - Manager';
        print '</a>';
    }
        $mysqli->close();
    }
    print '</div>';

}