<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";
    require "functions/indexFunctions.php";

	print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>

			<div align="left" style="display:table; width:95%; height: 500px; margin-right: 25px;" class="well">
				<div class="panel panel-default">
				<!-- Default panel contents -->
					<div class="panel-heading"><b>Group Chat:</b></div>
						<div id="ChatBox" class="panel-body" style="height: 400px; overflow-y: scroll; bottom:0;">      <!--CHANGE SCROLL to AUTO for non-prototype build-->
						<!-- Chat goes here --> ';
                        $teamID = $_SESSION["team"];
              			getTeamChat($teamID);
	print	'	</div>
			</div>

			<div class="talk">
				<input id="GrpChatTxtInput" type="text" style="width:85%" placeholder="Type Your Message Here..." onkeydown="if (event.keyCode == 13) document.getElementById(\'GrpChatbutton\').click()">
				<button id="GrpChatbutton" style="margin-left: 3%;" onclick="submitToChat(); getChat();" align="right" type="button" class="btn btn-submit">Submit</button>
			</div>

			</div>
    <script>
	$(document).ready(function(){
		var objDiv = document.getElementById("ChatBox");
		objDiv.scrollTop = objDiv.scrollHeight;
	});
    </script>';
	require "includes/footer.php";
?>