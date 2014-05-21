<?php
require "../../includes/userAuth.php";
if(isLoggedIn()){
        unset($_SESSION["id"]);
        session_destroy();
}