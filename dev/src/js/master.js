var CommentMaster = function () {
	this.start = function () {
		var form = $('#comment-form'),
			action = form.attr('action'),
			saveInput = null;
		
		//Listeners
		form.submit( function (e) {
			e.preventDefault();
				
			//post
			$.post(action, form.serializeArray(), function (data) {
				if ( data.status == "success" ) {
					//success = clear filed and add dynamicly the comment
				} else {
					//fail, show error or notice
				}
				console.log(data);
			});
		});

		//AHAHAH CSS powaaa
		/*//input to textarea
		$('body').on('focus', '#comment-form input[name=message]', function () {
			console.log('focus');
			//show btn submit

		});
		$('body').on('blur', '#comment-form input[name=message]', function () {
			console.log('blur');
			//hide btn submit

		});*/
	}
}

//Object Master
var Master = function (){
	this.start = function (){
		var commentService = new CommentMaster();
		commentService.start();
	}
}


var masterClass = new Master();
