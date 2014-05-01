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
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

        if (file_exists("../upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
            echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
            $con=mysqli_connect("localhost","root","","root");
            // Check connection

            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $filename = $_FILES["file"]["name"];
            $date = date('M d, Y');
            $size = ($_FILES["file"]["size"] / 1024) . "kB";
            list($left, $right) = explode('.', $size, 2);
            $sql = "INSERT INTO files (filename, added, size)
VALUES ('$filename', '$date', '$size');";
            mysqli_query($con,$sql);

            mysqli_close($con);
        }
    }
}
else
{
    echo "Invalid file";
}

header( 'Location: ../resources.php' )
?>