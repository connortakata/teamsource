<?php
require "../../includes/userAuth.php";
require "../../functions/mysqlFunctions.php";
if(isLoggedIn()&&isInTeam())
{
    //Select the team's task manager to identify with
    $teamID = $_SESSION["team"];
    $taskManID = getTeamSubId($teamID,"TASK");

    $finished = $_REQUEST['finished'];
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT * FROM task
	 WHERE TASK_IS_FINISHED = '$finished'
	 AND TASK_TASK_MANAGER_ID = '$taskManID'
	 ORDER BY TASK_DUE_DATE ASC;");
    $stmt->execute();
    $res = $stmt->get_result();
		
	while($row = mysqli_fetch_array($res))
	{
			echo "<a href='#' class='list-group-item'>";
       		echo	"<h4 class='list-group-item-heading'>"; 
		    echo	"<table width='100%'>";
		    echo		"<td name='TaskTitle' style='width:200px;' size='15';>" . $row['TASK_TITLE'] . "</td>";
		    echo	    "<td style='width:200px;text-align:right' onclick='EditPopup(" .  $row['ID'] . ")' > Due: " . $row['TASK_DUE_DATE'] ."</td>";
		    echo		"<td style='width:200px; text-align:center' onclick='EditPopup(" . $row['ID'] . ")' >To: " . $row['TASK_ASSIGNED_TO'] . "</td>";
		    echo		"<td style='width:150px; text-align:right' onclick='EditPopup(" . $row['ID']  . ")' >Priority: " . $row['TASK_PRIORITY'] . "</td>";
		    echo	"</table>";
		    echo	"</h4>";
		    echo "</a>";	
	}
	$mysqli->close();
}
else
    header("Location:../../index.php");