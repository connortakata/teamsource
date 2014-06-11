<?php
require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";
require "functions/calendarFunctions.php";


print '<div id="SelectedPopup" class="PopupShadow" style="display:none; position:fixed; top:150px; left:27%; width:600px; height:auto;">
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Calendar</h1>
        </div>
		<link href="css/tables.css" rel="stylesheet">
		<div style="display:table; margin-left: 23% ;float:none; width:70%" class="well">
        <div id="CalendarPopUp" class="PopupShadow" style="display:none; position:fixed; top:30%; left:35%; width:400px; height:auto; z-index:10;">
            <div class="well" style="width:100%; height:100%;">
                <div class="panel panel-primary" style="top:25px; height:95%;">
                    <div class="panel-heading">
                        <input name="CalendarItem" id="CalendarTitle" type="text" class="form-control" placeholder="Event Title"/>
                    </div>
                    <div class="panel-body">
                        <input name="CalendarItem" id="CalendarDate" type="date" max="9999-12-31" style="height:25px"/>
                        <input name="CalendarItem" id="CalendarDateComp1" placeholder="Month" type="number" max="12" min="1" style="height:25px;display: none;"/>
                        <input name="CalendarItem" id="CalendarDateComp2" placeholder="Day" type="number" max="31" min="1" style="height:25px;display: none;"/>
                        <input name="CalendarItem" id="CalendarDateComp3" placeholder="Year" type="number" max="4000" min="1" style="height:25px;display: none;"/> at:
                        <input name="CalendarItem" id="CalendarTime" type="time" style="height:25px"/>
                        <br /><br />
                        Description
                        <div class="panel-info">
                            <textarea name="CalendarItem" id="CalendarDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;"  ></textarea>
                        </div>
                    </div>
                    <div class="btn-group">
                        <input type="button" id="CalAdd" value="Add" style="margin-left:233px; width:50px" onclick="AddEvent(false);HidePopUp(\'CalendarPopUp\', \'CalendarItem\');location.reload();" />
                        <input type="button" value="Cancel" style="margin-left:10px;" onclick="HidePopUp(\'CalendarPopUp\', \'CalendarItem\');" />
                    </div>
                </div>
            </div>
        </div>
        <div id="mainButtons" align="left" style="display:table; margin:0 auto; padding-bottom:5px">
            <!--<a href="add-task.html" rel="#overlay" stype="text-decoration:none">-->
            <button type="button" class="btn btn-default btn-med" onclick="DisplayPopUp(\'CalendarPopUp\')">
                <span class="glyphicon glyphicon-plus"></span> Add Event
            </button>
        </div>';

    //Print the calendar here
    printCalendar();

    //These Scripts are specific to the Calendar page
    print '
    <script src="js/AJAX_lib.js"></script>
    <script>
    $(document).mouseup(function (e){
        	var container = $(\'.PopupShadow\');
        	if(!container.is(e.target)
        		&& container.has(e.target).length === 0)
			{
				container.hide();
			}
        });

    $("#CalAdd").click(function () {
            var controls = document.getElementsByName("CalendarItem");
            validatePopUp(controls, "Calendar");
        });
    function DisplayPopUp(PopId, date) {
    if(date!=null){
        document.getElementById("CalendarDate").value = date;
        }
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
    function DisplaySelectedPopup(){
    		$(\'#SelectedPopup\').show();
    		var pop = document.getElementById("SelectedPopup");
    		pop.style.zIndex = 10;
    }
    function HideSelectedPopup(){
    		$(\'#SelectedPopup\').hide();
    }
    function EditSelectedPopup(){
    		document.getElementById("CalendarEditTitle").disabled="";
    		document.getElementById("CalendarEditTime").disabled="";
    		document.getElementById("CalendarEditDate").disabled="";
    		document.getElementById("CalendarEditDes").disabled="";
    		document.getElementById("btnSelEdit").innerHTML="<span class=\\"glyphicon glyphicon-ok\\"></span> Submit";
    		document.getElementById("btnSelEdit").onclick=function(){ AddEvent(true); HideSelectedPopup();};
    }
    </script>';
require "includes/compatibility.php";
require "includes/footer.php";