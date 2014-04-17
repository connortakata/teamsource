﻿<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          <h1 class="page-header">Account Settings</h1>
			</div>
		  	<div class="well" style="position:fixed; left:310px; top:150px;">
		  		<div class="panel-heading">
		  			<h3>General User Settings</h3>
		  		</div>
		  		<div class="panel-body">
		  			<table class="table">
		  				<thead>
		  					<tr>
		  						<th>Name:</th>
		  						<th>Connor Takata</th>
		  						<th><button id="name-edit" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></th>
		  					</tr>
		  					<tr>
		  						<th>Username:</th>
		  						<th>Ctakata</th>
		  						<th><button id="user-edit" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></th>
		  					</tr>
		  					<tr>
		  						<th>Password:</th>
		  						<th>***********</th>
		  						<th><button id="pass-edit" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></th>
		  					</tr>
		  					<tr>
		  						<th>Email:</th>
		  						<th>takatac@spu.edu</th>
		  						<th><button id="email-edit" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></th>
		  					</tr>
		  				</thead>
		  			</table>
		  		</div>
		  		<div class="panel-heading">
		  			<h3>Your Teams</h3>
		  		</div>
		  		<div class="panel-body">
		  			<table class="table">
		  				<thead>
		  					<tr>
		  						<th>Team Name</th>
		  						<th>Team Leader</th>
		  						<th></th>
		  					</tr>
		  				</thead>
		  				<tbody>
		  					<tr>
		  						<td>Team1</td>
		  						<td>Drew Howard</td>
		  						<td><button id="team-delete" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
		  					</tr>
		  					<tr>
		  						<td>Team2</td>
		  						<td>Daniel Franz</td>
		  						<td><button id="team-delete" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
		  					</tr>
		  					<tr>
		  						<td>Team3</td>
		  						<td>Joe Jazdzewski</td>
		  						<td><button id="team-delete" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
		  					</tr>
		  			</table>
		  		</div>
		  	</div>>';
	
	require "includes/footer.php";
?>