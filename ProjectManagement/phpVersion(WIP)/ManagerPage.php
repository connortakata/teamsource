<?php
	require "includes/header.php";
	require "includes/topNav.php";
	//require "includes/sidebar.php";
?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          <h1 class="page-header">Web Administer</h1>
			</div>
		  	<div class="well" style="position:fixed; left:310px; top:150px;">
		  		<!--<div class="panel-heading">
		  			<h3>General User Settings</h3>
		  		</div>
		  		<div class="panel-body">
		  		</div>-->
		  		<div class="panel-heading">
		  			<h3>System Teams</h3>
		  		</div>
		  		<div class="panel-body">
		  			<table class="table">
		  				<thead>
		  					<tr>
		  						<th>Team Name</th>
		  						<th>Team Leader</th>
		  						<th>Delete Team</th>
		  					</tr>
		  				</thead>
		  				<tbody>
		  					<tr>
		  						<td>Angluar Fish</td>
		  						<td>Ellie</td>
		  						<td><button name="team-delete" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
		  					</tr>
		  					<tr>
		  						<td>Bouncy Ball</td>
		  						<td>Sam</td>
		  						<td><button name="team-delete" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
		  					</tr>
		  					<tr>
		  						<td>Hateraid</td>
		  						<td>Connor</td>
		  						<td><button name="team-delete" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></button></td>
		  					</tr>
		  			</table>
		  		</div>
		  	</div>
<?php	
	require "includes/footer.php";
?>