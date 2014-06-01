<?php
// begin the session
session_start();

function isLoggedIn(){
    if(!isset($_SESSION['id']))
    {
        $message = 'You must be logged in to access this page';
        return false;
    }
    else
    {
        try
        {
            // connect to database
            // mysql hostname
            $mysql_hostname = 'localhost';

            // mysql username
            $mysql_username = 'root';

            // mysql password
            $mysql_password = 'TeamSource1!';

            // database name
            $mysql_dbname = 'teamsource';

            $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            // $message = a message saying we have connected

            // set the error mode to excptions
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // select the users email from the database
            $stmt = $dbh->prepare("SELECT USER_EMAIL FROM USER
            WHERE ID = :user_id");

            // bind the parameters
            $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);

            // execute the prepared statement
            $stmt->execute();

            // check for a result
            $email = $stmt->fetchColumn();

            // if we have nothing something is wrong
            if($email == false)
            {
                $message = 'Access Error';
                return false;
            }
            else
            {
                //success
                $message = 'Welcome';
                return true;
            }
        }
        catch (Exception $e)
        {
            // if we are here, something is wrong in the database //
            $message = 'We are unable to process your request. Please try again later"';
            return false;
        }
    }
}

function isInTeam()
{
    if(!isset($_SESSION['id']))
    {
        $message = 'You must be logged in to access this page';
        return false;
    }
    else if(!isset($_SESSION['team']))
    {
        $message = 'No team selected';
        return false;
    }
    else
    {
        $userID=$_SESSION["id"];
        $teamID=$_SESSION["team"];

        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
        $stmt= $mysqli->prepare("SELECT COUNT(*) FROM TEAM_MEMBER_LIST
        WHERE TEAM_MEMBER_LIST_USER_ID='$userID'
        AND TEAM_MEMBER_LIST_TEAM_ID='$teamID';");
        $stmt->execute();
        $res = $stmt->get_result();
        $count = $res->fetch_assoc()["COUNT(*)"];
        $mysqli->close();

        if($count<1)
        {
            return false;
        }
        else
            return true;
    }
}

function isManager($id = null)
{
    if(!isset($_SESSION['id']))
    {
        $message = 'You must be logged in to access this page';
        return false;
    }
    else if(!isset($_SESSION['team']))
    {
        $message = 'No team selected';
        return false;
    }
    else
    {
        if($id==null)//Can check if any user is the manager of the currently selected team
            $userID=$_SESSION["id"];
        else
            $userID = $id;

        $teamID=$_SESSION["team"];
        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
        $stmt= $mysqli->prepare("
        SELECT TEAM_MANAGER_ID FROM TEAM
        WHERE ID='$teamID';");
        $stmt->execute();
        $res = $stmt->get_result();
        $teamManagerID = $res->fetch_assoc()["TEAM_MANAGER_ID"];
        $mysqli->close();

        if($teamManagerID!=$userID)
        {
            return false;
        }
        else
            return true;
    }
}