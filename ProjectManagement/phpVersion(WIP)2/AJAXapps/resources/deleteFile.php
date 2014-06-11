<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $teamID = $_SESSION["team"];
    $fileName = $_GET["fileName"];
    $id = $_GET["id"];
    $filePath = $teamID."/".$fileName;//true filename containing file path

    $file = "../../upload/".$filePath;
    unlink($file);
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("DELETE FROM FILE WHERE ID=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $mysqli->close();
    header("Location:../../resources.php");
}
else
    header("Location:../../index.php");