<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam()&&isManager())
{
    $userID = $_POST["id"];
    $teamID = $_SESSION["team"];
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("DELETE FROM TEAM_MEMBER_LIST WHERE TEAM_MEMBER_LIST_USER_ID='$userID' AND TEAM_MEMBER_LIST_TEAM_ID='$teamID' ;");
    $stmt->execute();
    $mysqli->close();
}