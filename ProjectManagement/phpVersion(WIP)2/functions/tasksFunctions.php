<?php
function getTaskIssuer()
{

    $id = $_SESSION["id"];
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT USER_FIRSTNAME FROM user WHERE ID = '$id'");
    $stmt->execute();
    $res = $stmt->get_result();

    print 'Task Issued By: <Label><input type="hidden" name="popItem" id="IssuedBy" value="';
    while($row = mysqli_fetch_array($res))
    {
        echo $row['USER_FIRSTNAME'] . '"/>'. $row['USER_FIRSTNAME'];
    }
    $mysqli->close();
    print '</label>';
}

function getTaskTeamMembers($teamID)
{
    //Assign task to someone on your team
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT USER_FIRSTNAME
    FROM USER
    INNER JOIN TEAM_MEMBER_LIST
    ON USER.ID=TEAM_MEMBER_LIST.TEAM_MEMBER_LIST_USER_ID
    WHERE TEAM_MEMBER_LIST_TEAM_ID='$teamID'");
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = mysqli_fetch_array($res))
    {
        echo'<option>' . $row['USER_FIRSTNAME'] . '</option>';
    }
    $mysqli->close();
}

function getTasks($teamID)
{
    $taskManID = getTeamSubId($teamID,"TASK");
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT * FROM task
   				        where TASK_IS_FINISHED = 0
   				        and TASK_TASK_MANAGER_ID = '$taskManID'
   				        ORDER BY TASK_DUE_DATE ASC;");
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = mysqli_fetch_array($res))
    {
        echo "<a href='#' class='list-group-item' ondblclick='EditPopup(" .  $row['ID'] . ")'>";
        echo	"<h4 class='list-group-item-heading'>";
        echo	"<table width='100%'>";
        echo		"<td name='TaskTitle' style='width:200px;' size='15';>" . $row['TASK_TITLE'] . "</td>";
        echo	    "<td style='width:200px;text-align:right'> Due: " . $row['TASK_DUE_DATE'] ."</td>";
        echo		"<td style='width:200px; text-align:center'> To: " . $row['TASK_ASSIGNED_TO'] . "</td>";
        echo		"<td style='width:150px; text-align:right'> Priority: " . $row['TASK_PRIORITY'] . "</td>";
        echo	"</table>";
        echo	"</h4>";
        echo "</a>";
    }
    $mysqli->close();
}