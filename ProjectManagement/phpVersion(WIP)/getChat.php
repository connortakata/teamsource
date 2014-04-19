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
		echo "<td>" . $row['UserName'] . ":" . "</td>";
		echo "<td>" . $row['Message'] . "</td>";
		echo "<td>" . $row['TimpStamp'] . "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	mysqli_close($con);
?>