jQuery(document).ready(function(){
	
	$('#contact').submit(function(){
		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			name: $('#name').val(),
			email: $('#email').val(),
			phone: $('#phone').val(),
			comments: $('#comments').val()
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#contact img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				if(data.match('success') != null) $('#contact').slideUp('slow');

			}
		);

		});

		return false;

	});


/**************CONTACT PAGE FORM***************************/
	$('#contact-page').submit(function(){
		var action = $(this).attr('action');

		$("#message2").slideUp(750,function() {
		$('#message2').hide();

 		$('#submit2')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			name: $('#name2').val(),
			email: $('#email2').val(),
			subject: $('#subject2').val(),
			comments: $('#comments2').val()
		},
			function(data){
				document.getElementById('message2').innerHTML = data;
				$('#message2').slideDown('slow');
				$('#contact-page img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit2').removeAttr('disabled');
				if(data.match('success') != null) $('#contact-page').slideUp('slow');

			}
		);

		});

		return false;

	});
});