<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
		$id = $_SESSION["id"];
		$firstname = $_POST["firstName"];
		$lastname = $_POST["lastName"];
		$password = $_POST["password"]
        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");

        if(isset($firstname) && isset($lastname))
        {
        	$stmt = $mysqli->prepare("UPDATE user SET USER_FIRSTNAME = ?, USER_LASTNAME = ? WHERE ID = ?");
			$stmt->bind_param("ssi", $firstname, $lastname, $id);
        }
        if(isset($password))
        {
        	$stmt = $mysqli->prepare("UPDATE user SET USER_PASSWORD WHERE ID = ?");
			$stmt->bind_param("si", $password, $id);
        }
		

	    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	    $stmt->execute();
        $mysqli->close();
}
else
    header("Location:../../index.php");