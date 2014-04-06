<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print <<<END 
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	        <h1 class="page-header">Settings</h1>
		</div>
		<div class="well" style="position:fixed; left:250px; top:150px;">
			<div class="panel-heading">
		  		<h3>hey</h3>
		  	</div>
		  	<div class="panel-body">
		  		<select id="ddlItems">
		  			<option>1</option>
		  			<option>2</option>
		  		</select>
		  	</div>
		</div>
	END;
	require "includes/footer.php";
?>