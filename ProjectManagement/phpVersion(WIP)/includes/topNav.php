<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Team Source</a>
		</div>
        <script src="../js/AJAX_lib.js"></script>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
                <li>
                    <div style="padding-top:8px;padding-left:8px" class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
                            $id = $_SESSION["id"];
                            $sql = "SELECT USER_FIRSTNAME FROM USER WHERE ID='$id';";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_array($result))
                            {
                                print $row["USER_FIRSTNAME"];
                            }
                            mysqli_close($con);
                            ?>
                            's Teams <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
                            $id = $_SESSION["id"];
                            $sql = "SELECT TEAM_NAME, ID
                                    FROM TEAM
                                    INNER JOIN TEAM_MEMBER_LIST ON TEAM.ID = TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_TEAM_ID
                                    WHERE TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID='$id'
                                    ORDER BY TEAM_NAME ASC;";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_array($result))
                            {
                                if($row["ID"]==$_SESSION["team"])
                                    print '<li class="active">';
                                else
                                    print '<li>';
                                print '<a href="#" onclick="SelectTeam('.$row["ID"].');">';
                                print $row["TEAM_NAME"];
                                print '</a></li>';
                            }
                            mysqli_close($con);
                            ?>
                        </ul>
                    </div>

                </li>
				<li><a href="team.php">Manage Teams</a></li>
				<li><a href="Settings.php">Settings</a></li>
				<li><a href="#" onclick="LogOut();">Sign Out</a></li>
			</ul>
		</div>
	</div>
</div>