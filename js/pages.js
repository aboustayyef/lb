/*use for js specific to pages*/

$(document).ready(function(){
	$('#content_wrapper').css("height",$(window).height()-$('div.mainbar-wrapper').outerHeight());
	$('#content_wrapper').css("overflow","scroll");
});

$('#submit_btn').click(function(){
	$('#message').html("<p>thank you<p>");
	return false;
});