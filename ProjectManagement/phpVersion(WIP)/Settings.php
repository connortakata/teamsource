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
		  			<ul class="list-group">
  						<li class="list-group-item" id="name">
							<div><b>Name: Connor Takata</b>
							<button id="name-edit" type="button" class="btn btn-default btn-xs" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
							</div>
  						</li>
  						<li class="list-group-item" id="div-edit-name" style="text-align:center">
  							<div style="text-align:right; display: inline-block">
  								<div>First Name: <input type="text" placeholder="Connor"></input></div>
  								<p></p>
  								<div>Last Name: <input type="text" placeholder="Takata"></input></div>
  								<p></p>
  							</div>
  							<div>
  								<button id="change-name" type="button" class="btn btn-primary btn-xs">Submit</button>
  								<button id="cancel-name-change" type="button" class="btn btn-default btn-xs">Cancel</button>
  							</div>
  						</li>
  						<li class="list-group-item" id="pass">
							<div><b>Password: ***********</b>
							<button id="pass-edit" type="button" class="btn btn-default btn-xs" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
							</div>
  						</li>
  						<li class="list-group-item" id="div-edit-pass" style="text-align:center">
  							<div style="text-align:right; display: inline-block">
  								<div>Old Password: <input type="text" placeholder="*********"></input></div>
  								<p></p>
  								<div>New Password: <input type="text" ></input></div>
  								<p></p>
  								<div>Confirm Password: <input type="text" ></input></div>
  								<p></p>
  							</div>
  							<div>
  								<button id="change-pass" type="button" class="btn btn-primary btn-xs">Submit</button>
  								<button id="cancel-pass-change" type="button" class="btn btn-default btn-xs">Cancel</button>
  							</div>
  						</li>
  						<li class="list-group-item" id="email">
							<div><b>Email Address: takatac@spu.edu</b>
							<button id="email-edit" type="button" class="btn btn-default btn-xs" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
							</div>
  						</li>
  						<li class="list-group-item" id="div-edit-email" style="text-align:center">
  							<div style="text-align:right; display: inline-block">
  								<div>New Email: <input type="text" placeholder="takatac@spu.edu"></input></div>
  								<p></p>
  								<div>Confirm Email: <input type="text" ></input></div>
  								<p></p>
  							</div>
  							<div>
  								<button id="change-email" type="button" class="btn btn-primary btn-xs">Submit</button>
  								<button id="cancel-email-change" type="button" class="btn btn-default btn-xs">Cancel</button>
  							</div>
  						</li>
					</ul>
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
		  		//$("#name").toggle(1);
		  		$("#div-edit-name").toggle(100);
		  	});
		  	$("#pass-edit").click(function() {
		  		//$("#pass").toggle(1);
		  		$("#div-edit-pass").toggle(100);
		  	});
		  	$("#email-edit").click(function() {
		  		//$("#email").toggle(1);
		  		$("#div-edit-email").toggle(100);
		  	});



		  	$("#change-name").click(function() {
		  		//$("#name").toggle(1);
		  		$("#div-edit-name").toggle(100);
		  	});
		  	$("#cancel-name-change").click(function() {
		  		//$("#name").toggle(1);
		  		$("#div-edit-name").toggle(100);
		  	});


		  	$("#change-pass").click(function() {
		  		//$("#pass").toggle(1);
		  		$("#div-edit-pass").toggle(100);
		  	});
		  	$("#cancel-pass-change").click(function() {
		  		//$("#pass").toggle(1);
		  		$("#div-edit-pass").toggle(100);
		  	});


		  	$("#change-email").click(function() {
		  		//$("#email").toggle(1);
		  		$("#div-edit-email").toggle(100);
		  	});
		  	$("#cancel-email-change").click(function() {
		  		//$("#email").toggle(1);
		  		$("#div-edit-email").toggle(100);
		  	});
		  	</script>

<?php
	require "includes/footer.php";
?>