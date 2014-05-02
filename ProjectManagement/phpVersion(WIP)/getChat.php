<?php
	$con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
	mysqli_select_db($con, "teamsource");
	$sql = "SELECT * FROM message;";
	$result = mysqli_query($con, $sql);
	
	echo "<table>";
	
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
        echo "<td style='width:15%; text-align:left;'><b>" . $row['MESSAGE_USER_ID'] . ": " . "</b></td>";
        echo "<td style='width:60%;'>" . $row['MESSAGE_TEXT'] . "</td>";
        echo "<td style='width:20%;'>" . $row['MESSAGE_TIME'] . "</td>";
        echo "</tr>";
	}
	
	echo "</table>";
	mysqli_close($con);
?>