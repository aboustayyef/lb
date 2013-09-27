// Javascript for interface behavior 

/**
*   sets dimensions of elements of the interface at load or at window size change
*/ 
function resizeInterface(){
	console.log('resizeInterface');
	var viewHeight = $(window).height() - $('.mainbar-wrapper').height(); //later remove footer too
    $('#view-area').css('height', viewHeight);
    if ($(window).width() >= 760) { // vertical tablet or below doesn't show left column
    	$('#left-col-wrapper').css('height', viewHeight);
   	    $('#left-col-wrapper').fadeTo('slow', 1);
    };
}


/**
*   behavior of searchbox
*/ 
$('#searchtoggle').click(function(){
    $('#search').css('opacity','1');
    $('#search').css('width','200px');
    $('#search').focus();
    $('#searchtoggle').toggle();
});

$('#search').focusout(function(){
    $('#search').css('width','0');
    $('#search').css('opacity','0');
    $('#searchtoggle').toggle();
});

// Things to do after everything else has loaded
$(window).load(function() {
	resizeInterface();
});

// Things to do when window is resized
var do_resize_interface;
$(window).resize(function() {
    clearTimeout(do_resize_interface);
    do_resize_interface = setTimeout(function() {
        resizeInterface();
    }, 100);
});