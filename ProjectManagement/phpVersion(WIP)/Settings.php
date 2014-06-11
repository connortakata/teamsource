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
		  		<?php
		  			$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
                    $id = $_SESSION["id"];
                    $sql = "SELECT USER_FIRSTNAME, USER_LASTNAME, USER_PASSWORD, USER_EMAIL
                    FROM user WHERE ID = '$id';";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);

                    $userfirst = $row["USER_FIRSTNAME"];
                    $userlast = $row["USER_LASTNAME"];
                    $pass = $row["USER_PASSWORD"];
                    $mail = $row["USER_EMAIL"];
		  		?>
		  		<div class="panel-body">
		  			<ul class="list-group">
  						<li class="list-group-item" id="name">
							<div><b>Name: <?php print "$userfirst $userlast"; ?></b>
							<button id="name-edit" type="button" class="btn btn-default btn-xs" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
							</div>
  						</li>
  						<li class="list-group-item" id="div-edit-name" style="text-align:center">
  							<div style="text-align:right; display: inline-block">
  								<div>First Name: <input id="txt-edit-fname" type="text" placeholder=<?php print $userfirst; ?>></input></div>
  								<p></p>
  								<div>Last Name: <input id="txt-edit-lname" type="text" placeholder=<?php print $userlast; ?>></input></div>
  								<p></p>
  							</div>
  							<div>
  								<button id="change-name" type="button" class="btn btn-primary btn-xs" onclick="updateName()">Submit</button>
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
  								<div>Old Password: <input id="txt-old-pass" type="password" placeholder="*********"></input></div>
  								<p></p>
  								<div>New Password: <input id="txt-new-pass" type="password" ></input></div>
  								<p></p>
  								<div>Confirm Password: <input id="txt-pass-confirm" type="password" ></input></div>
  								<p></p>
  							</div>
  							<div>
  								<button id="change-pass" type="button" class="btn btn-primary btn-xs" onclick="updatePassword()">Submit</button>
  								<button id="cancel-pass-change" type="button" class="btn btn-default btn-xs">Cancel</button>
  							</div>
  						</li>
  						<li class="list-group-item" id="email">
							<div><b>Email: <?php print $mail; ?></b>
							<button id="email-edit" type="button" class="btn btn-default btn-xs" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
							</div>
  						</li>
  						<li class="list-group-item" id="div-edit-email" style="text-align:center">
  							<div style="text-align:right; display: inline-block">
                                <div>Password: <input id="txt-email-pass" type="password" placeholder="*********"></input></div>
                                <p></p>
  								<div>New Email: <input id="txt-new-email" type="text"></input></div>
  								<p></p>
  								<div>Confirm Email: <input id="txt-email-confirm" type="text" ></input></div>
  								<p></p>
  							</div>
  							<div>
  								<button id="change-email" type="button" class="btn btn-primary btn-xs" onclick="updateEmail()">Submit</button>
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
		  						<th style="text-align: center;">Team Leader</th>
		  						<th style="text-align: right;">Leave Team</th>
		  					</tr>
		  				</thead>
		  				<tbody>
                        <?php
                        $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
                        $id = $_SESSION["id"];
                        $sql = "SELECT TEAM_NAME, ID, TEAM_MANAGER_ID
                        FROM TEAM
                        INNER JOIN TEAM_MEMBER_LIST ON TEAM.ID = TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_TEAM_ID
                        WHERE TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID='$id'
                        ORDER BY TEAM_NAME ASC;";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_array($result))
                        {
                            print '<tr>
                            <td>'.$row["TEAM_NAME"].'</td>
                            <td style="text-align: center;">';

                            $teamManID = $row["TEAM_MANAGER_ID"];
                            $sql2 = "SELECT USER_FIRSTNAME, USER_LASTNAME
                            FROM USER
                            WHERE ID='$teamManID'";
                            $result2 = mysqli_query($con, $sql2);
                            while($row2 = mysqli_fetch_array($result2))
                            {
                                print $row2["USER_FIRSTNAME"] . " " . $row2["USER_LASTNAME"];
                            }
                            print '</td>';
                            print '<td style="text-align: right;">
                                        <button id="team-delete" type="button" class="btn btn-default btn-xs" onclick="LeaveTeam('.$row["ID"].')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                   </td>
                                </tr>';
                        }
                        mysqli_close($con);
                        ?>
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
		  		$("#div-edit-name").toggle(10);
		  	});
		  	$("#pass-edit").click(function() {
		  		//$("#pass").toggle(1);
		  		$("#div-edit-pass").toggle(10);
		  	});
		  	$("#email-edit").click(function() {
		  		//$("#email").toggle(1);
		  		$("#div-edit-email").toggle(10);
		  	});



		  	$("#change-name").click(function() {
		  		//$("#name").toggle(1);
		  		$("#div-edit-name").toggle(10);
		  	});
		  	$("#cancel-name-change").click(function() {
		  		//$("#name").toggle(1);
		  		$("#div-edit-name").toggle(10);
		  	});


		  	$("#change-pass").click(function() {
		  		//$("#pass").toggle(1);
		  		$("#div-edit-pass").toggle(10);
		  	});
		  	$("#cancel-pass-change").click(function() {
		  		//$("#pass").toggle(1);
		  		$("#div-edit-pass").toggle(10);
		  	});


		  	$("#change-email").click(function() {
		  		//$("#email").toggle(1);
		  		$("#div-edit-email").toggle(10);
		  	});
		  	$("#cancel-email-change").click(function() {
		  		//$("#email").toggle(1);
		  		$("#div-edit-email").toggle(10);
		  	});
		  	</script>

<?php
	require "includes/footer.php";
?>