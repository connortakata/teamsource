<?php
session_start();

if(isset( $_SESSION['user_id'] ))
{
    header("Location: ../../Splash.php?error=1");
}

if(!isset( $_POST['email'], $_POST['pass']))
{
    $message = 'Please enter a valid username and password';
}

elseif (strlen( $_POST['pass']) > 20 || strlen($_POST['pass']) < 6)
{
    $message = 'Please enter a password of maximum length 16 characters and minimum 8.';
}

else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    $password = crypt($password, 'PASSWORD_DEFAULT');

    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'root';

    /*** mysql password ***/
    $mysql_password = 'TeamSource1!';

    /*** database name ***/
    $mysql_dbname = 'teamsource';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT ID, USER_EMAIL, USER_PASSWORD FROM USER WHERE USER_EMAIL = :email AND USER_PASSWORD = :password");

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $user_id = $stmt->fetchColumn();

        /*** if we have no result then fail boat ***/
        if($user_id == false)
        {
            $_SESSION["logInError"]="Email or password incorrect.";
            //header("Location:../../Splash.php?error=1");
        }
        /*** if we do have a result, all is well ***/
        else
        {
            /*** set the session user_id variable ***/
            $_SESSION['id'] = $user_id;

            /*** tell the user we are logged in ***/
            $message = 'You are now logged in';
        }
    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
        header("Location:Splash.php");
    }
}