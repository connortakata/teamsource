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
						<!-- Chat goes here -->               
                             
						</div>
					</div>

					<div class="talk">
						<input id="GrpChatTxtInput" type="text" style="width:75%" placeholder="Type Your Message Here...">
						<button id="GrpChatbutton" style="margin-left: 3%;" align="right" type="button" class="btn btn-submit">Submit</button>
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

    var myDataRef = new Firebase("https://burning-fire-7708.firebaseio.com/chat");
      $("#GrpChatbutton").click(function () {
          var name = "Daniel"
          var text = $("#GrpChatTxtInput").val();
          myDataRef.push({name: name, text: text});
          $("#GrpChatTxtInput").val("");
      });
      myDataRef.on("child_added", function(snapshot) {
        var message = snapshot.val();
        displayChatMessage(message.name, message.text);
      });
      function displayChatMessage(name, text) {
        $("<p/>").text(text).prepend($("<b/>").text(name+": ")).appendTo($("#ChatBox"));
        $("#ChatBox")[0].scrollTop = $("#ChatBox")[0].scrollHeight;
      };
    </script>';
	require "includes/footer.php";
?>