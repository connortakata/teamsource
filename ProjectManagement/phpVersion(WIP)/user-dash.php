<!DOCTYPE html>
<html ng-app lang="en">

	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
	    
		<script src="js/angular.min.js"></script>
	    <script src="js/backbone-min.js"></script>
	    <script src="js/jquery.min.js"></script>
	    <script src="js/firebase.js"></script>
	    <script src="js/bootsrap.js"></script>
	    <title>Dashboard Template for Bootstrap</title>
	
	    <!-- Bootstrap core CSS -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	    <!-- Custom styles for this template -->
	    <link href="css/dashboard.css" rel="stylesheet">
	
	    <!-- Just for debugging purposes. Don't actually copy this line! -->
	    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="js/html5shiv.js"></script>
	      <script src="js/respond.min.js"></script>
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
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="index.html">Dashboard</a></li>
	            <li class="active"><a href="Settings.html">Settings</a></li>
	            <li><a href="#">Account</a></li>
	            <li><a href="#">Sign Out</a></li>
	          </ul>
	          <form class="navbar-form navbar-right">
	            <input type="text" class="form-control" placeholder="Search...">
	          </form>
	        </div>
	      </div>
	    </div>
	
	    <div class="container-fluid">
	      <div class="row">
	        <div class="col-sm-3 col-md-2 sidebar">
	          <ul class="nav nav-sidebar">
	            <li><a href="index.html">Dashboard</a></li>
	            <li><a href="calender.html">Calender</a></li>
	            <li><a href="resources.html">Resources</a></li>
	            <li><a href="tasks.html">Tasks</a></li>
	          </ul>
	        </div>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          <h1 class="page-header">Account Settings</h1>
			</div>
		  	<div class="well" style="position:fixed; left:310px; top:150px;">
		  		<div class="panel-heading">
		  			<h3>Your Teams</h3>
		  		</div>
		  		<div class="panel-body">
		  			<a href="index.html" class="list-group-item">
		  				<h4 class="list-group-item-heading">
		  					<table width="100%">
		  						<tbody>
		  							<tr>
		  								<td>Test Project</td>
		  								<td style="width:200px; text-align:left">User Manager</td>
		  							</tr>
		  						</tbody>
		  					</table>
		  				</h4>
		  			</a>
		  			<a href="#" class="list-group-item">
		  				<h4 class="list-group-item-heading">
		  					<table width="100%">
		  						<tbody>
		  							<tr>
		  								<td>Team2</td>
		  								<td style="width:200px; text-align:left">User Manager2</td>
		  							</tr>
		  						</tbody>
		  					</table>
		  				</h4>
		  			</a>
		  		</div>
		  	</div>
		  </div>
	    </div>
	</body>
	
</html>
