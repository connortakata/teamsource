<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isManager()&&isInTeam())
{
    if(!isset( $_POST["email"]))
    {
        $message = 'User id or Team Name not found';
    }

    elseif (strlen($_POST['email']) == 0)
    {
        $message = 'Please enter a valid email.';
    }

    else
    {
        // if we are here the data is valid and we can insert it into database //
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $teamID = $_SESSION["team"];
        // connect to database
        // mysql hostname
        $mysql_hostname = 'localhost';

        // mysql username
        $mysql_username = 'root';

        // mysql password
        $mysql_password = 'TeamSource1!';

        // database name
        $mysql_dbname = 'teamsource';

        $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
        $sql = "SELECT ID FROM USER WHERE USER_EMAIL = '$email';";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result))//find the user's id
        {
            $userID = $row[0];
        }
        if(isset($userID))
        {
            try //adding the user
            {
                $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                //$message = a message saying we have connected

                //set the error mode to excptions
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //prepare the insert //
                $stmt = $dbh->prepare("INSERT INTO TEAM_MEMBER_LIST (TEAM_MEMBER_LIST_USER_ID, TEAM_MEMBER_LIST_TEAM_ID)
                VALUES (:userID, :teamID);");
                //bind the parameters
                $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
                $stmt->bindParam(':teamID', $teamID, PDO::PARAM_STR);
                //execute the prepared statement
                $stmt->execute();
                //All done!
                $_SESSION["successUserAdded"] = true;
                $mysqli->close();
            }
            catch(Exception $e)
            {
                $_SESSION["error"]=$e->getCode();
                if( $e->getCode() == 23000)
                {
                    $message = 'Team Name already exists';
                }
                else
                {
                    $message = 'We are unable to process your request. Please try again later"';
                }
            }
        }
        else
        {
            $_SESSION["errorNoUserFound"] = true;
        }
    }
}