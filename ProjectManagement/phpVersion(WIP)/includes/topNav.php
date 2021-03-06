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

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
                <li>
                    <div style="padding-top:8px;padding-left:8px" class="btn-group">
                        <?php
                        $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
                        if(isset($_SESSION["team"]))
                        {
                            $teamID = $_SESSION["team"];
                            $stmt= $mysqli->prepare("SELECT TEAM_NAME FROM TEAM WHERE ID='$teamID'");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            while($row = mysqli_fetch_array($res))
                            {
                                print'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">';
                                print $row["TEAM_NAME"];
                                print '  <span class="caret"></span></button>';
                            }
                        }
                        print '<ul class="dropdown-menu" role="menu">';
                        $id = $_SESSION["id"];
                        $stmt= $mysqli->prepare("SELECT TEAM_NAME, ID
                                FROM TEAM
                                INNER JOIN TEAM_MEMBER_LIST ON TEAM.ID = TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_TEAM_ID
                                WHERE TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID='$id'
                                ORDER BY TEAM_NAME ASC;");
                        $stmt->execute();
                        $res = $stmt->get_result();
                        while($row = mysqli_fetch_array($res))
                        {
                            if(isset($_SESSION["team"])&&($row["ID"]==$_SESSION["team"]))
                                print '<li class="active">';
                            else
                                print '<li>';
                            print '<a href="#" onclick="SelectTeam('.$row["ID"].');">';
                            print $row["TEAM_NAME"];
                            print '</a></li>';
                        }
                        $mysqli->close();

                        print '</ul>';

                ?></div>

                </li>
				<li><a href="team.php">Manage Teams</a></li>
				<li><a href="Settings.php">Settings</a></li>
				<li><a href="#" onclick="LogOut();">Sign Out</a></li>
			</ul>
		</div>
	</div>
</div>