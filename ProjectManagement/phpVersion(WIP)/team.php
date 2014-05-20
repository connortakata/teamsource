<?php

require "includes/header.php";
require "includes/topNav.php";
require "includes/sidebar.php";

print'
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Manage Teams</h1>
    <div align="left" style="display:table; width:95%; height: 500px; margin-right: 25px;" class="well">
        <div class="panel panel-primary">
            <div class="panel-heading">It seems you are not part of a team yet.</div>
                <div class="panel-body" style="height: 400px;">
                    To use the site, either create a team to become the manager of or ask another manager to add you to their team.</br></br>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="AddTeam()">Create Team</button>
                            </span>
                            <input id="CreateTeamName" type="text" placeholder="Team Name" class="form-control">
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!--/panel-body-->
            </div><!--/panel-->
        </div><!--/well-->
</div>
<script src="js/AJAX_lib.js"/>
';

require "includes/footer.php";