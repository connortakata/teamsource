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
		<div id="mainButtons" align="left" style="display:table; margin:0 auto; padding-bottom:10px">
            <!--<a href="add-task.html" rel="#overlay" stype="text-decoration:none">-->
              <button type="button" class="btn btn-default btn-med" onclick="DisplayPopUp(\'CalendarPopUp\')">
                <span class="glyphicon glyphicon-plus"></span> Add Event
              </button>
        </div>
        <div id="CalendarPopUp" class="PopupShadow" style="display:none; position:fixed; top:30%; left:35%; width:400px; height:auto; z-index:10;">
        <div class="well" style="width:100%; height:100%;">
            <div class="panel panel-primary" style="top:25px; height:95%;">
                <div class="panel-heading">
                    <input name="CalendarItem" id="CalendarTitle" type="text" class="form-control" placeholder="Calendar Title">
                </div>
                <div class="panel-body">
                    <input name="CalendarItem" id="AssignDate" type="date" style="height:25px"/><br /><br />
                    Description
                    <div class="panel-info">
			    	    <textarea name="CalendarItem" id="CalendarDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;"  ></textarea>
			        </div>
                </div>
                <div class="btn-group">
                    <input type="button" id="CalAdd" value="Add" style="margin-left:233px; width:50px" />
                    <input type="button" value="Cancel" style="margin-left:10px;" onclick="HidePopUp(\'CalendarPopUp\', \'CalendarItem\');" />
                </div>
            </div>
        </div>
    </div>
		<ul style="display:table; margin:0 auto;" class="pagination">';
print   '<li><a href="#">&laquo;</a></li>';
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
$day = 0;
$days = buildCalArray();
for( $i=0; $i<count($days)/7; $i++)
{
    print '<tr class="date">';
    for( $j=0; $j<7; $j++)//Printing the day numbers
    {
        print '<td class="days" width="11.43%"';
        if(($i==0&&$days[$day]>20)||($days[$day]<7&&$i==(count($days)/7)-1))
            print 'style="color:grey"';
        print '>';
        print $days[$day];
        print '</td>';
        $day++;
    }
    print '</tr>';
    print '<tr class="dayDetail">';
    for( $j=0; $j<7; $j++)//Printing the details of each day
    {
        print '<td class="days" width="11.43%"></td>';
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
    $firstDay = date('w', strtotime(date("F", mktime(0, 0, 0, $month, 10)))); //Get first day of the week of the month
    $numDaysCurrMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); //Get number of days in current month
    $numDaysPrevMonth = cal_days_in_month(CAL_GREGORIAN, $month-1, $year); //Number of days in last month
    $days = array();
    if($firstDay!=0)
    {
        while($firstDay>-1)
        {
            array_push($days, $numDaysPrevMonth-$firstDay+1);
            $firstDay--; //Inserts the last days of the last month into the calendar
            if($firstDay<1)
                break;
        }
    }
    $day = 1;
    while($day<=$numDaysCurrMonth)
    {
        array_push($days, $day); //Inserts the days of the current month into the calendar
        $day++;
    }
    $day = 1;
    while(count($days)<35)
    {
        array_push($days, $day); //Inserts the first days of the next month into the calendar
        $day++;
    }
    return $days; //Finish with the built calendar
}
print '<script>
    $("#CalAdd").click(function () {
    var controls = document.getElementsByName("CalendarItem");
    validatePopUp(controls, "Calendar");
    });
    </script>';
require "includes/footer.php";
?>