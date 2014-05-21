<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";
?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          <h1 class="page-header">Account Settings</h1>
			</div>
		  	<div class="well" style="position:fixed; left:310px; top:150px;">
		  		<div class="panel-heading">
		  			<h3>General User Settings</h3>
		  		</div>
		  		<div class="panel-body">
		  			<div class="panel panel-default">
  						<div class="panel-heading">Panel heading without title</div>
 						<div class="panel-body">Panel content</div>
					</div>
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
		  	</div>

		  	<script>

		  	$(document).ready(function(){
		  		$("#div-edit-name").hide();
		  		$("#div-edit-pass").hide();
		  		$("#div-edit-email").hide();
		  	});

		  	$("#name-edit").click(function() {
		  		$("#div-edit-name").toggle(100);
		  	});
		  	$("#pass-edit").click(function() {
		  		$("#div-edit-pass").toggle(100);
		  	});
		  	$("#email-edit").click(function() {
		  		$("#div-edit-email").toggle(100);
		  	});
		  	</script>

<?php
	require "includes/footer.php";
?>