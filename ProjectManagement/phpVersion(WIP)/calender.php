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
		<ul style="display:table; margin:0 auto;" class="pagination">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#">Jan</a></li>
				<li><a href="#">Feb</a></li>
				<li class="active"><a href="#">Mar<span class="sr-only">(current)</span></a></li>
				<li><a href="#">Apr</a></li>
				<li><a href="#">May</a></li>
				<li><a href="#">Jun</a></li>
				<li><a href="#">Jul</a></li>
				<li><a href="#">Aug</a></li>
				<li><a href="#">Sep</a></li>
				<li><a href="#">Oct</a></li>
				<li><a href="#">Nov</a></li>
				<li><a href="#">Dec</a></li>
				<li><a href="#">&raquo;</a></li>
		</ul>';
		print 
			'<table style="margin: 0px auto;" class="calender">
			<tr class="date">
				<td class="days" width="11.43%">Sun</td>
				<td class="days" width="11.43%">Mon</td>
				<td class="days" width="11.43%">Tue</td>
				<td class="days" width="11.43%">Wed</td>
				<td class="days" width="11.43%">Thu</td>
				<td class="days" width="11.43%">Fri</td>
				<td class="days" width="11.43%">Sat</td>
			</tr>';

		$day = date("j");
		print $day;
        $day = 0;
        for( $i=0; $i<6; $i++)
        {
            print '<tr class="date">';
            for( $j=0; $j<7; $j++)
            {
                print '<td class="days" width="11.43%" style="color:grey">';
                print $day;
                print '</td>';
                $day++;
            }
            print '</tr>';

            print '<tr class="dayDetail">';
            for( $j=0; $j<7; $j++)
            {
                print '<td class="days" width="11.43%"></td>';
            }
            print '</tr>';
        }
        print '</table>
            </div>';
	require "includes/footer.php";
?>