<?php
require "../../includes/userAuth.php";

if(isLoggedIn()&&isInTeam())
{
	$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");

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
        echo "<td style='width:20%; text-align:right;'>" . $userArray['USER_FIRSTNAME'] . " " . $userArray['USER_LASTNAME'];
        echo ": </td>";
        echo "<td style='width:2%'/>";
        echo "<td style='width:80%;'>" . $row['MESSAGE_TEXT'] . "</td>";
        echo "<td style='width:10px'/>";
        
        if($row['MESSAGE_DATE'] == date('Y-m-d'))
    	{
   	 		echo "<td style='width:20%; text-align:left;'>  " . $row['MESSAGE_TIME'] . "</td>";
    	}
    	else 
    	{
    		echo "<td style='width:20%; text-align:left'><font size=1>" . $row['MESSAGE_DATE'] . "</font></td>";
    	}
    	echo "</tr>";

	}
	
	echo "</table>";
	mysqli_close($con);
}
else
    header("Location:../../index.php");