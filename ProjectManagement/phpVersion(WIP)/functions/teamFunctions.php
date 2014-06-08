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
                    <div class="panel-body" style="height: 400px;">
                        Please select a team to use or create a new team.</br></br>Team(s):</br>
                        <ul class="nav nav-pills nav-stacked" style="width: 50%">';
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
    print '</ul>';
    $mysqli->close();
}