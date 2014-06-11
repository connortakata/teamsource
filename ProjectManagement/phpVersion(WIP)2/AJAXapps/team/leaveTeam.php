<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    if(!isset( $_POST["id"]))
    {
        $message = 'User id or Team Name not found';
    }

    elseif (strlen($_POST['id']) == 0)
    {
        $message = 'Please enter a valid id.';
    }

    else
    {
        // if we are here the data is valid and we can insert it into database
        $teamID = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
        $userID = $_SESSION["id"];
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
        $sql = "SELECT TEAM_MANAGER_ID FROM TEAM WHERE ID = '$teamID';";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result))
        {
            $teamManID = $row[0];
        }//if the user is the manager then we are deleting the team
        if(isset($teamManID)&&$teamManID==$userID)
        {
            $removeTeam = true;
        }
        try //removing the user
        {
            $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            // $message = a message saying we have connected

            // set the error mode to excptions
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($removeTeam)&&$removeTeam)
            {//delete team's entire entry
                $stmt = $dbh->prepare("DELETE FROM TEAM_MEMBER_LIST
                WHERE TEAM_MEMBER_LIST_TEAM_ID=:teamID;
                DELETE FROM TEAM WHERE ID=:teamID");
            }
            else
            {//Only delete the user's entry for this team
                $stmt = $dbh->prepare("DELETE FROM TEAM_MEMBER_LIST
                WHERE TEAM_MEMBER_LIST_USER_ID=:userID
                AND TEAM_MEMBER_LIST_TEAM_ID=:teamID;");
            }
            // bind the parameters
            $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
            $stmt->bindParam(':teamID', $teamID, PDO::PARAM_STR);
            // execute the prepared statement
            $stmt->execute();
            //All done!
            unset($_SESSION["team"]);
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
}