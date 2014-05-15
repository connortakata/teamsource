<?php
session_start();
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
        $id = $row['MESSAGE_USER_ID'];
        $userArray =  mysqli_fetch_array(mysqli_query($con, "SELECT USER_FIRSTNAME, USER_LASTNAME FROM USER WHERE ID='$id'"));
        echo "<td style='width:50px; text-align:right;'>" . $userArray['USER_FIRSTNAME'] . " " . $userArray['USER_LASTNAME'];
        echo ": </td>";
        echo "<td width='10px'/>";
        echo "<td style='width:200px;'>" . $row['MESSAGE_TEXT'] . "</td>";
        if($row['MESSAGE_DATE'] == date('Y-m-d'))
    	{
   	 		echo "<td style='width:60px;'>  " . $row['MESSAGE_TIME'] . "</td>";
    	}
    	else 
    	{
    		echo "<td style='width:60px;'><font size=1>" . $row['MESSAGE_DATE'] . "</font></td>";
    	}
    	echo "</tr>";
	}
	
	echo "</table>";
	mysqli_close($con);
?>