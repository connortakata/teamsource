<?php

function buildCalArray($month = NULL, $year=NULL)
{
    if($month == NULL)
        $month = date('n');//If we were sent no info for month, assume current month
    if($year == NULL)
        $year =  date('Y');//If we were sent no info for year, assume current year
    $firstDay=date('w',strtotime($month."/1/".$year));//Gets the day of the week for the first day of the month
    $numDaysCurrMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); //Get number of days in current month
    if($month==1)//Special case to get number of days in December of last year if the selected month is January
        $numDaysPrevMonth = cal_days_in_month(CAL_GREGORIAN, 12, $year); //Number of days December of last year (Always same number of days in Dec, is this needed?)
    else
        $numDaysPrevMonth = cal_days_in_month(CAL_GREGORIAN, $month-1, $year); //Otherwise, just number of days in last month

    $days = array();
    if($firstDay!=0)
    {
        while($firstDay>-1)
        {
            if($month==1)
                array_push($days, (12)."/".($numDaysPrevMonth-$firstDay+1));
            else
                array_push($days, ($month-1)."/".($numDaysPrevMonth-$firstDay+1));
            $firstDay--; //Inserts the last days of the last month into the calendar
            if($firstDay<1)
                break;
        }
    }
    $day = 1;
    while($day<=$numDaysCurrMonth)
    {
        array_push($days, $month."/".$day); //Inserts the days of the current month into the calendar, from 1st to the last day
        $day++;
    }
    $day = 1;
    while(count($days)<42)
    {
        if($month==12)
            array_push($days, (1)."/".$day);
        else
            array_push($days, ($month+1)."/".$day); //Inserts the first days of the next month into the calendar
        $day++;
    }
    return $days; //Finish with the built calendar array
}

function printCalendar()
{
    //check for $_POST data to see if another month or year was selected
    if(!isset($_GET["month"])||$_GET["month"]<1||$_GET["month"]>12)
        $month=date("n");
    else
        $month=$_GET["month"];
    if(!isset($_GET["year"])||$_GET["year"]<1||$_GET["year"]>2040)
        $year=date("Y");
    else
        $year=$_GET["year"];

    print '<ul style="display:table; margin:0 auto;" class="pagination">';//Print the month and year selector
    print '<li><a href="calendar.php?month='.($month).'&year='.($year-1).'">&laquo;</a></li>';//Button actions depend on current month+year
    print '<li><a href="calendar.php?month='.($month).'&year='.$year.'">'.$year.'</a></li>';
    print '<li><a href="calendar.php?month='.($month).'&year='.($year+1).'">&raquo;</a></li></ul>';
    print '<ul style="display:table; margin:0 auto;" class="pagination">';
    if($month==1)
        print '<li><a href="calendar.php?month=12&year='.($year-1).'">&laquo;</a></li>';
    else
        print '<li><a href="calendar.php?month='.($month-1).'&year='.$year.'">&laquo;</a></li>';

    for($i = 1;$i<=12;$i++)
    {   //print out the month selectors, highlight the current month
        if($i==$month)
        {
            print '<li class="active"><a href="calendar.php?month='.$i.'&year='.$year.'">'. date("M", mktime(0, 0, 0, $i, 10)) .'<span class="sr-only">(current)</span></a></li>';
        }
        else
        {
            print '<li><a href="calendar.php?month='.$i.'&year='.$year.'">' . date("M", mktime(0, 0, 0, $i, 10)) . '</a></li>';
        }
    }
    if($month==12)
        print '<li><a href="calendar.php?month=1&year='.($year+1).'">&raquo;</a></li>';
    else
        print '<li><a href="calendar.php?month='.($month+1).'&year='.$year.'">&raquo;</a></li>';
    print '</ul>'; //Start calendar table, print out the Top row with days of the week. This print should never change.
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
    if(isset($_GET["month"])&&isset($_GET["year"])&&$_GET["month"]>0&&$_GET["month"]<13&&$_GET["year"]>0&&$_GET["year"]<2040)
        $days = buildCalArray($_GET["month"], $_GET["year"]);//If we were given a month and/or year to work with, and they are valid, we use those
    elseif(isset($_GET["month"])&&$_GET["month"]>0&&$_GET["month"]<13)
        $days = buildCalArray($_GET["month"]);//If we were only given a month, we use that
    elseif(isset($_GET["year"])&&$_GET["year"]>0&&$_GET["year"]<2040)
        $days = buildCalArray(NULL,$_GET["year"]);//If we were only given a year, we use that and the default value for month
    else
        $days = buildCalArray();//If we were given nothing, we make an array for the current year and month

    if($month<10)//Due to leading zeros in mysql, we need to deal with special cases (transitions from 09->10, 12->01, etc)
    {
        $monthYear = $year."-0".$month;
        if($month==9)//If current month is September, next month is October('10' as opposed to '010')
            $nextMonthYear=$year."-10";
        else
            $nextMonthYear=$year."-0".($month+1);
        if($month==1)//If current month is January, previous month was December of previous year
            $prevMonthYear = ($year-1)."-12";
        else//Otherwise, previous month is just month-1
            $prevMonthYear = $year."-0".($month-1);
    }
    else//For months October through December
    {
        $monthYear = $year."-".$month;
        if($month==12)//If current month is December, next month is January of next year
            $nextMonthYear = ($year+1)."-01";
        else
            $nextMonthYear = $year."-".($month+1);
        if($month==10)//If current month is October, previous month was September ('09' as opposed to '9')
            $prevMonthYear = $year."-09";
        else
            $prevMonthYear = $year."-".($month-1);
    }

    //Select the team's calendar to identify with
    $teamID = $_SESSION["team"];
    $calID = getTeamSubId($teamID, "EVENT");
    $dayEvents = getEvents($calID, $monthYear, $prevMonthYear, $nextMonthYear);
    //Find all events of the current month and adjacent months

    for( $i=0; $i<count($days)/7; $i++)
    {
        print '<tr class="date">';
        for( $j=0; $j<7; $j++)//Printing the day numbers
        {
            print '<td class="days" width="11.43%"';
            $currMonth = substr($days[$dayNum],0,strpos($days[$dayNum],'/'));
            if(($currMonth<$month)||($currMonth>$month))
            {
                print 'style="color:grey"';//Print grey color style for days not in the current month
                if($currMonth<$month)
                    $date = $prevMonthYear;
                else
                    $date = $nextMonthYear;
            }
            else
                $date = $monthYear;
            print '>';
            print substr($days[$dayNum],strpos($days[$dayNum],'/')+1);
            if(strlen(substr($days[$dayNum],strpos($days[$dayNum],'/')+1))==1)
                $date = $date . '-0' . substr($days[$dayNum],strpos($days[$dayNum],'/')+1);
            else
                $date = $date . '-' . substr($days[$dayNum],strpos($days[$dayNum],'/')+1);
            print '<a class="showMe" style="float:right;padding-right: 5px;font-weight: bold" href="#"'.
                ' onclick="DisplayPopUp(\'CalendarPopUp\',\''.$date.'\')">+</a>';
            print '</td>';
            $dayNum++;
        }
        print '</tr>';
        print '<tr class="dayDetail" style="vertical-align: top">';
        for( $j=0; $j<7; $j++)//Printing the details of each day
        {
            print '<td class="daysDetail" width="11.43%"><div class="scrollable">';
            if(isset($dayEvents[$days[$dayDetail]]))
                for($k=0;$k<count($dayEvents[$days[$dayDetail]]);$k++)
                {//If statements here are to add some overflow behavior; maybe not necessary because of the css overflow property
                    if(strlen($dayEvents[$days[$dayDetail]][$k]["title"])>15)
                    {//Here, we generate a link that contains the necessary information to edit only the current event selected.
                        if(isset($dayEvents[$days[$dayDetail]][$k]["TASK_ID"]))
                            print '<a style="color:'.$dayEvents[$days[$dayDetail]][$k]["COLOR"].';'.$dayEvents[$days[$dayDetail]][$k]["STYLE"].';" href="#" onclick="EditPopup('.$dayEvents[$days[$dayDetail]][$k]["TASK_ID"].');" title="'.$dayEvents[$days[$dayDetail]][$k]["title"].'">';
                        else
                            print '<a href="#" onclick="EditEvent('.$dayEvents[$days[$dayDetail]][$k]["ID"].');" title="'.$dayEvents[$days[$dayDetail]][$k]["title"].'">';
                        print substr($dayEvents[$days[$dayDetail]][$k]["title"],0,12)."...";
                    }
                    else
                    {
                        if(isset($dayEvents[$days[$dayDetail]][$k]["TASK_ID"]))
                            print '<a style="color:'.$dayEvents[$days[$dayDetail]][$k]["COLOR"].';'.$dayEvents[$days[$dayDetail]][$k]["STYLE"].';" href="#" onclick="EditPopup('.$dayEvents[$days[$dayDetail]][$k]["TASK_ID"].');">'.$dayEvents[$days[$dayDetail]][$k]["title"];
                        else
                            print '<a href="#" onclick="EditEvent('.$dayEvents[$days[$dayDetail]][$k]["ID"].');">'.$dayEvents[$days[$dayDetail]][$k]["title"];
                    }
                    print '</a>';
                    print "<br>";
                }
            print '</div></td>';
            $dayDetail++;
        }
        print '</tr>';
    }
    print '</table></div>';//Phew! All done...
}

function getEvents($calID, $monthYear, $prevMonthYear, $nextMonthYear)
{
    $mysqli = new mysqli("localhost", "root", "TeamSource1!", "teamsource");
    $stmt= $mysqli->prepare("SELECT ID, EVENT_TITLE, EVENT_DATETIME FROM EVENT
    WHERE (EVENT_DATETIME LIKE ('$monthYear%')
    OR EVENT_DATETIME LIKE ('$prevMonthYear%')
    OR EVENT_DATETIME LIKE ('$nextMonthYear%'))
    AND EVENT_CALENDAR_ID='$calID'
    ORDER BY EVENT_DATETIME ASC");
    $stmt->execute();
    $res = $stmt->get_result();
    $dayEvents = array(array(array()));//Three dimensional array because we can have multiple events per day that each have their own array of info.
    $i=0;

    while($row = mysqli_fetch_array($res))//Generate an array of dates that can be referred to by a format like $dayEvents[5/31]
    {
        $date=substr($row["EVENT_DATETIME"],5,5);
        if($date[0]=='0')
            $date = substr($date,1);//shifts off the leading zero for month
        if($date[2]=='0')
        {
            $day = substr($date,3);//shifts off the leading zero for day
            $date=substr($date,0,2).$day;
        }
        $date=str_replace('-','/',$date);//Formatting the dates to form of 5/31
        if(!isset($dayEvents[$date]))
            $i=0;
        $dayEvents[$date][$i]["title"]=$row["EVENT_TITLE"];
        $dayEvents[$date][$i]["ID"]=$row["ID"];
        $i++;
    }
    //Now we insert all of the relevant tasks into the array
    $stmt= $mysqli->prepare("SELECT ID, TASK_TITLE, TASK_DUE_DATE, TASK_IS_FINISHED  FROM TASK
	WHERE (TASK_DUE_DATE LIKE ('$monthYear%')
OR TASK_DUE_DATE LIKE ('$prevMonthYear%')
OR TASK_DUE_DATE LIKE ('$nextMonthYear%'))
    AND TASK_TASK_MANAGER_ID='$calID'
    ORDER BY TASK_DUE_DATE ASC;");
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = mysqli_fetch_array($res))//Generate an array of dates that can be referred to by a format like $dayEvents[5/31]
    {
        $date=substr($row["TASK_DUE_DATE"],5,5);
        if($date[0]=='0')
            $date = substr($date,1);//shifts off the leading zero for month
        if($date[2]=='0')
        {
            $day = substr($date,3);//shifts off the leading zero for day
            $date=substr($date,0,2).$day;
        }
        $date=str_replace('-','/',$date);//Formatting the dates to form of 5/31
        if(!isset($dayEvents[$date]))
            $i=0;
        $dayEvents[$date][$i]["title"]=$row["TASK_TITLE"];
        $dayEvents[$date][$i]["TASK_ID"]=$row["ID"];
        $dayEvents[$date][$i]["COLOR"]="Green";
        if($row["TASK_IS_FINISHED"])
            $dayEvents[$date][$i]["STYLE"]="text-decoration:line-through";
        else
            $dayEvents[$date][$i]["STYLE"]="";
        $i++;
    }
    return $dayEvents;
}