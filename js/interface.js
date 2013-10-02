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

// Behavior of Menus

var closeMenus = function(){ // function to close other menus when one is opened
    //remove menu navs
    $('#show-about li').removeClass('selected');$('#show-search li').removeClass('selected');$('#show-login li').removeClass('selected');

    $('#left-col-wrapper.float_it').css('display','none');
    $('#left-col-wrapper').removeClass('float_it');

    $('#menu-about').hide(); $('#menu-search').hide();$('#menu-login').hide();
};

$('#hamburger').on('click', function(){
    var c = $('#left-col-wrapper');
    var d = c.css('display');

    if (d==='block') {
        closeMenus();
    }else{
        closeMenus();
        c.css('display','block');
        c.addClass('float_it');
        console.log(c.css());
    }

});

$('#show-about li').click(function(){
    if ($('#show-about li').hasClass('selected')) {
       closeMenus();
    }else{
    closeMenus();
    $('#show-about li').toggleClass('selected');
    $('#menu-about').toggle();}
});

$('#show-search li').click(function(){
    if ($('#show-search li').hasClass('selected')) {
       closeMenus();
    }else{
    closeMenus();
    $('#show-search li').toggleClass('selected');
    $('#menu-search').toggle();}
});
