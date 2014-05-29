<?php
session_start();

if(!isset( $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["pass"]))
{
    $_SESSION["createUserError"] = 'Please enter a valid username and password';
}

elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $_SESSION["createUserError"] = 'Invalid form submission';
}

elseif (strlen( $_POST['firstName']) == 0 || strlen($_POST['lastName']) == 0)
{
    $_SESSION["createUserError"] = 'Please enter a valid full name.';
}

elseif (strlen( $_POST['pass']) > 20 || strlen($_POST['pass']) < 6)
{
    $_SESSION["createUserError"] = 'Please enter a password of maximum length 20 characters and minimum 6.';
}

elseif (ctype_alnum($_POST['firstName']) != true || ctype_alnum($_POST['lastName']) != true)
{
    //if there is no match
    $_SESSION["createUserError"] = "Names must be alpha numeric";
}

else
{
    //if we are here the data is valid and we can insert it into database
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    $title = filter_var('default', FILTER_SANITIZE_STRING);

    //now we can encrypt the password
    $password = crypt($password, PASSWORD_DEFAULT);

    //connect to database
    //mysql hostname
    $mysql_hostname = 'localhost';

    //mysql username
    $mysql_username = 'root';

    //mysql password
    $mysql_password = 'TeamSource1!';

    //database name
    $mysql_dbname = 'teamsource';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        //$message = a message saying we have connected

        //set the error mode to excptions
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //prepare the insert
        $stmt = $dbh->prepare("INSERT INTO USER
        (USER_EMAIL, USER_PASSWORD, USER_FIRSTNAME, USER_LASTNAME, USER_TITLE )
        VALUES (:email, :password, :firstName, :lastName, :title );
        SELECT ID FROM USER WHERE USER_EMAIL=:email;");

        //bind the parameters
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR, 40);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR, 40);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR, 40);

        //execute the prepared statement
        $stmt->execute();
        $_SESSION["id"] = $stmt->fetchColumn(0);
        //unset the form token session variable
        unset( $_SESSION['form_token'] );

        //if all is done, say thanks
        $message = 'New user added';
    }
    catch(Exception $e)
    {
        //check if the username already exists
        if( $e->getCode() == 23000)
        {
            $_SESSION["createUserError"] = 'Email already registered.';
        }
        else
        {
            //if we are here, something has gone wrong with the database
            $_SESSION["createUserError"] = 'We are unable to process your request. Please try again later"';
        }
    }
}