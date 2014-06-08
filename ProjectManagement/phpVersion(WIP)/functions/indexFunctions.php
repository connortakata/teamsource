<?php
function getTeamChat($teamID)
{
    $boardID = getTeamSubId($teamID,"MESSAGE");
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT * FROM MESSAGE WHERE MESSAGE_MESSAGE_BOARD_ID='$boardID';");
    $stmt->execute();
    $res = $stmt->get_result();
    echo "<table>";

    while($row = mysqli_fetch_array($res))
    {
        echo "<tr>";
        $id = $row['MESSAGE_USER_ID'];
        $stmt= $mysqli->prepare("SELECT USER_FIRSTNAME, USER_LASTNAME FROM USER WHERE ID='$id'");
        $stmt->execute();
        $userRes = $stmt->get_result();
        $userArray =  mysqli_fetch_array($userRes);//Getting the chatter's first and last name
        echo "<td style='width:20%; text-align:right;'>" . $userArray['USER_FIRSTNAME'] . " " . $userArray['USER_LASTNAME'];
        echo ": </td>";
        echo "<td style='width:2%'/>";
        echo "<td style='width:80%;'>" . $row['MESSAGE_TEXT'] . "</td>";
        echo "<td style='width:10px'/>";

        if($row['MESSAGE_DATE'] == date('Y-m-d'))
        {
            echo "<td style='width:20%; text-align:left;'>  " . $row['MESSAGE_TIME'] . "</td>";
        }
        else
        {
            echo "<td style='width:20%; text-align:left'><font size=1>" . $row['MESSAGE_DATE'] . "</font></td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    $mysqli->close();
}