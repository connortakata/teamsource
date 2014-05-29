<?php
session_start();
if(isset($_POST["id"]))
{
    $_SESSION["team"] = $_POST["id"];
    //Simply change the session's team data to the posted data. Let isLoggedIn() do the validation.
}