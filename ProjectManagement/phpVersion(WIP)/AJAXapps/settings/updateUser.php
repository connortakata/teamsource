<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
		$id = $_SESSION["id"];
        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");

        if(isset($_POST["firstName"]) && isset($_POST["firstName"]))
        {
            $firstname = $_POST["firstName"];
            $lastname = $_POST["lastName"];
        	$stmt = $mysqli->prepare("UPDATE user SET USER_FIRSTNAME = ?, USER_LASTNAME = ? WHERE ID = ?");
			$stmt->bind_param("ssi", $firstname, $lastname, $id);
        }
        if(isset($_POST["oldPass"]) && isset($_POST["newPass"]))
        {
            $oldPass = $_POST["oldPass"];
            $oldPass = crypt($oldPass, 'PASSWORD_DEFAULT');
            
            $newPass = $_POST["newPass"];
            $existingPass = mysqli_query($con, "SELECT USER_PASSWORD FROM user WHERE ID = '$id';");

            if($oldPass == $existingPass)
            {
                $stmt = $mysqli->prepare("UPDATE user SET USER_PASSWORD WHERE ID = ?");
                $stmt->bind_param("si", $newPass, $id);
            }
        	
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