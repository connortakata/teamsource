<?php
if(isset($_POST["email"]) && isset($_POST["pass"]))
{
    $con = mysqli_connect("localhost", "root", "", "teamsource");
    $email = $_POST["email"];
    $sql = "SELECT ID,USER_PASSWORD FROM USER WHERE USER_EMAIL='$email';";
    $result = mysqli_query($con, $sql);
    $id = mysqli_fetch_array($result);
    mysqli_close($con);
    if($_POST["pass"]==$id["USER_PASSWORD"])
    {
        setcookie("id", $id["ID"], time()+3600);
        //header("Location: ./");
    }
}