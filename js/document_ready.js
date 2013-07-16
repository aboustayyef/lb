// codescript code to concatenate all js files and reduce http requests

// parameters
var padding = 10;
var border = 1;
var content = 278;
var unitWidth = content+(border*2)+(padding*2); // 300
var unitMargin = 10;
var unitTotalWidth = unitWidth + (2*unitMargin); //320

function getURLParameter(name) {
    var lb_regex = new RegExp(name + '=' + '(.+?)(&|$)');
    var lb_param = decodeURI((lb_regex.exec(location.search)||[,null])[1]);
        return lb_param;
}

// this calculates the exact width of area where cards will show
function getDesiredWidth(){
	var wdth = $(window).width();
	var extraSpace = wdth % unitTotalWidth;
	var desiredWidth = wdth - extraSpace;
	if (desiredWidth>(unitTotalWidth*5)) {
		desiredWidth=(unitTotalWidth*5); //max 7 columns
	}
	return desiredWidth;
}

// gets the number of columns, requires desiredWidth
function getColumnNumbers(){
	var desiredWidth = getDesiredWidth();
	var columns = desiredWidth / unitTotalWidth;
	if (columns > 5) { // maximum columns
		columns = 5;
	}
	return columns;
}

function fixDimensions(){
	var desiredWidth = getDesiredWidth();
	//fix post entries next
		$('#content_wrapper').width(desiredWidth);
        $('#channels_bar').width(desiredWidth);
		var columns = getColumnNumbers();
		$('#content_wrapper').BlocksIt({
			numOfCol: columns,
			offsetX: unitMargin,
			offsetY: unitMargin,
			blockElement: '.content_module'
		});

    //center navbar
    var realwidth = 0;
    var links = $('#channels_bar li');
    links.each(function(){
        if ($(this).is(':visible')) {
            realwidth = realwidth + $(this).width();
        }
    });
    // add sum of right margins
    realwidth = realwidth + (links.size())*40;
    $('#channels_bar ul').css("width",realwidth+'px');
    $('#channels_bar ul').css("margin", "0 auto");

}

// scrolling math 

var workInProgress = "no";
var position = 16; // initial value is the one right after the first bunch

function do_scroll_math() {
    var wh = $(window).height();
    var dh = $(document).height();
    var s = $(document).scrollTop();
    var chan = getURLParameter('channel');

    if (s >= (dh - wh - 1000)) { // when we're almost at the bottom of the document
        if (workInProgress === "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            var url = "show_more_posts.php";
            $.post(url, { start_from: position, channel: chan}, function (data) {
                $("#content_wrapper").append(data);
                fixDimensions();
                
                $('.content_module').fadeTo('slow', 1);
                position = position + 14;
                $(document).scrollTop = s;
                $("img.lazy").lazyload({
                    effect : "fadeIn",
                    threshold : 500
                });
                $("img.lazy").removeClass("lazy");
                workInProgress = "no";

            });
        }
    }
}

function adjustChannelBar(){
    var barWidth = $('#selector').width(); // width of the bar
    var minimumMargin = 26; // margin between li's
    var widthOfList = 0 ; // calculated width of ul
    var itemsShowingOnList = 1 ; //minimum
    $('#channels_bar ul').width((barWidth -(2*minimumMargin)));
    $('#channels_bar li').css("margin-right", minimumMargin+"px");
    $('#channels_bar li').each(function(){
        widthOfList = widthOfList + $(this).width() + minimumMargin;
        if ((widthOfList + $('#more').width()+ (minimumMargin)*3)>barWidth) { //
            $(this).hide();
            widthOfList = widthOfList - $(this).width() - minimumMargin;
        } else {
            $(this).show();
            itemsShowingOnList++;
        }
    });
    $('#more').show();
    widthOfList = widthOfList - $('#more').width()+minimumMargin;
    console.log(widthOfList);

    //now center it
    var finalWidth = 0;
    $('#channels_bar li').each(function(){
        if ($(this).is(':visible')) {
            finalWidth = finalWidth + $(this).width() + minimumMargin;
        }
    });
    finalWidth = finalWidth - minimumMargin; // remove the last right margin
    console.log(finalWidth);
    $('#channels_bar ul').css({
        "width":finalWidth+(minimumMargin),
        "padding":"0",
        "margin":"0 auto",

    });
}

// When document loads

//Navigation

$('#menubutton').mouseup(function(){
    $('ul.nav').toggle();
    $('.navbutton').toggleClass('highlighted');
});

// capture escape key to exit menu
$(document).keyup(function(e) {
    if (e.keyCode === 27) {
        $('ul.nav').hide('fast');
        $('.navbutton').removeClass('highlighted');

    }
});

$('i.top-right').click(function(){
    $('#channels_window').hide();
    $('#modal_background').hide();
});

$('#more').click(function(){
    //$('#modal_background').show();
    $('#channels_window').show();
    $('#modal_background').show();
    $(document).keyup(function(e) { // getout if escape key is pressed
        if (e.keyCode === 27) {
            $('#channels_window').hide();
            $('#modal_background').hide();
        }
});

});

$(document).ready(function(){
    fixDimensions();
    $('#channels_bar .content_module').fadeTo('fast', 1);
    $('#content_wrapper').waitForImages(function() {
        $('.loader').fadeTo('fast',0);
        $('.content_module').fadeTo('slow', 1);
    });
    do_scroll_math();
    adjustChannelBar();
    $(".content_module").css("display","block");
    $("img.lazy").lazyload({
        effect : "fadeIn",
        threshold : 500
    });
    $("img.lazy").removeClass("lazy");
});

// When document is scrolled or resized / code source: http://stackoverflow.com/questions/5489946/jquery-how-to-wait-for-the-end-or-resize-event-and-only-then-perform-an-ac

var do_scroll_it;
$(window).scroll(function() {
    clearTimeout(do_scroll_it);
    do_scroll_it = setTimeout(function() {
        do_scroll_math();
    }, 100);
});

var do_resize_it;
$(window).resize(function() {
    clearTimeout(do_resize_it);
    do_resize_it = setTimeout(function() {
        fixDimensions();
        adjustChannelBar();
    }, 100);
});




