<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>

			<div align="left" style="display:table; width:50%; height: 500px; margin-right: 25px;" class="well">
				<div class="panel panel-default">
				<!-- Default panel contents -->
					<div class="panel-heading"><b>Group Chat:</b></div>
						<div id="ChatBox" class="panel-body" style="height: 400px; overflow-y: scroll;">      <!--CHANGE SCROLL to AUTO for non-prototype build-->
						<!-- Chat goes here --> ';              
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
							echo "<td style='width:50px;'><b>" . $row['UserName'] . ": " . "</b></td>";
							echo "<td style='width:200px;'>" . $row['Message'] . "</td>";
							echo "<td style='width:150px;'>" . $row['TimpStamp'] . "</td>";
							echo "</tr>";
						}
						
						echo "</table>";
						mysqli_close($con);
               
	print	'			</div>
					</div>

					<div class="talk">
						<input id="GrpChatTxtInput" type="text" style="width:75%" placeholder="Type Your Message Here...">
						<button id="GrpChatbutton" style="margin-left: 3%;" onclick="submitToChat(); getChat();" align="right" type="button" class="btn btn-submit">Submit</button>
					</div>

			</div>
			<div style="display:table; width:40%; height: 200px;" class ="well">
				<div class="panel panel-default" style="float:middle;">
					<div class="panel-heading"><b>Team Roster:</b></div>
					<div class="panel-body" style="height: 150px;">
						<p><b>Drew Howard</b> - Client</p>
						<p><b>Connor Takata</b> - Team Manager / Satans Mistress</p>
						<p><b>Daniel Franz</b> - Code Master</p>
						<p><b>Joe Jazdzewski</b> - Code Master</p>
		     
					</div>
				</div>
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

      function submitToChat() {
      		var xmlhttp;
      		var user = "Joe"
      		var date = new Date(); 
      		var myMessage = document.getElementById("GrpChatTxtInput").value;
      		if(validateMessage(myMessage) != 0)
      			return;
      		if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			        var str = xmlhttp.responseText;
                    if(str != "")
                    {
                        DisplayAlertPopUp("Error", str);
                    }
			    }
			  }
			xmlhttp.open("POST","addToChat.php",false);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("user=" + user +  "&message=" + myMessage + "&TimeStamp=" + date.toLocaleString());
            document.getElementById("GrpChatTxtInput").value = "";
			
      }
      function getChat(){
        setTimeout(function(){}, 1000);
        var xmlhttp;
        if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
            xmlhttp.onreadystatechange=function()
			  {
			      if (xmlhttp.readyState==4 && xmlhttp.status==200)
			        {
			            var test = document.getElementById("ChatBox");
                        test.innerHTML=xmlhttp.responseText;
			        }
			  }
			var my = document.getElementById("ChatBox");
			xmlhttp.open("GET","getChat.php",false);
			xmlhttp.send();
      }
</script>';
	require "includes/footer.php";
?>