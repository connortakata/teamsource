<?php
$con = mysqli_connect("localhost", "root", "", "teamsource");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$ID=$_REQUEST["ID"];
mysqli_select_db($con, "teamsource");
$sql = "SELECT * FROM EVENT WHERE ID='$ID';";

$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result))
{
    echo '<div id="EventPopUp" class="PopupShadow" style="display:none; position:fixed; top:30%; left:35%; width:400px; height:auto; z-index:10;">
            <div class="well" style="width:100%; height:100%;">
                <div class="panel panel-primary" style="top:25px; height:95%;">
                    <div class="panel-heading">
                        <input name="EventItem" id="CalendarTitle" type="text" class="form-control" value="'.$row["EVENT_TITLE"].'"/>
                    </div>
                    <div class="panel-body">
                        <input name="EventItem" id="CalendarDate" type="date" value="'.substr($row["EVENT_DATETIME"],0,10).'" style="height:25px"/> at:
                        <input name="EventItem" id="CalendarTime" type="time" value="'.substr($row["EVENT_TITLE"],11,5).'"style="height:25px"/>
                        <br /><br />
                        Description
                        <div class="panel-info">
                            <textarea name="EventItem" id="CalendarDes" rows="5" value="'.$row["EVENT_DESCRIPTION"].'"class="form-control" style="height:50%; width:100%; resize:none;"  ></textarea>
                        </div>
                    </div>
                    <div class="btn-group">
                        <input type="button" id="CalAdd" value="Update" style="margin-left:150px;" onclick="HidePopUp(\'EventPopUp\', \'EventItem\')" />
                        <input type="button" value="Delete" style="margin-left:10px;" onclick="HidePopUp(\'EventPopUp\', \'EventItem\');" />
                        <input type="button" value="Cancel" style="margin-left:10px;" onclick="HidePopUp(\'EventPopUp\', \'EventItem\');" />
                    </div>
                </div>
            </div>
        </div>';
}
