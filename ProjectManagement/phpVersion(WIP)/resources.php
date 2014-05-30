<?php
require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";
require "functions/resourcesFunctions.php";
require "functions/mysqlFunctions.php";

print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Resources</h1>
        </div>
		<div style="display:table; margin:0 350px; float:none; width:60%" class="well">
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<b><p for="file" style="text-align: center">Upload Documents</p></b>
			<table>
				<tr>';

//Select the team's file manager to identify with
$teamID = $_SESSION["team"];
$fileID = getTeamSubId($teamID,"FILE");

//Now we check to see if the team has uploaded too much file space.
$fileSize = getUsedStorageSpace($teamID);

$teamName = getTeamName($teamID);
print '<td style="width:50%">Files for team '.$teamName.'</td>';

$remainingSpace = getRemainingStorageSpace($fileSize);
print '<td style="width:50%">Remaining Space: '.$remainingSpace.'</td>';
if($fileSize<2000000000)//If the team has uploaded more than 2gb, hide the upload function
{
    print '<td style="width:50%;">
    <!--<button id="btnUpload" type="button" class="btn btn-default">Upload</button>-->
    <form action="AJAXapps/resources/upload_file.php" method="post" enctype="multipart/form-data">

    <input type="file" name="file" id="file">


    </td>
    <td>
        <button type="submit" style="float: right;" class="btn btn-default" name="submit">Upload</button></form>
    </td>';
}
else
    print'<td>Your team\'s file cap has been reached or will be reached with this file. Please delete some files or upload a smaller file.';

print '

				</tr>
			</table>
		</div>
			<div class="panel-body">				
				Your Documents
			</div>
			<!-- Table -->
			<table class="table">
				<tr>
					<td>File Name</td>
					<td style="text-align:right">Added</td>
					<td style="text-align:right">Size</td>
					<td style="text-align:right">Action</td>
				</tr>';printFilesList($teamID);
print '</table>
		</div>
	  </div>';
require "includes/footer.php";
