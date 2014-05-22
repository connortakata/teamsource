<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
		$id = $_SESSION["id"];
		$firstname = $_POST["firstName"];
		$lastname = $_POST["lastName"];
        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
		$stmt = $mysqli->prepare("UPDATE user SET USER_FIRSTNAME = ?, USER_LASTNAME = ? WHERE ID = ?");
		$stmt->bind_param("ssi", $firsname, $lastname, $id);

	    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	    $stmt->execute();
        $mysqli->close();
}
else
    header("Location:../../index.php");