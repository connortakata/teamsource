﻿<?php
	$con = mysqli_connect("localhost", "root", "", "chat");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
	mysqli_select_db($con, "chat");
	$sql = "SELECT * FROM mytasks;";
	$result = mysqli_query($con, $sql);
	
	echo "<table>";
	
	while($row = mysqli_fetch_array($result))
	{
			echo "<a href='#' class='list-group-item'>";
       		echo	"<h4 class='list-group-item-heading'>"; 
		    echo	"<table width='100%'>";
		    echo		"<td name='TaskTitle' style='width:200px;' size='15';><input type='checkbox'> " . $row['title'] . "</td>";
		    echo	    "<td style='width:200px;text-align:right' onclick='EditPopup(" . '"'  $row['id'] . '"' . ")' >" + "Due: " . $row['dueDate'] ."</td>";
		    echo		"<td style='width:200px; text-align:center' onclick='EditPopup(" . '"' . $row['id'] . '"' . ")' >To: " . $row['to'] . "</td>";
		    echo		"<td style='width:150px; text-align:right' onclick='EditPopup(" . '"' . $row['id'] . '"' . ")' >Priority: " . $row['priority'] . "</td>";
		    echo	"</table>";
		    echo	"</h4>";
		    echo "</a>";	
	}
	
	echo "</table>";
	mysqli_close($con);
?>