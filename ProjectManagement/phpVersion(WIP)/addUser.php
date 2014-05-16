<?php
session_start();

if(!isset( $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["pass"]))
{
    $message = 'Please enter a valid username and password';
}

elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}

elseif (strlen( $_POST['firstName']) == 0 || strlen($_POST['lastName']) == 0)
{
    $message = 'Please enter a valid full name.';
}

elseif (strlen( $_POST['pass']) > 50 || strlen($_POST['pass']) < 8)
{
    $message = 'Please enter a password of maximum length 16 characters and minimum 8.';
}

elseif (ctype_alnum($_POST['firstName']) != true || ctype_alnum($_POST['lastName']) != true)
{
    /*** if there is no match ***/
    $message = "Names must be alpha numeric";
}

else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    $title = filter_var('default', FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    $password = crypt($password, PASSWORD_DEFAULT);

    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'root';

    /*** mysql password ***/
    $mysql_password = '';

    /*** database name ***/
    $mysql_dbname = 'teamsource';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO USER (USER_EMAIL, USER_PASSWORD, USER_FIRSTNAME, USER_LASTNAME, USER_TITLE ) VALUES (:email, :password, :firstName, :lastName, :title )");

        /*** bind the parameters ***/
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR, 40);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR, 40);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR, 40);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = 'New user added';
        header("Location:index.php");
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
        }
        else
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
}
/*if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])
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
}*/