<?php
function getUsedStorageSpace($teamID)
{
    $fileID = getTeamSubId($teamID,"FILE");
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
    return $fileSize;
}

function getRemainingStorageSpace($fileSize = null)
{
    $remainingSpace = (2000000000-$fileSize);
    if($remainingSpace>1000000000)
    {
        $remainingSpace = substr($remainingSpace/(1000*1000*1000),0,3)."gB";
    }
    else if($remainingSpace>1000000)
    {
        $remainingSpace = substr($remainingSpace/(1000*1000),0,3)."mB";
    }
    else
    {
        $remainingSpace = substr($remainingSpace/(1000),0,3)."kB";
    }
    return $remainingSpace;
}

function printFilesList($teamID)
{
    $con = mysqli_connect("localhost", "root", "TeamSource1!", "teamsource");
    $fileID = getTeamSubId($teamID,"FILE");
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
}