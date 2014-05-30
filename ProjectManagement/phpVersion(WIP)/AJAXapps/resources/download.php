<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $teamID = $_SESSION["team"];
    $fileName = $_GET["fileName"];
    $fakeFileName= $fileName;//filename shown to user
    $realFileName = $teamID."/".$fileName;//true filename containing file path

    $file = "../../upload/".$realFileName;
    $fp = fopen($file, 'r');

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$fakeFileName");
    header("Content-Length: " . filesize($file));
    fpassthru($fp);
}
else
    header("Location:../../index.php");
