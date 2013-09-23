// codescript code to concatenate all js files and reduce http requests

// parameters
var padding = 10;
var border = 1;
var content = 278;
var unitWidth = content+(border*2)+(padding*2); // 300
var unitMargin = 10;
var unitTotalWidth = unitWidth + (2*unitMargin); //320

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
			blockElement: '.card'
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

function bloggerFixDimensions(){
    var desiredWidth = getDesiredWidth();
    //fix post entries next
        $('#blogger_content_wrapper').width(desiredWidth);
        $('#blog_details').width(desiredWidth);
        $('#blog_details').show();
        var columns = getColumnNumbers();
        $('#blogger_content_wrapper').BlocksIt({
            numOfCol: columns,
            offsetX: unitMargin,
            offsetY: unitMargin,
            blockElement: '.card'
        });
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
    console.log($('#top_posts .card_header').css("background-color"));
    $('#channels_bar li.selected').css({
        "border-bottom": "3px solid " + $('#top_posts .card_header').css("background-color"), //gives color of bar underneath the same color of top posts background.
    });
}

// scrolling math 

var workInProgress = "no";

function do_scroll_math() {
    var wh = $(window).height();
    var dh = $(document).height();
    var s = $(document).scrollTop();

    if (s >= (dh - wh - 1000)) { // when we're almost at the bottom of the document
        if (workInProgress === "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            $('.endloader').css("bottom",0);
            $('.endloader').fadeTo('slow',1);

            var url = "contr_get_extra_posts.php";
            $.post(url, function (data) {
                $("#content_wrapper").append(data);
                fixDimensions();
                bloggerFixDimensions();
                adjustChannelBar();
                
                $('.card').fadeTo('slow', 1);
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

$('#more').click(function(){
    //show the wind
    $('#channels_window').toggle();
    $('#channels_window').css("right","5%");
    $('#channels_window').css("top", "130px");
    $(document).keyup(function(e) { // getout if escape key is pressed
        if (e.keyCode === 27) {
            $('#channels_window').hide();
        }
    });
});

$('i.top-right').click(function(){
    $('#channels_window').hide();

});

$(document).ready(function(){
    do_scroll_math();
    $(".card").css("display","block");
    $("img.lazy").lazyload({
        effect : "fadeIn",
        threshold : 500
    });
    $("img.lazy").removeClass("lazy");

});

// Things to load after everything else has loaded
$(window).load(function(){
    fixDimensions();
    bloggerFixDimensions();
    adjustChannelBar();

    $('#channels_bar .card').fadeTo('fast', 1);
    $('#content_wrapper').waitForImages(function() {
        $('.loader').toggle();
        $('.card').fadeTo('slow', 1);
    });
    $('#blogger_content_wrapper').waitForImages(function() {
        $('.loader').fadeTo('fast',0);
        $('.card').fadeTo('slow', 1);
    });

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
        bloggerFixDimensions();
        adjustChannelBar();
    }, 100);
});




