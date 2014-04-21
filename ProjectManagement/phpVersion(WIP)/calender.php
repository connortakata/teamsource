<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Calender</h1>
        </div>
		<link href="css/tables.css" rel="stylesheet">
		<div style="display:table; margin:0 auto;float:none; width:60%" class="well">
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
            $firstDay = date('w', strtotime(date("F", mktime(0, 0, 0, $month, 10))))+1; //Get first day of the week of the month
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
	    require "includes/footer.php";
?>