<?php
if(!preg_match('/Chrome/', $_SERVER['HTTP_USER_AGENT'])&&($_SERVER['PHP_SELF']=="/calendar.php"||$_SERVER['PHP_SELF']=="/calendar"))
{
    print '<script>
    window.document.getElementById("CalendarTime").value="00:00:00";
    window.document.getElementById("CalendarTime").style="height:25px;width:80px";
    window.document.getElementById("CalendarDate").style="display:none;";
    window.document.getElementById("CalendarDateComp1").value="Month";
    window.document.getElementById("CalendarDateComp2").value="Day";
    window.document.getElementById("CalendarDateComp3").value="Year";
    window.document.getElementById("CalendarDateComp1").style="height:25px;width:60px"
    window.document.getElementById("CalendarDateComp2").style="height:25px;width:50px"
    window.document.getElementById("CalendarDateComp3").style="height:25px;width:70px"
    </script>';
}
else if(!preg_match('/Chrome/', $_SERVER['HTTP_USER_AGENT'])&&($_SERVER['PHP_SELF']=="/tasks.php"||$_SERVER['PHP_SELF']=="/tasks"))
{
    print '<script>
    window.document.getElementById("FinishBy").style="display:none;";
    window.document.getElementById("FinishByComp1").value="Month";
    window.document.getElementById("FinishByComp2").value="Day";
    window.document.getElementById("FinishByComp3").value="Year";
    window.document.getElementById("FinishByComp1").style="height:25px;width:60px"
    window.document.getElementById("FinishByComp2").style="height:25px;width:50px"
    window.document.getElementById("FinishByComp3").style="height:25px;width:70px"
    </script>';
}