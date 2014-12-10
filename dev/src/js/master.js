var CommentMaster = function () {
	//Attribut 
	var isPosting = null;

	this.start = function () {
		//INPUT MESSAGE
		var form = $('#comment-form'),
			action = form.attr('action');
		//Listen
		$('body').on('submit', '#comment-form', function (e) {
			e.preventDefault();
			console.log('go post');	
			//post
			if (isPosting === null) {
				isPosting = $.post(action, form.serializeArray(), function (data) {
					if ( data.status == "success" ) {
						showAlertInputMessage(data.status, data.message);
						form.find('input[name=message]').val('');
						$(data.comment).insertAfter('.comment-form');
					} else {
						showAlertInputMessage(data.status, data.message);
					}
					isPosting = null;
				});
			}
		});

		//FORM DELETE
		//Listen
		$('body').on('submit', '.comment-user form.author-remove', function (e) {
			e.preventDefault();
			console.log('go post');
			var formDelete = $(this).closest('form'),
				actionDelete = formDelete.attr('action');
				
			//post
			if (isPosting === null) {
				isPosting = $.post(actionDelete, formDelete.serializeArray(), function (data) {
					if ( data.status == "success" ) {
						formDelete.closest('.comment-user').html('<p class="alert alert-warning">' + data.message + '</p>');
					} else {
						showAlertAfterForm(data.status, data.message);
					}
					isPosting = null;
				});
			}
		});
	}

	//Feedback
	var showAlertAfterForm = function (type, message) {
		//Clean
		$('.comment-form + p').remove();

		var fragment = document.createDocumentFragment();
		var p = createElementWithClass('p', 'alert alert-' + type);
			p.innerText = message;
			fragment.appendChild(p);
		
		$(fragment).insertAfter($('.comment-form'));
	}

	var showAlertInputMessage = function (type, message) {
		//Clean
		$('#comment-form button + p').remove();

		var fragment = document.createDocumentFragment();
		var p = createElementWithClass('p', 'alert alert-' + type);
			p.innerText = message;
			fragment.appendChild(p);
		
		$(fragment).insertAfter($('#comment-form button'));
	}

	var createElementWithClass = function (type, className){
        var object = document.createElement(type);
        object.className = className;
        if(arguments[2]){
            object.innerText = arguments[2];
        }
        return object;
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
