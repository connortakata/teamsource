<?php
require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";
require "functions/teamFunctions.php";

print'
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Manage Teams</h1>
    <div align="left" style="display:table; width:95%; height: 500px; margin-right: 25px;" class="well">
        <div class="panel panel-primary">';

$teamCount = countTeams();

if(!isset($teamCount)||$teamCount<1)
{
    //If user belongs to no teams or something weird happened
    print'      <div class="panel-heading">It seems you are not part of a team yet.</div>
                    <div class="panel-body" style="height: 400px;">
                        To use the site, either create a team to become the manager of or ask another manager to add you to their team.</br></br>';
}
else if($teamCount>0)
{
    //If user belongs to team(s)
    printTeamSelector();
}
print                 '<div class="col-lg-6" style="padding-left: 0;"></br>';
if(isManager())
{//If the user is a manager they may add users to the team
    print '
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button id="AddUserToTeamButton" class="btn btn-default" type="button" onclick="AddUserToTeam();" style="padding-right: 26px;">Add a user</button>
                                </span>
                                <input id="AddUserToTeam" type="text" placeholder="User email" onkeydown="if (event.keyCode == 13) document.getElementById(\'AddUserToTeamButton\').click()" class="form-control">
                            </div><!-- /input-group -->';
    if(isset($_SESSION["errorNoUserFound"])&&$_SESSION["errorNoUserFound"])
    {
        print '<p>Error: No user found with that email address.</p>';
        unset($_SESSION["errorNoUserFound"]);
    }
    else if(isset($_SESSION["successUserAdded"])&&$_SESSION["successUserAdded"])
    {
        print '<p>Success! The user has been added to your team.</p>';
        unset($_SESSION["successUserAdded"]);
    }
    else
        print '</br>';
}

print'
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button id="CreateTeamButton" class="btn btn-default" type="button" onclick="AddTeam()">Create Team</button>
                            </span>
                            <input id="CreateTeamName" type="text" placeholder="Team Name" class="form-control" onkeydown="if (event.keyCode == 13) document.getElementById(\'CreateTeamButton\').click()">
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!--/panel-body-->
            </div><!--/panel-->
        </div><!--/well-->
</div>
<script src="js/AJAX_lib.js"/>
';

require "includes/footer.php";