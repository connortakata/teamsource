var TransferTask = (function(){
	function TransferTask(params) {
		this.id = params.id;
		this.title = params.title;
		this.byWhom = params.byWhom;
		this.toWhom = params.toWhom;
		this.description = params.description;
	}
	
	TransferTask.prototype.ClearData = function(){
		for(var ele in this){
			this[ele] = "";
		}
	}
	
	TransferTask.prototype.Delete = function() {
		delete this;
	}
})();