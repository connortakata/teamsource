<?php
require "../../includes/userAuth.php";
if(isLoggedIn())
{
    $con = mysqli_connect("localhost", "root", "", "teamsource");

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $ID=$_POST["id"];
    mysqli_select_db($con, "teamsource");
    $sql = "SELECT * FROM EVENT WHERE ID='$ID';";

    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result))
    {
        echo '
        <div class="well" style="width:100%; height:auto;">
            <div class="panel panel-primary" style="height:auto">
              <div class="panel panel-primary" style="top:25px; height:95%;">
                       <div class="panel-heading">
                            <input name="EventItem" id="CalendarEditTitle" value="'.$row["EVENT_TITLE"].'" type="text" disabled="disabled" class="form-control"/>
                        </div>
                        <input id="CalendarEditId" style="display: none;" value="'.$ID.'"></input>
                        <div class="panel-body">
                            <input name="EventItem" disabled="disabled" value="'.substr($row["EVENT_DATETIME"],0,10).'" id="CalendarEditDate" type="date" style="height:25px"/> at:
                            <input name="EventItem" disabled="disabled" value="'.substr($row["EVENT_DATETIME"],11).'"id="CalendarEditTime" type="time" style="height:25px"/>
                            <br /><br />
                            Description
                            <div class="panel-info">
                                <textarea disabled="disabled" name="EventItem" id="CalendarEditDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;"  >'.$row["EVENT_DESCRIPTION"].'</textarea>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button id="btnSelEdit" type="button" class="btn btn-default" onclick="EditSelectedPopup();"><span class="glyphicon glyphicon-wrench"></span> Edit</button>
                            <button id="btnSelDelete" type="button" class="btn btn-default" onclick="HideSelectedPopup();"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                            <button id="btnSelClose" type="button" class="btn btn-default" onclick="HideSelectedPopup();"> Close</button>
                        </div>
                    </div>
              </div>
            </div>
       ';
    }
}
else
    header("Location:../../index.php");