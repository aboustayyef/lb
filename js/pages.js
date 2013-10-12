/*use for js specific to pages*/

$(document).ready(function(){
	$('#content_wrapper').css("height",$(window).height()-$('div.mainbar-wrapper').outerHeight());
	$('#content_wrapper').css("overflow","scroll");
});

$('.modal-dismiss').on('click',function(){
	modal.hide();
});

$(document).on('keydown', function(event){ //monitor keystrokes
	if (event.which === 27) { //escape button
		modal.hide();
	}
});

$('input#submitBlog').click(function(){
	var re = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/ ;
	var submission = $('#submitblog').val();
	if (re.test(submission)) { //value is URL
		var formData = {
			key: 'qsdljkhqepoi3420$98346adfs34',
			kind: '[SUBMISSION]',
			submittedText: submission,
		};
		$.ajax({
			url: "mailer.php",
			type: "POST",
			data: formData,
			success: function(data){
				modal.message(data);
			}
		});
	}else{
		modal.message("Sorry, you should submit a URL");
	}
});