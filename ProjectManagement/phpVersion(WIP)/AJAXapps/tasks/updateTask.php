<?php
require "../../includes/userAuth.php";
if(isLoggedIn()&&isInTeam())
{
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    $stmt = $mysqli->prepare("UPDATE task SET TASK_TITLE = ? , TASK_DESCRIPTION = ?, TASK_DUE_DATE = ?, TASK_PRIORITY = ?, TASK_ASSIGNED_TO = ?, TASK_ISSUED_BY = ? WHERE ID = ?;");
    $stmt->bind_param("ssssssi", $title, $description, $dueDate, $priority, $to, $by, $Taskid);
    $Taskid = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $dueDate = $_REQUEST['dueDate'];
    $priority = $_REQUEST['priority'];
    $to = $_REQUEST['toWhom'];
    $by = $_REQUEST['byWhom'];
    $stmt->execute();
    //mysqli_query($con, "UPDATE task SET TASK_TITLE = '$title' , TASK_DESCRIPTION = 'addSlashes($description)', TASK_DUE_DATE = '$dueDate', TASK_PRIORITY = '$priority', TASK_ASSIGNED_TO = '$to', TASK_ISSUED_BY = '$by' WHERE ID = $id;");
    $mysqli->close();
}
else
    header("Location:../../index.php");