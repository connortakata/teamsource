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
        if(isset($_POST["curPass"]) && isset($_POST["newPass"]))
        {
            $curPass = $_POST["curPass"];
            $curPass = crypt($curPass, 'PASSWORD_DEFAULT');
            
            $newPass = $_POST["newPass"];
            $user = mysqli_query($mysqli, "SELECT USER_PASSWORD FROM user WHERE ID = '$id';");
            $userpass = mysqli_fetch_array($user);

            if($curPass == $userpass["USER_PASSWORD"])
            {
                $newPass = crypt($newPass, 'PASSWORD_DEFAULT');
                $stmt = $mysqli->prepare("UPDATE user SET USER_PASSWORD = ? WHERE ID = ?");
                $stmt->bind_param("si", $newPass, $id);
            }
        }
        if(isset($_POST["email"]))
        {
            $email = $_POST["email"];
            $stmt = $mysqli->prepare("UPDATE user SET USER_EMAIL = ? WHERE ID = ?");
            $stmt->bind_param("si", $email, $id);
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