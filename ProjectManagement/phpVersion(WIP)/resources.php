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
			<table>
				<tr>
					<td style="width:50%">Files for team &lsaquo;team&rsaquo;</td>
					<td style="width:50%;">
						<!--<button id="btnUpload" type="button" class="btn btn-default">Upload</button>-->
						<form action="includes/upload_file.php" method="post" enctype="multipart/form-data">
                        <label for="file">Upload:</label>
                        <input type="file" name="file" id="file">
                        <button type="submit" class="btn btn-sm" name="submit">Submit</button>
                        </form>
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
	  </div>';
	require "includes/footer.php";
?>