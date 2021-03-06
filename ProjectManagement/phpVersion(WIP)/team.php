<?php
require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";
require "functions/teamFunctions.php";

print'
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Manage Teams</h1>
    <div align="left" style="display:table; height: 500px; margin-right: 25px;" class="well">
        <div class="panel panel-primary" style="width: 100%;">';

$teamCount = countTeams();

if(!isset($teamCount)||$teamCount<1)
{
    //If user belongs to no teams or something weird happened
    print'      <div class="panel-heading">It seems you are not part of a team yet.</div>
                    <div class="panel-body" style="height: 400px;">
                    <div class="col-lg-6" style="padding-left: 0;"></br>
                        To use the site, either create a team to become the manager of or ask another manager to add you to their team.</br></br>';
}

else if($teamCount>0)
{
    //If user belongs to team(s)

    printTeamSelector();
}



print'
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button id="CreateTeamButton" class="btn btn-default" type="button" onclick="AddTeam()">Create Team</button>
                            </span>
                            <input id="CreateTeamName" type="text" placeholder="Team Name" class="form-control" onkeydown="if (event.keyCode == 13) document.getElementById(\'CreateTeamButton\').click()">
                        </div><!-- /input-group -->';
if(isset($_SESSION["successTeamAdded"])&&$_SESSION["successTeamAdded"])
{
    print '<p>Success! The team has been created.</p>';
    unset($_SESSION["successTeamAdded"]);
}
else if(isset($_SESSION["errorTeamExists"])&&$_SESSION["errorTeamExists"])
{
    print '<p>Error: a team by this name already exists.</p>';
    unset($_SESSION["errorTeamExists"]);
}
else if(isset($_SESSION["errorTeamGeneral"])&&$_SESSION["errorTeamGeneral"])
{
    print '<p>Error: an unknown error occurred.</p>';
    unset($_SESSION["errorTeamGeneral"]);
}
print'
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6" style="height:100%">
                    ';
printUsersInTeam();
print '
                    </br>
                    </div>
                </div><!--/panel-body-->
            </div><!--/panel-->
        </div><!--/well-->
</div>
<script src="js/AJAX_lib.js"/>
';

require "includes/footer.php";