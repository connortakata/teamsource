<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>

			<div align="left" style="display:table; width:95%; height: 500px; margin-right: 25px;" class="well">
				<div class="panel panel-default">
				<!-- Default panel contents -->
					<div class="panel-heading"><b>Group Chat:</b></div>
						<div id="ChatBox" class="panel-body" style="height: 400px; overflow-y: scroll; bottom:0;">      <!--CHANGE SCROLL to AUTO for non-prototype build-->
						<!-- Chat goes here --> ';              
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
               
	print	'	</div>
			</div>

			<div class="talk">
				<input id="GrpChatTxtInput" type="text" style="width:85%" placeholder="Type Your Message Here..." onkeydown="if (event.keyCode == 13) document.getElementById(\'GrpChatbutton\').click()">
				<button id="GrpChatbutton" style="margin-left: 3%;" onclick="submitToChat(); getChat();" align="right" type="button" class="btn btn-submit">Submit</button>
			</div>

			</div>
			
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script>
    /* 	this a prototype of how the javascript functions are going to work 
     	this currently uses firebase as a way to track the chat, 
    	which will only work for our chat for our group.
    	This will be in place till we have a database in place.
    */
	$(document).ready(function(){
		var objDiv = document.getElementById("ChatBox");
		objDiv.scrollTop = objDiv.scrollHeight;
	});
    </script>';
	require "includes/footer.php";
?>