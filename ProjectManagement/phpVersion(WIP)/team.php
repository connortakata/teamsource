<?php

require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";

print'
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Manage Teams</h1>
    <div align="left" style="display:table; width:95%; height: 500px; margin-right: 25px;" class="well">
        <div class="panel panel-primary">';
$userID =  $_SESSION["id"];
$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
$sql = "SELECT COUNT(*) FROM TEAM_MEMBER_LIST WHERE TEAM_MEMBER_LIST_USER_ID='$userID'";
$result = mysqli_query($con,$sql);
$teamCount = mysqli_fetch_array($result)[0];
if($teamCount<1)
{
    //If user belongs to no teams or something weird happened
    print'      <div class="panel-heading">It seems you are not part of a team yet.</div>
                    <div class="panel-body" style="height: 400px;">
                        To use the site, either create a team to become the manager of or ask another manager to add you to their team.</br></br>';
}
else if($teamCount>0)
{
    //If user belongs to team(s)
    print'      <div class="panel-heading">Welcome Back!</div>
                    <div class="panel-body" style="height: 400px;">
                        Please select a team to use or create a new team.</br></br>Team(s):</br>
                        <ul class="nav nav-pills nav-stacked" style="width: 50%">';

    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $id = $_SESSION["id"];
    $sql = "SELECT TEAM_NAME, ID
            FROM TEAM
            INNER JOIN TEAM_MEMBER_LIST ON TEAM.ID = TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_TEAM_ID
            WHERE TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID='$id'
            ORDER BY TEAM_NAME ASC;";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result))
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
    mysqli_close($con);
}

print'                  <div class="col-lg-6" style="padding-left: 0;">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="AddTeam()">Create Team</button>
                            </span>
                            <input id="CreateTeamName" type="text" placeholder="Team Name" class="form-control">
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!--/panel-body-->
            </div><!--/panel-->
        </div><!--/well-->
</div>
<script src="js/AJAX_lib.js"/>
';

require "includes/footer.php";