var CommentMaster = function () {
	//Attribut 
	var isPosting = null;

	this.start = function () {
		//INPUT MESSAGE (CREATE MESSAGE)
		var form = $('#comment-form'),
			action = form.attr('action'),
			formEdit = $('#comment-form-edit-hidden form'),
			formReply = $('#comment-form-reply-hidden > div');


		//FORM CREATE
		//Listen
		$('body').on('submit', '#comment-form', function (e) {
			e.preventDefault();
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

		//FORM DELETE (DELETE MESSAGE)
		//Listen
		$('body').on('submit', '.comment-user form.author-remove', function (e) {
			e.preventDefault();
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

		//FORM VOTE
		//Listen
		$('body').on('submit', '.comment-user-footer form.comment-vote', function (e) {
			e.preventDefault();
			var formVote = $(this).closest('form'),
				actionDelete = formVote.attr('action');
				
			//post
			if (isPosting === null) {
				isPosting = $.post(actionDelete, formVote.serializeArray(), function (data) {
					if ( data.status == "success" ) {
						updateColorCountVote(formVote, data.action);
					} else {
						showAlertAfterForm(data.status, data.message);
					}
					isPosting = null;
				});
			}
		});

		//FORM EDIT
		//Listen - 1 show edit, 2 save
		$('body').on('click', '.comment-edit', function (e) {
			e.preventDefault();
			var container = $(this).parent().siblings('.comment-user-body'),
				text = container.find('p').text(),
				comment_id = $(this).closest('.comment-user').attr('data-comment-id');
			
			if (!container.hasClass('onEdit')) {
				//Set a class flag
				container.addClass('onEdit');

				//put form with textarea
				var form = formEdit.clone();
				form.find('textarea[name=message]').val(text);
				form.attr('action', $(this).attr('href'));
				container.html(form);
			} else {//reverse
				container.html('<p>' + container.find('textarea').val() + '</p>');
				container.removeClass('onEdit');
			}
		});
		//Listen 2 update
		$('body').on('submit', 'form.comment-form-edit', function (e) {
			e.preventDefault();
			var form = $(this).closest('form'),
				actionUpdate = form.attr('action');
				
			//post
			if (isPosting === null) {
				isPosting = $.post(actionUpdate, form.serializeArray(), function (data) {
					if ( data.status == "success" ) {
						var container = form.parent();
						container.html('<p>' + container.find('textarea').val() + '</p>');
						container.removeClass('onEdit');
					} else {
						showAlertAfterForm(data.status, data.message);
					}
					isPosting = null;
				});
			}
		});

		//FORM REPLY
		//Listen 1 show form reply
		$('body').on('click', '.comment-add-reply', function (e) {
			e.preventDefault();
			var parent_comment = $(this).parent().closest('.comment-parent'),
				container = $(this).parent().closest('.comment-user'),
				comment_id = container.attr('data-comment-id');
			
			if (!container.hasClass('onReply')) {
				//Set a class flag
				container.addClass('onReply');

				//put form with textarea
				var form = formReply.clone();
				form.find('input[name=commentable_id]').val(comment_id);
				form.find('input[name=commentable_type]').val('Comment');
				$(form).insertAfter(parent_comment);
			} else {//reverse
				parent_comment.siblings('.comment-form-reply').remove();
				container.removeClass('onReply');
			}
		});
		//Listen 2 update
		$('body').on('submit', 'form.comment-form-reply', function (e) {
			e.preventDefault();
			var form = $(this).closest('form'),
				containerForm = $(this).parent().closest('comment-form-reply');
				actionReply = form.attr('action'),
				container = $(this).parent().closest('.comment-user');
			
			//post
			if (isPosting === null) {
				isPosting = $.post(actionReply, form.serializeArray(), function (data) {
					console.log(data);
					if ( data.status == "success" ) {
						if (container.children('ul.comment-reply').length){//if ul list exists
							container.find('ul.comment-reply').append(data.comment);//just put it in first :)
						}else{	
							container.find('.comment-form-reply').replaceWith('<ul class="comment-reply">' + data.comment + '</ul>');
						}
						container.removeClass('onReply');
					} else {
						//showAlertAfterForm(data.status, data.message);//Set error message fine
					}
					isPosting = null;
				});
			}
		});
	}

	//VoteSystem
	var updateColorCountVote = function (form, action) {
		var span = form.find('button').find('span');
		switch(action) {
		    case 'destroy':	
		    	var counter = null;	    	
		        span.removeClass('color-blue color-red');//color		        
		        if (form.hasClass('comment-vote-up')) {//count
		        	//canceled a positive vote, decrement counter
		        	counter = form.siblings('.vote-counter-up');
		        } else {
		        	counter = form.siblings('.vote-counter-down');
		        }
		        crementCount( counter, counter.text(), false);
		        break;
		    case 'reverse':
		    	var counterMore = null, counterLess = null;
		        if (span.hasClass('comment-vote-up')) {		        	
		        	span.addClass('color-blue');//color
		        	form.siblings('form').find('button').find('span.comment-vote-down').removeClass('color-red');		        	
		        	counterMore = form.siblings('.vote-counter-up');//count
		        	counterLess = form.siblings('.vote-counter-down');
		        } else {		        	
		        	span.addClass('color-red');//color
		        	form.siblings('form').find('button').find('span.comment-vote-up').removeClass('color-blue');		        	
		        	counterMore = form.siblings('.vote-counter-down');//count
		        	counterLess = form.siblings('.vote-counter-up');
		        }
		        crementCount( counterMore, counterMore.text(), true);
		        crementCount( counterLess, counterLess.text(), false);
		        break;
		    case 'create':
		    	var counter = null;
		        if (span.hasClass('comment-vote-up')) {		        	
		        	span.addClass('color-blue');//color		        	
		        	counter = form.siblings('.vote-counter-up');//count
		        } else {		        	
		        	span.addClass('color-red');//color		        	
		        	counter = form.siblings('.vote-counter-down');//count
		        }
		        crementCount( counter, counter.text(), true);
		        break;
		}
	}

	var crementCount = function (counter, i, bool) {
		if (bool) {//true = incrément ; false = décrément
			counter.text(( i == '' || i == ' ' ? '1' : parseInt(i) + 1));
		} else {
			counter.text(( i == '1' ? '' : parseInt(i) - 1));
		}
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
