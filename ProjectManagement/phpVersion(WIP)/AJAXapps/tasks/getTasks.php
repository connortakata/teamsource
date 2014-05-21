<?php

require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
	$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
    $finished = $_REQUEST['finished'];    
	$sql = "SELECT * FROM task WHERE TASK_IS_FINISHED = $finished ORDER BY TASK_DUE_DATE ASC;";
	$result = mysqli_query($con, $sql);
		
	while($row = mysqli_fetch_array($result))
	{
			echo "<a href='#' class='list-group-item'>";
       		echo	"<h4 class='list-group-item-heading'>"; 
		    echo	"<table width='100%'>";
		    echo		"<td name='TaskTitle' style='width:200px;' size='15';><input type='checkbox'> " . $row['TASK_TITLE'] . "</td>";
		    echo	    "<td style='width:200px;text-align:right' onclick='EditPopup(" .  $row['ID'] . ")' > Due: " . $row['TASK_DUE_DATE'] ."</td>";
		    echo		"<td style='width:200px; text-align:center' onclick='EditPopup(" . $row['ID'] . ")' >To: " . $row['TASK_ASSIGNED_TO'] . "</td>";
		    echo		"<td style='width:150px; text-align:right' onclick='EditPopup(" . $row['ID']  . ")' >Priority: " . $row['TASK_PRIORITY'] . "</td>";
		    echo	"</table>";
		    echo	"</h4>";
		    echo "</a>";	
	}
	mysqli_close($con);
}
else
    header("Location:../../index.php");