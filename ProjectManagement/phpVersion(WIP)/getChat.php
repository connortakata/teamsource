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
        echo "<td style='width:15%; text-align:left;'><b>" . $row['UserName'] . ": " . "</b></td>";
        echo "<td style='width:60%;'>" . $row['Message'] . "</td>";
        echo "<td style='width:20%;'>" . $row['TimpStamp'] . "</td>";
        echo "</tr>";
	}
	
	echo "</table>";
	mysqli_close($con);
?>