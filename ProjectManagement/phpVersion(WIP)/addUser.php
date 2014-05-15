<?php
session_start();
if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])
    && isset($_POST["pass"]))
{
    $con = mysqli_connect("localhost", "root", "", "teamsource");

    //$username = $_POST["txtUsername"];
    $firstname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $password = $_POST["pass"];
    $email = $_POST["email"];
    $title = "default";

    mysqli_query($con, "INSERT INTO User (user_firstname, user_lastname, user_title, user_password, user_email) VALUES ('$firstname', '$lastname', '$title', '$password', '$email');");

    $sql = "SELECT ID FROM USER WHERE USER_EMAIL='$email';";
    $result = mysqli_query($con, $sql);
    $id = mysqli_fetch_array($result)[0];
    session_start();
    $_SESSION["id"]=$id;
    //setcookie("id", $id, time()+3600);
    mysqli_close($con);
    header("Location: index.php");
}