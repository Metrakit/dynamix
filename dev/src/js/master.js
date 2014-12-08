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

		//input to textarea
		/*$('body').on('focus', '#comment-form input[name=message]', function () {
			console.log('focus');
			saveInput = form.find('input[name=message]');
			form.find('input[name=message]').replaceWith('<textarea rows="3" name="message"></textarea>');
			form.find('textarea[name=message]').focus();
		});
		$('body').on('blur', '#comment-form textarea[name=message]', function () {
			console.log('blur');
			form.find('textarea[name=message]').replaceWith(saveInput);
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
