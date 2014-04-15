$("#name-edit").click(function() {
	alert("Edit Name");
});

$("button").click(function(e){
	var idClicked = e.target.id;
	alert(idClicked);
});