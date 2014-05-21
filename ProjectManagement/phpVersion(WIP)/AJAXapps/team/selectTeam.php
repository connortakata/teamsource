<?php
session_start();
if(isset($_POST["id"]))
{
    $_SESSION["team"] = $_POST["id"];
}