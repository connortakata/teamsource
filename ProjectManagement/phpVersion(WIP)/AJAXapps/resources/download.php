<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $teamID = $_GET["teamID"];
    $fileName = $_GET["fileName"];
    $fakeFileName= $fileName;
    $realFileName = $teamID."/".$fileName;

    $file = "../../upload/".$realFileName;
    $fp = fopen($file, 'r');

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$fakeFileName");
    header("Content-Length: " . filesize($file));
    fpassthru($fp);
}
else
    header("Location:../../index.php");
