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
					<td style="width:50%">Files for team &lsaquo;team&rsaquo;</td>';

//Select the team's file manager to identify with
$teamID = $_SESSION["team"];
$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
$sql = "SELECT ID FROM FILEMANAGER WHERE FILE_MANAGER_TEAM_ID='$teamID'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result))
{
    $fileID = $row[0];
}
//Now we check to see if the team has uploaded too much file space.
$teamID = $_SESSION["team"];
$con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
$sql = "SELECT FILE_SIZE FROM FILE WHERE FILE_FILE_MANAGER_ID='$fileID'";
$result = mysqli_query($con,$sql);
$fileSize=0;
while($row = mysqli_fetch_array($result))
{
    if(substr($row[0],strlen($row[0])-2,1)=='m')
        $fileSize += $row[0]*1024*1024;
    else if(substr($row[0],strlen($row[0])-2,1)=='k')
        $fileSize += $row[0]*1024;
    else
        $fileSize += $row[0];
}
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
				</tr>';


$sql = "SELECT * FROM file WHERE FILE_FILE_MANAGER_ID = '$fileID'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    print '<tr>';
    print '<td>' . $row['FILE_NAME'] . '</td>';
    print '<td style="text-align:right">' . $row['FILE_DATE'] . '</td>';
    print '<td style="text-align:right">' . $row['FILE_SIZE'] . '</td>';
    print ' <td style="text-align:right">
		    <a id="btnDownload" href="AJAXapps/resources/download.php?fileName='.$row["FILE_NAME"].'" class="btn btn-primary btn-sm active" target="_blank" >Download</a>
		    <a id="btnDelete" href="AJAXapps/resources/deleteFile.php?fileName='.$row["FILE_NAME"].'&id='.$row["ID"].'" target="_blank" ><span class="glyphicon glyphicon-trash"></span></a>
		    </td>';
    print '</tr>';
}
print '</table>
		</div>
	  </div>';
require "includes/footer.php";
