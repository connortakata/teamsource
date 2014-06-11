<?php
require "../../includes/userAuth.php";
require "../../functions/indexFunctions.php";
require "../../functions/mysqlFunctions.php";
if(isLoggedIn()&&isInTeam())
{
    $teamID = $_SESSION["team"];
    getTeamChat($teamID);
}
else
    header("Location:../../index.php");