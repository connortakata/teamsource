<?php
require "../../includes/userAuth.php";
if(isLoggedIn())
{
    if(!isset( $_SESSION["id"], $_POST["teamName"]))
    {
        $message = 'User id or Team Name not found';
    }

    elseif (strlen($_POST['teamName']) == 0)
    {
        $message = 'Please enter a valid Team Name.';
    }

    elseif (strlen( $_POST['teamName']) > 30 || strlen($_POST['teamName']) < 4)
    {
        $message = 'Please enter a Team Name of maximum length 30 characters and minimum 4.';
    }

    else
    {
        // if we are here the data is valid and we can insert it into database
        $teamName = filter_var($_POST['teamName'], FILTER_SANITIZE_STRING);
        $managerID = $_SESSION["id"];

        // connect to database
        // mysql hostname
        $mysql_hostname = 'localhost';

        // mysql username
        $mysql_username = 'root';

        // mysql password
        $mysql_password = 'TeamSource1!';

        // database name
        $mysql_dbname = 'teamsource';

        try //creating the team
        {
            $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            // $message = a message saying we have connected

            // set the error mode to excptions
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare the insert
            $stmt = $dbh->prepare("INSERT INTO TEAM (TEAM_MANAGER_ID, TEAM_NAME) VALUES (:managerID, :teamName);");
            // bind the parameters
            $stmt->bindParam(':managerID', $managerID, PDO::PARAM_STR);
            $stmt->bindParam(':teamName', $teamName, PDO::PARAM_STR);
            // execute the prepared statement
            $stmt->execute();

            //Now we add the manager to the user list for this team
            $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
            $sql = "SELECT ID FROM TEAM WHERE TEAM_NAME = '$teamName';";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result))
            {
                $teamID = $row[0];
            }
            //$teamID=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","TeamSource1!","teamsource"), $sql))["ID"];
            $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
            $stmt= $mysqli->prepare("INSERT INTO TEAM_MEMBER_LIST (TEAM_MEMBER_LIST_TEAM_ID, TEAM_MEMBER_LIST_USER_ID) VALUES (?, ?);");
            $stmt->bind_param('ii', $teamID, $managerID);
            $stmt->execute();

            //Now we add a calendar entry for the team
            $stmt= $mysqli->prepare("INSERT INTO CALENDAR (CALENDAR_TEAM_ID) VALUES (?);");
            $stmt->bind_param('i', $teamID);
            $stmt->execute();

            //Now we add a file manager entry for the team
            $stmt= $mysqli->prepare("INSERT INTO FILEMANAGER (FILE_MANAGER_TEAM_ID) VALUES (?);");
            $stmt->bind_param('i', $teamID);
            $stmt->execute();

            //Now we add a message board entry for the team
            $stmt= $mysqli->prepare("INSERT INTO MESSAGEBOARD (MESSAGE_BOARD_TEAM_ID) VALUES (?);");
            $stmt->bind_param('i', $teamID);
            $stmt->execute();

            //Now we add a task manager entry for the team
            $stmt= $mysqli->prepare("INSERT INTO TASK_MANAGER (TASK_MANAGER_TEAM_ID) VALUES (?);");
            $stmt->bind_param('i', $teamID);
            $stmt->execute();

            //All done!
            $_SESSION["successTeamAdded"] = true;
            $mysqli->close();
            //Load the current team for the user
            $_SESSION["team"]=$teamID;
        }
        catch(Exception $e)
        {
            if( $e->getCode() == 23000)
            {
                $message = 'Team Name already exists';
                $_SESSION["errorTeamExists"] = true;
            }
            else
            {
                $message = 'We are unable to process your request. Please try again later"';
                $_SESSION["errorTeamGeneral"] = true;
            }
            print $message;
        }
    }
}