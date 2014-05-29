<?php
require "../../includes/userAuth.php";
if(isLoggedIn()){
        unset($_SESSION["id"]);//Remove session data and kill the session to logout user.
        session_destroy();
}