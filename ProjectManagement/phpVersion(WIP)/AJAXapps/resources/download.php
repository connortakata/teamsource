<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $teamID = $_POST["teamID"];
    $fileName = $_POST["fileName"];
    header("Content-Disposition: attachment; filename=\"../../upload/".$teamID."/".$fileName."\"");
}
else
    header("Location:../../index.php");
