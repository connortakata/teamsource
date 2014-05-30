<?php
	require "includes/header.php";
	require "includes/topNav.php";
	require "includes/sidebar.php";
    require "functions/tasksFunctions.php";



	print '
			<div id="pop-up" class="PopupShadow" style="display:none; position:fixed; top:150px; left:27%; width:600px; height:auto;">
			<div class="well" style="width:100%; height:auto;">
				<div class="panel panel-primary" style="height:auto">
				  <div class="panel-heading">
					<input name="popItem" id="TaskTitle" type="text" class="form-control" placeholder="Task Title">			    
				  </div>
                    <div class="panel-body">';
                    $teamID = $_SESSION["team"];
                    $taskManID = getTeamSubId($teamID, "TASK");
                    getTaskIssuer();
					print '<br><br>
					Finish By: <input name="popItem" id="FinishBy" type="date" style="height:25px"/><br><br>
					Issued To: <select name="popItem" id="IssuedTo">';

                    getTaskTeamMembers($teamID);
					
					print'</select><br><br>
					Priority: <select name="popItem" id="Priority"><option>High</option><option>Medium</option><option>Low</option></select><br><br>
					Task Description: <br>
					<div class="panel-info">
						<textarea name="popItem" id="TaskDes" rows="5" class="form-control" style="height:50%; width:100%; resize:none;"  ></textarea>
					</div>
					<div class="btn-group">
					  <button id="btnComplete" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-ok"></span> Submit</button>
					  <button id="btnDelete" type="button" class="btn btn-default" onclick="HidePopup()"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
			
				  </div>
				</div>
			</div>
		</div>
		<div id="SelectedPopup" class="PopupShadow" style="display:none; position:fixed; top:150px; left:27%; width:600px; height:auto;">
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Task Manager</h1>
        </div>
        <div id="mainButtons" align="center" style="display:table; margin-left: 52%; padding-bottom:10px">
            <!--<a href="add-task.html" rel="#overlay" stype="text-decoration:none">-->
              <button type="button" class="btn btn-default btn-med" onclick="DisplayPopup()">
                <span class="glyphicon glyphicon-plus"></span> Add Task
              </button>
            <!--</a>-->
          <!--<button type="button" class="btn btn-default btn-med">
            <span class="glyphicon glyphicon-remove"></span> Remove Task(s)
          </button>-->
          <select class="btn btn-default" onchange="SwitchDisplayedTasks(this)">
            <option value="0">Active</option>
            <option value="1">Finished</option>
          </select>
        </div>
      <div id="mainContainer" style="display:table; margin-left: 23%; float:center; width:70%" class="well">
        <div id="TaskList" class="list-group">';
        
   				getTasks(getTeamSubId($teamID,"TASK"));
				
		print	' 	
			</div>
		  </div>

          </div>

        </div>
		<script>
        
        $(document).mouseup(function (e){
        	var container = $(\'.PopupShadow\');
        	if(!container.is(e.target)
        		&& container.has(e.target).length === 0) 
			{
				container.hide();
			}	
        });

    	function DisplayPopup(){
    		$("#pop-up").show();
    		var pop = document.getElementById("pop-up");
    		pop.style.zIndex = 10;
       	}
    	function HidePopup(){
    		$("#pop-up").hide();
    		clearTaskData();
       	}
    	function DisplaySelectedPopup(){
    		$(\'#SelectedPopup\').show();
    		var pop = document.getElementById("SelectedPopup");
    		pop.style.zIndex = 10;    
    	}
    	function HideSelectedPopup(){
    		$(\'#SelectedPopup\').hide();
    		    	}
    	function clearTaskData(){
    		$(\'#TaskTitle\').val("");
    		$(\'#TaskDes\').val("");
    		$(\'#FinishBy\').val("");
    	}
    </script>
    <script>
    /* 	this a prototype of how the javascript functions are going to work 
     	this currently uses firebase as a way to track the chat, 
    	which will only work for our chat for our group.
    	This will be in place till we have a database in place.
    */
    	
    	$(\'#btnComplete\').click(function(){
    	
    		var validateSuccess = validatePopUp(document.getElementsByName("popItem"));
       		if (validateSuccess == 0)
    		{
    			HidePopup();
    			clearTaskData();
    			location.reload();
    		}
    	});
    	    	    	
    </script>';
	
	require "includes/footer.php";
?>