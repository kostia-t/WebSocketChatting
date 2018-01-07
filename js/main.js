$(document).ready(function() {
	var conn = new WebSocket('ws://127.0.0.1:8080');
	var chatForm = $('.chatForm'), 
	messageInputField = chatForm.find('#message'),
	messagesList = $('.messages-list'),
	usernameForm = $('.username-setter'),
	usernameInput = usernameForm.find('.username-input');

	chatForm.on('submit', function(e) {
		// var message = messageInputField.val();
		var message = {
			text: messageInputField.val(),
			sender: $.cookie('chat_name'),
			type: 'message'
		};

		// conn.send(message);
		conn.send(JSON.stringify(message));
		messagesList.append('<li class="label label-success">'+message.text+'</li>');

		e.preventDefault();
	});

	usernameForm.on('submit', function(e) {
		var username = usernameInput.val();
		if(username.length > 0) {
			$.cookie('chat_name', username);
			$('.username').text(username);
		}
		e.preventDefault();
	});

	conn.onopen = function(e) {
		console.log('Connection established');
		// conn.send('Message test from a broswer client');

		$.ajax({
			url: '/load_history.php',
			dataType: 'json',
			success:function(data) {
				$.each(data, function() {
					if(this.sender == $.cookie('chat_name')) {
						messagesList.append('<li class="label label-success">'+this.text+'</li>');
					} else {
						messagesList.append('<li>' + this.text + '</li>');	
					}				
				});
			}
		});

		var chatname = $.cookie('chat_name');

		if(!chatname) {
			var timestamp = (new Date()).getTime();
			chatname = 'anonymous' + timestamp;
			$.cookie('chat_name', chatname);
		}

		$('.username').text(chatname);
	};

	conn.onmessage = function(e) {
		// console.log(e.data);
		messagesList.append('<li>'+e.data+'</li>');
	} 
});