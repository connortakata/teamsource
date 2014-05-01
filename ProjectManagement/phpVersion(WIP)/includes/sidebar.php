<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li <?php if($_SERVER['PHP_SELF']=="/index.php") print 'class="active"';?>><a href="index.php">Dashboard</a></li>
                <li <?php if($_SERVER['PHP_SELF']=="/calendar.php") print 'class="active"';?>><a href="calendar.php">Calendar</a></li>
                <li <?php if($_SERVER['PHP_SELF']=="/resources.php") print 'class="active"';?>><a href="resources.php">Resources</a></li>
                <li <?php if($_SERVER['PHP_SELF']=="/tasks.php") print 'class="active"';?>><a href="tasks.php">Tasks</a></li>
            </ul>
        </div>