<?php
require "../../includes/userAuth.php";
if(isLoggedIn()){
        unset($_SESSION["id"]);//Remove session data and kill the session to logout user.
        unset($_SESSION["team"]);
        session_destroy();
}