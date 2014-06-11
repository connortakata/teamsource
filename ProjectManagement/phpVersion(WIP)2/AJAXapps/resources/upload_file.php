<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $allowedExts = array("gif", "jpeg", "jpg", "png");//array that defines allowed file types
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);

    $teamID = $_SESSION["team"];
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $sql = "SELECT FILE_SIZE FROM FILE WHERE FILE_FILE_MANAGER_ID='$fileID'";
    $result = mysqli_query($con,$sql);
    $fileSize=0;
    while($row = mysqli_fetch_array($result))
    {
        if(substr($row[0],strlen($row[0])-2,1)=='m')
            $fileSize += $row[0]*1024*1024;
        else if(substr($row[0],strlen($row[0])-2,1)=='k')
            $fileSize += $row[0]*1024;
        else
            $fileSize += $row[0];
    }
    $fileSize+=$_FILES["file"]["size"];

    if ($fileSize<2000000000&&($_FILES["file"]["size"]/1024 < 256000))//Files of size 1gb+ are not allowed, and the team cap is 2gb
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            if (file_exists("../upload/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                //Select the team's file manager to identify with
                $teamID = $_SESSION["team"];
                $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
                $sql = "SELECT ID FROM FILEMANAGER WHERE FILE_MANAGER_TEAM_ID='$teamID'";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($result))
                {
                    $fileID = $row[0];
                }

                try
                {//move the file into the correct destination
                    if (!file_exists("../../upload/".$teamID."/")) {
                        mkdir("../../upload/".$teamID."/", 0777, true);
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"], "../../upload/".$teamID."/" . $_FILES["file"]["name"]);
                    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
                    $stmt= $mysqli->prepare("INSERT INTO FILE (FILE_NAME, FILE_DATE, FILE_TIME, FILE_SIZE, FILE_FILE_MANAGER_ID) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param('ssssi', $filename, $date, $time, $size, $fileID);
                    $filename = $_FILES["file"]["name"];
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    if(substr(($_FILES["file"]["size"] / 1024),0)>=1000000)
                    {
                        $size = substr(($_FILES["file"]["size"] / (1024*1024*1024)),0,4) . "gB";
                    }
                    else if(substr(($_FILES["file"]["size"] / 1024),0)>=1000)
                    {
                        $size = substr(($_FILES["file"]["size"] / (1024*1024)),0,4) . "mB";
                    }
                    else
                        $size = substr(($_FILES["file"]["size"] / 1024),0,4) . "kB";
                    list($left, $right) = explode('.', $size, 2);
                    $stmt->execute();
                    $mysqli->close();
                }
                catch(Exception $e)
                {
                    $_SESSION["fileUploadError"] = "An error occurred during file upload, please try again.";
                    unlink("../../upload/" . $_FILES["file"]["name"]);
                    //If the db insertion failed we need to delete the file so the user can try again
                }
            }
        }
    }
    else
    {
        echo "Invalid file";
    }

    header( 'Location: ../../resources.php' );
}
else
    header("Location:../../index.php");
