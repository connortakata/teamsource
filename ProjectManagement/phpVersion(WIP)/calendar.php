<?php
require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";

print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Calendar</h1>
        </div>
		<link href="css/tables.css" rel="stylesheet">
		<div style="display:table; margin:0 auto;float:none; width:60%" class="well">

        <div id="CalendarPopUp" class="PopupShadow" style="display:none; position:fixed; top:30%; left:35%; width:400px; height:auto; z-index:10;">
            <div class="well" style="width:100%; height:100%;">
                <div class="panel panel-primary" style="top:25px; height:95%;">
                    <div class="panel-heading">
                        <input name="CalendarItem" id="CalendarTitle" type="text" class="form-control" placeholder="Event Title"/>
                    </div>
                    <div class="panel-body">
                        <input name="CalendarItem" id="CalendarDate" type="date" style="height:25px"/> at:
                        <input name="CalendarItem" id="CalendarTime" type="time" style="height:25px"/>
                        <br /><br />
                        Description
                        <div class="panel-info">
                            <textarea name="CalendarItem" id="CalendarDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;"  ></textarea>
                        </div>
                    </div>
                    <div class="btn-group">
                        <input type="button" id="CalAdd" value="Add" style="margin-left:233px; width:50px" onclick="AddEvent();HidePopUp(\'CalendarPopUp\', \'CalendarItem\')" />
                        <input type="button" value="Cancel" style="margin-left:10px;" onclick="HidePopUp(\'CalendarPopUp\', \'CalendarItem\');" />
                    </div>
                </div>
            </div>
        </div>
        	<div id="mainButtons" align="left" style="display:table; margin:0 auto; padding-bottom:10px">
            <!--<a href="add-task.html" rel="#overlay" stype="text-decoration:none">-->
            <button type="button" class="btn btn-default btn-med" onclick="DisplayPopUp(\'CalendarPopUp\')">
                <span class="glyphicon glyphicon-plus"></span> Add Event
            </button>
        </div>
		<ul style="display:table; margin:0 auto;" class="pagination">
        <li><a href="#">&laquo;</a></li>';
for($i = 1;$i<=12;$i++)
{
    if($i==date('m'))
    {
        print '<li class="active"><a href="#">'. date("M", mktime(0, 0, 0, $i, 10)) .'<span class="sr-only">(current)</span></a></li>';
    }
    else
    {
        print '<li><a href="#">' . date("M", mktime(0, 0, 0, $i, 10)) . '</a></li>';
    }
}
print '<li><a href="#">&raquo;</a></li>';
print '</ul>';
print '<table style="margin: 0px auto;" class="calender">
               <tr class="date">
                    <td class="days" width="11.43%">Sun</td>
                    <td class="days" width="11.43%">Mon</td>
                    <td class="days" width="11.43%">Tue</td>
                    <td class="days" width="11.43%">Wed</td>
                    <td class="days" width="11.43%">Thu</td>
                    <td class="days" width="11.43%">Fri</td>
                    <td class="days" width="11.43%">Sat</td>
               </tr>';

$dayNum = 0;
$dayDetail = 0;
$days = buildCalArray();
if(!isset($_POST["month"]))
    $month=date("n");
else
    $month=$_POST["month"];
if(!isset($_POST["year"]))
    $year=date("Y");
else
    $year=$_POST["year"];
if($month<10)
    $monthYear = $year."-0".$month;
else
    $monthYear = $year."-".$month;
$dayEvents = array(array());
$i=0;
$con = mysqli_connect('localhost','root','','teamsource');
$sql = "SELECT EVENT_TITLE, EVENT_DATETIME FROM EVENT WHERE EVENT_DATETIME LIKE '$monthYear%'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result))
{
    $date=substr($row["EVENT_DATETIME"],5,5);
    $title=substr($row["EVENT_TITLE"],0,15);
    if($date[0]=='0')
        $date=str_replace('0','',$date);
    $date=str_replace('-','/',$date);
    $dayEvents[$date]["title"]=$title;
    $i++;
}
for( $i=0; $i<count($days)/7; $i++)
{
    print '<tr class="date">';
    for( $j=0; $j<7; $j++)//Printing the day numbers
    {
        print '<td class="days" width="11.43%"';
        if(($days[$dayNum][0]<$month)||($days[$dayNum][0]>$month))
            print 'style="color:grey"';
        print '>';
        print substr($days[$dayNum],strpos($days[$dayNum],'/')+1);
        print '</td>';
        $dayNum++;
    }
    print '</tr>';
    print '<tr class="dayDetail">';



    for( $j=0; $j<7; $j++)//Printing the details of each day
    {
        print '<td class="days" width="11.43%">';
        if(isset($dayEvents[$days[$dayDetail]]))
            print $dayEvents[$days[$dayDetail]]["title"];
        print '</td>';
        $dayDetail++;
    }
    print '</tr>';
}
print '</table></div>';


function buildCalArray($month = NULL, $year=NULL)
{
    if($month == NULL)
        $month = date('n');
    if($year == NULL)
        $year =  date('Y');
    $firstDay=date('w',strtotime($month."/1/".$year));
    $numDaysCurrMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); //Get number of days in current month
    $numDaysPrevMonth = cal_days_in_month(CAL_GREGORIAN, $month-1, $year); //Number of days in last month
    $days = array();
    if($firstDay!=0)
    {
        while($firstDay>-1)
        {
            array_push($days, ($month-1)."/".($numDaysPrevMonth-$firstDay+1));
            $firstDay--; //Inserts the last days of the last month into the calendar
            if($firstDay<1)
                break;
        }
    }
    $day = 1;
    while($day<=$numDaysCurrMonth)
    {
        array_push($days, $month."/".$day); //Inserts the days of the current month into the calendar
        $day++;
    }
    $day = 1;
    while(count($days)<35)
    {
        array_push($days, ($month+1)."/".$day); //Inserts the first days of the next month into the calendar
        $day++;
    }
    return $days; //Finish with the built calendar
}
print '<script>
document.getElementById("CalendarMinute").innerHTML=selects;

    $("#CalAdd").click(function () {
            var controls = document.getElementsByName("CalendarItem");
            validatePopUp(controls, "Calendar");
        });
    function DisplayPopUp(PopId) {
    $("#" + PopId).show()
    }
    function HidePopUp(PopId, ItemsInPopId) {
        var aPopUp = document.getElementById(PopId);
        aPopUp.style.display = "none";
        var popItems = document.getElementsByName(ItemsInPopId);
        ClearData(ItemsInPopId);
    }
    function ClearData(object) {
        for (var i = 0; i < object.length; i++) {
            object[i].value = "";
        }
    }
    function AddEvent(){

        var xmlhttp;
        var title       = document.getElementById("CalendarTitle").value;
        var date        = document.getElementById("CalendarDate").value;
        //var timeHour    = document.getElementById("CalendarTimeHour").value;
        //var timeMinute  = document.getElementById("CalendarMinute").value;
        //var timeOfDay   = document.getElementById("CalendarAMPM").value;
        var description = document.getElementById("CalendarDes").value;
        var theTime = document.getElementById("CalendarTime").value;

        theTime = theTime.replace(":","")

        if( (title!=\'\') && (date!=\'\')){
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }
            else{
                xmlhttp = new ActiveXoject("Mircosoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function() {
                if( xmlhttp.readyState==4 && xmlhttp.status==200 ){

                }
            }
            xmlhttp.open("POST", "../AJAXapps/calendar/addEvent.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //xmlhttp.send("title=" + title + "&date=" + date  + "&timeHour=" + timeHour + "&timeMinute" + timeMinute + "&timeOfDay" + timeOfDay + "&description=" + description);
            xmlhttp.send("title=" + title + "&date=" + date  + "&theTime=" + theTime + "&description=" + description);
        }
    }
    </script>';
require "includes/footer.php";
?>