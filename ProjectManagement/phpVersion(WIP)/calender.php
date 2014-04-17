<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";

	print '
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
		  </ul>
		  <table style="margin: 0px auto;" class="calender">
		<tr class="date">
			<td class="days" width="11.43%">Sun</td>
			<td class="days" width="11.43%">Mon</td>
			<td class="days" width="11.43%">Tue</td>
			<td class="days" width="11.43%">Wed</td>
			<td class="days" width="11.43%">Thu</td>
			<td class="days" width="11.43%">Fri</td>
			<td class="days" width="11.43%">Sat</td>
		</tr>
		<tr class="date">
			<td class="days" width="11.43%" style="color:grey">23</td>
			<td class="days" width="11.43%" style="color:grey">24</td>
			<td class="days" width="11.43%" style="color:grey">25</td>
			<td class="days" width="11.43%" style="color:grey">26</td>
			<td class="days" width="11.43%" style="color:grey">27</td>
			<td class="days" width="11.43%" style="color:grey">28</td>
			<td class="days" width="11.43%">1</td>
		</tr>
		<tr class="dayDetail">
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
		</tr>
		<tr class="date">
			<td class="days" width="11.43%">2</td>
			<td class="days" width="11.43%">3</td>
			<td class="days" width="11.43%">4</td>
			<td class="days" width="11.43%">5</td>
			<td class="days" width="11.43%">6</td>
			<td class="days" width="11.43%">7</td>
			<td class="days" width="11.43%">8</td>
		</tr>
		<tr class="dayDetail">
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
		</tr>
		<tr class="date">
			<td class="days" width="11.43%">9</td>
			<td class="days" width="11.43%">10</td>
			<td class="days" width="11.43%">11</td>
			<td class="days" width="11.43%">12</td>
			<td class="days" width="11.43%">13</td>
			<td class="days" width="11.43%" style="background-color:#eee">14</td>
			<td class="days" width="11.43%">15</td>
		</tr>
		<tr class="dayDetail">
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%" style="background-color:#eee"></td>
			<td class="days" width="11.43%"></td>
		</tr>
		<tr class="date">
			<td class="days" width="11.43%">16</td>
			<td class="days" width="11.43%">17</td>
			<td class="days" width="11.43%">18</td>
			<td class="days" width="11.43%">19</td>
			<td class="days" width="11.43%">20</td>
			<td class="days" width="11.43%">21</td>
			<td class="days" width="11.43%">22</td>
		</tr>
		<tr class="dayDetail">
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
		</tr>
		<tr class="date">
			<td class="days" width="11.43%">23</td>
			<td class="days" width="11.43%">24</td>
			<td class="days" width="11.43%">25</td>
			<td class="days" width="11.43%">26</td>
			<td class="days" width="11.43%">27</td>
			<td class="days" width="11.43%">28</td>
			<td class="days" width="11.43%">29</td>
		</tr>
		<tr class="dayDetail">
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
		</tr>
		<tr class="date">
			<td class="days" width="11.43%">30</td>
			<td class="days" width="11.43%">31</td>
			<td class="days" width="11.43%" style="color:grey">1</td>
			<td class="days" width="11.43%" style="color:grey">2</td>
			<td class="days" width="11.43%" style="color:grey">3</td>
			<td class="days" width="11.43%" style="color:grey">4</td>
			<td class="days" width="11.43%" style="color:grey">5</td>
		</tr>
		<tr class="dayDetail">
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
			<td class="days" width="11.43%"></td>
		</tr>
	</table>
		</div>';
	require "includes/footer.php";
?>