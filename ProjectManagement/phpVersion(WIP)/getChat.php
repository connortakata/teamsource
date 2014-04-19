<?php
	$con = mysqli_connect("localhost", "root", "", "chat");

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }    
	mysqli_select_db($con, "chat");
	$sql = "SELECT * FROM mychat;";
	$result = mysqli_query($con, $sql);
	
	echo "<table>";
	
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td style='width:100px;'><b>" . $row['UserName'] . ": " . "</b></td>";
		echo "<td style='width:200px;'>" . $row['Message'] . "</td>";
		echo "<td style='width:100px;'>" . $row['TimpStamp'] . "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	mysqli_close($con);
?>