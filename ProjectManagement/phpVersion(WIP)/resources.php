<?php
require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";

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
				<tr>
					<td style="width:50%">Files for team &lsaquo;team&rsaquo;</td>
					<td style="width:50%;">
						<!--<button id="btnUpload" type="button" class="btn btn-default">Upload</button>-->
						<form action="../AJAXapps/resources/upload_file.php" method="post" enctype="multipart/form-data">

                        <input type="file" name="file" id="file">
                        

					</td>
					<td>
						<button type="submit" style="float: right;" class="btn btn-default" name="submit">Upload</button></form>
					</td>
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
				</tr>';

//Select the team's file manager to identify with
$teamID = $_SESSION["team"];
$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
$sql = "SELECT ID FROM FILEMANAGER WHERE FILE_MANAGER_TEAM_ID='$teamID'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result))
{
    $fileID = $row[0];
}
$sql = "SELECT * FROM file WHERE FILE_FILE_MANAGER_ID = '$fileID'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    print '<tr>';
    print '<td>' . $row['FILE_NAME'] . '</td>';
    print '<td style="text-align:right">' . $row['FILE_DATE'] . '</td>';
    print '<td style="text-align:right">' . $row['FILE_SIZE'] . '</td>';
    print '<td style="text-align:right">
						<button id="btnDownload" type="button" class="btn btn-default" onclick="window.location = \'upload/'.$row['FILE_NAME'].'\'")">Download</button>
					</td>';
    print '</tr>';
}
print '</table>
		</div>
	  </div>';
require "includes/footer.php";
