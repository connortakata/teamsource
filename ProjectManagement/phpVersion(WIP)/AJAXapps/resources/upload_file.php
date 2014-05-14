<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");//array that defines allowed file types
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if (true)//restrict file types here
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
            move_uploaded_file($_FILES["file"]["tmp_name"], "../../upload/" . $_FILES["file"]["name"]);
            $mysqli = new mysqli("localhost", "root", "", "teamsource");
            $stmt= $mysqli->prepare("INSERT INTO FILE (FILE_NAME, FILE_DATE, FILE_TIME, FILE_SIZE) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $filename, $date, $time, $size);
            $filename = $_FILES["file"]["name"];
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $size = substr(($_FILES["file"]["size"] / 1024),0,6) . "kB";
            list($left, $right) = explode('.', $size, 2);
            $stmt->execute();
            $mysqli->close();
        }
    }
}
else
{
    echo "Invalid file";
}

header( 'Location: ../../resources.php' )
?>