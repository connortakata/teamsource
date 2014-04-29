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
    $('#SelectedPopup').show();
    var pop = document.getElementById("SelectedPopup");
    pop.style.zIndex = 10;
}
function HideSelectedPopup(){
    $('#SelectedPopup').hide();
}
function clearTaskData(){
    $('#TaskTitle').val("");
    $('#TaskDes').val("");
    $('#FinishBy').val("");
}
function ViewPopup(task){
    var myDataRef = new Firebase('https://burning-fire-7708.firebaseio.com/tasks/' + task + '/');
    myDataRef.on('value', function(snapshot){
    var title = snapshot.val().Title;
    var TaskPri = snapshot.val().Priority;
    var IssuedTo = snapshot.val().To;
    var IssuedBy = snapshot.val().By;
    var FinishBy = snapshot.val().FinishDate;
    var TaskDes = snapshot.val().Description;
    $('#selTaskTitle').val(title);
    $('#selTaskTitle').attr('disable', 'disable');
    $('#selTaskDes').text(TaskDes);
    $('#selIssuedTo').text(IssuedTo);
    $('#selIssuedBy').text(IssuedBy);
    $('#selFinishBy').val(FinishBy);
    $('#selFinishBy').attr('disable', 'disable');
    $('#selPriority').text(TaskPri);
});
DisplaySelectedPopup();
}

$(document).mouseup(function (e)
{
    var container = $(".PopupShadow");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
})
/* 	this a prototype of how the javascript functions are going to work 
 this currently uses firebase as a way to track the chat, 
 which will only work for our chat for our group.
 This will be in place till we have a database in place.
 */

var myDataRefUsers = new Firebase('https://burning-fire-7708.firebaseio.com/users');
var myDataRefTasks = new Firebase('https://burning-fire-7708.firebaseio.com/tasks');

$('#btnComplete').click(function(){

var validateSuccess = validatePopUp(document.getElementsByName("popItem"), "Task");
//myDataRefTasks.push({Title: TaskTitle, Priority: TaskPri, To: IssuedTo, By: IssuedBy, FinishDate: FinishBy, Description: TaskDes});
if (validateSuccess == 0)
{
    HidePopup();
    clearTaskData();
}
});

myDataRefUsers.on('child_added', function(snapshot){
var data = snapshot.val();
data += " ";
document.getElementById("IssuedTo").innerHTML += ("<option>" + data + "</option>");
document.getElementById("IssuedBy").innerHTML += ("<option>" + data + "</option>");
});

myDataRefTasks.on('child_added', function(snapshot){
var data = snapshot.val();
document.getElementById("TaskList").innerHTML += (
    "<a href='#' class='list-group-item' ondblclick='ViewPopup(" + '"' + snapshot.name() + '"' + ")' >" +
"<h4 class='list-group-item-heading'>" +
    "<table width='100%'>" +
    "<td name='TaskTitle' style='width:200px;'><input type='checkbox'> " + data.Title + "</td>" +
    "<td style='width:200px;text-align:right' >" + "Due: " + data.FinishDate +"</td>" +
    "<td style='width:200px; text-align:center' > To: " + data.To + "</td>" +
    "<td style='width:150px; text-align:right' > Priority: " + data.Priority + "</td>" +
    "</table>" +
    "</h4>" +
"</a>");
});