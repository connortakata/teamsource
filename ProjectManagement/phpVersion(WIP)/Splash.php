		<!DOCTYPE html>
		<html lang="en">
		  <head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">
			<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

			<title>Dashboard Template for Bootstrap</title>

			<!-- Bootstrap core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/splash.css" rel="stylesheet">

			<!-- Custom styles for this template -->
			<link href="css/dashboard.css" rel="stylesheet">

			<!-- Just for debugging purposes. Dont actually copy this line! -->
			<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			  <script src="html5shiv.js"></script>
			  <script src="respond.min.js"></script>
			<![endif]-->
		  </head>

		  <body>

			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="#">Team Source</a>
				  
				</div>
				<div class="navbar-collapse collapse">
					<form class="navbar-form navbar-right">
						<input id="btnLogIn" type="button" value="Log-in">
					</form>
					<form class="navbar-form navbar-right">
						<input id="txtPasswordLog" type="text" class="form-control" placeholder="Password">
					</form>
					<form class="navbar-form navbar-right">
					  <input id="txtUsernameLog" type="text" class="form-control" placeholder="Username">
					</form>          	
				</div>
			  </div>
			</div>
				
			<div class="LeftPanel">
				<div class="container-fluid">
					<div class="panel-body">
						<h1 style="margin-left:30%">
							Team Source
						</h1>
						<label class="PanelBody">
							This project is created by Team H8er-aid for a Seattle Pacific University 
							Software Engineering Project. Our Project Manager is Connor Takata, who is
							majoring in computer science, while working as a pastor. Our project sponsor
							is Drew Howard and also one of our staff, Along with Daniel "daFranz" Franz and 
							Joe Jazdzewski. 
						</label>
						<label>
						
						</label>
						<label class="PanelBody">
							Team Source was created to fill the void of Seattle Pacific Universitys lack 
							of a good option to manage student projects. Our Goal is to make A students way
							of managing their projects with other students.  	
						</label>
					</div>
				</div>
			</div>
			<!--<div class="LeftPanelColor"></div>-->
			<?php
    
    $con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    

    if (isset($_POST["txtUsername"]) && isset($_POST["txtFirstName"]) && isset($_POST["txtLastName"])
    	&& isset($_POST["txtPassword"]) && isset($_POST["txtEmail"])) 
	{
 		$username = $_POST["txtUsername"];
 		$firstname = $_POST["txtFirstName"];
 		$lastname = $_POST["txtLastName"];
 		$password = $_POST["txtPassword"];
 		$email = $_POST["txtEmail"];
 		$title = "default";

 		mysqli_query($con, "INSERT INTO User (username, user_firstname, user_lastname, user_title, user_password, user_email) VALUES ('$username', '$firstname', '$lastname', '$title', '$password', '$email');");       
    	echo "Row added";
    	mysqli_close($con);  
	} 
	else 
	{
  		$username = null;
  		$firstname = null;
  		$lastname = null;
  		$password = null;
  		$email = null;
  		$title = null;
  
	}
    
    //$username = $_POST['txtUsername'];
    /*$firstname = $_POST['txtFirstName'];
    $lastname = $_POST['txtLastName'];
    $password = $_POST['txtPassword'];
    $email = $_POST['txtEmail'];*/
    
	  
?>

			<form name="createuser" method="post"> 
			<div class="RightPanel">
				<div class="container-fluid">
					<div class="panel-body">
						<h1 style="margin-left:25%">
							Sign - up
						</h1>
						<h4 style="margin-left:10%">
							Its a free Project Management Tool
						</h4>
						<table style="margin-left:25%">
    					<tr style="height:30px" ></tr>
    					<tr>
                           	<td>
                              	  <input type="text" style="width:100%" class=" form-control" id="txtUsername" name="txtUsername" placeholder="Username">
                            </td>
                        	</tr>
                            <tr class="rowSpaces"></tr>
                            <tr>
                                <td>
                                    <input type="text" data-inline="true" style="width:100%" class=" form-control" id="txtFirstName" name="txtFirstName" placeholder="FirstName">
                                    <input type="text" data-inline="true" style="width:100%" class=" form-control" id="txtLastName" name="txtLastName" placeholder="LastName">
                                </td>
                            </tr>
                            <tr class="rowSpaces"></tr>
                            <tr>
                                <td>
                                    <input type="password" class=" form-control" id="txtPassword" name="txtPassword" placeholder="Password">
                                </td>
                            </tr>
                            <tr class="rowSpaces"></tr>
                            <tr>
                                <td>
                                    <input type="password" class=" form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" placeholder="Password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" class=" form-control" id="txtEmail" name="txtEmail" placeholder="Email Address">
                            </td>
                        </tr>
	    			<tr class="rowSpaces"></tr>
	    			<tr>
	    				<td >
	    					<input style="margin-left:30%" type="submit" value="Sign-Up" onclick="createuser.action='Splash.php';">
	    				</td>
	    			</tr>
	    		</table>
					</div>
				</div>
			</div>
			</form>
			<div class="BottomPanel">
				This Project was created by Connor, Drew, Daniel, and Joe. All CS majors from Seattle Pacific University
			</div>
			<!--<div class="contentCurve"></div>-->
				  
			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/docs.min.js"></script>
		  </body>
		</html>
?>