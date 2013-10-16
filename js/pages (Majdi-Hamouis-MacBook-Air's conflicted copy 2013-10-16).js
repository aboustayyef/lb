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
	modal.message("New Message");
});