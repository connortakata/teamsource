<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $ID=$_POST["id"];//Retrieve the event from the DB using its ID
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("DELETE FROM EVENT WHERE ID='$ID';");
    $stmt->execute();

    $mysqli->close();
}
else
    header("Location:../../index.php");