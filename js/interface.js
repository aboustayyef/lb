// Javascript for interface behavior 

/**
*   sets dimensions of elements of the interface at load or at window size change
*/
function resizeInterface(){
	console.log('resizeInterface');
	var viewHeight = $(window).height() - $('.mainbar-wrapper').height(); //later remove footer too
    $('#view-area').css('height', viewHeight);
    console.log($(window).width());
    if ($(window).width() > 768) { // vertical tablet or below doesn't show left column
        $('#left-col-wrapper').css('height', viewHeight);
        console.log('about to show left column from resizeInterface');
        $('#left-col-wrapper').show();
    } else {
        $('#left-col-wrapper').hide();
    }
}

// Things to do after everything else has loaded
$(window).load(function() {
	resizeInterface();
    $('#view-area').css('-webkit-overflow-scrolling', 'touch');
});

// Things to do when window is resized
var do_resize_interface;
$(window).resize(function() {
    clearTimeout(do_resize_interface);
    do_resize_interface = setTimeout(function() {
        resizeInterface();
    }, 100);
});
