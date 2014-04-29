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
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/core-min.js"></script>
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-utf16-min.js"></script>
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-base64-min.js"></script>
		<script src="js/firebase.js"></script>
		<script src="js/Validation.js"></script>
    	<script src="js/AlertPopUp.js"></script>
    	<script src="js/AJAX_lib.js"></script>
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
		<div id="AlertPopUp" class="PopupShadow" style="display:none; position:fixed; top:40%; left:35%; width:400px; height:auto">
			<div class="well" style="width:100%; height:100%;">
				<div class="panel panel-primary" style="height:100%;">
					<div class="panel-heading">
						<label id="AlertPopUpTitle"></label>
					</div>
					<div id="AlertPopUpBody" class="panel-body">
	
					</div>
					<div class="btn-group">
						<input type="button" value="Ok" style="margin-left:300px; width:50px" onclick="HideAlertPopUp()" />
					</div>
				</div>
			</div>
		</div>   
