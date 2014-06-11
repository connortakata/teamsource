<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam()&&isManager())
{
    $managerID = $_POST["id"];
    $teamID = $_SESSION["team"];
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("UPDATE TEAM SET TEAM_MANAGER_ID=? WHERE ID=?;");
    $stmt->bind_param("ii", $managerID, $teamID);
    $stmt->execute();
    $mysqli->close();
}