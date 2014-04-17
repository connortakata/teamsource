<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
		<div style="display:table; margin:0 250px; float:none; width:40%" class="well">
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<table>
				<tr>
					<td style="width:70%">Files for team &lsaquo;team&rsaquo;</td>
					<td style="width:25%"></td>
					<td style="width:5%"></td>
					<td style="width:10%;">
						<button id="btnUpload" type="button" class="btn btn-default" >Upload</button>
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
					<td style="text-align:right">Modified</td>
					<td style="text-align:right">Size</td>
					<td style="text-align:right">Action</td>
				</tr>
				<tr>
					<td>file1.txt</td>
					<td style="text-align:right">Mar 13, 2014</td>
					<td style="text-align:right">12:28pm</td>
					<td style="text-align:right">121kb</td>
					<td style="text-align:right">
						<button id="btnDownload" type="button" class="btn btn-default" onclick="btnDownloadClick()">Download</button>
					</td>
				</tr>
			</table>
		</div>
	  </div>
	END';
	require "includes/footer.php";
?>