var DatePicker = function() {
	this.displayDate = function (options) {
		options.format = "LL";
		$('.date-picker').datetimepicker(options);
	}
	this.displayTime = function (options) {
		options.format = "LT";
		$('.time-picker').datetimepicker(options);
	}
	this.displayDateTime = function (options) {
		options.format = "";
		$('.date-time-picker').datetimepicker(options);
	}	
}
var datePick = new DatePicker;

//Object Master
var Master = function (){
	//Variables
	var queue = [];

	//Start
	this.start = function (){
		//get locale_id
		
		//Set default moment language
		var localeDefault = 'fr';
		if (arguments[0]) {
			localeDefault = arguments[0];
		}
		moment.locale(localeDefault);
		

		//Comment System
		var commentService = new CommentMaster();
		commentService.start(localeDefault);

		//Exec queue script (for module)
		execQueueScripts();
	}


	//Queue Script system
	var execQueueScripts = function () {
		var q = getQueue();
		for( var o in q ) {
			console.log(q[o]);
			eval(q[o]);
		}
	}
	//Add a script to exec at masterClass.start()
	this.addQueue = function ( script ) {
		var q = getQueue();
		//console.log(q);
		
		q.push(script + ';');
		//console.log(q);
	}

	//return void
	var setQueue = function (a) {
		queue = a;
	}
	//return queue
	var getQueue = function () {
		return queue;
	}
}


var masterClass = new Master();
