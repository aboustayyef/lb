// codescript code to concatenate all js files and reduce http requests

// parameters
var padding = 10;

// card dimensions
var border = 1;
var content = 278;
var unitWidth = content+(border*2)+(padding*2); // 300
var unitMargin = 10;
var unitTotalWidth = unitWidth + (2*unitMargin); //320

// initial parameters

var extraSpace;

// this calculates the exact width of area where cards will show
function getDesiredWidth(){
	var wdth = $(window).width()-$('#left-col-wrapper').outerWidth();
	extraSpace = wdth % unitTotalWidth;
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
		$('#posts').width(desiredWidth);
        $('#posts').css('margin-left',(extraSpace/2)-5); //allow 10px (5x2) for scroll bar
		var viewHeight = $(window).height()-$('.mainbar-wrapper').height(); //later remove footer too
        $('#view-area').css('height', viewHeight );
        $('#left-col-wrapper').css('height', viewHeight);
        $('#left-col-wrapper').fadeTo('slow',1);
        var columns = getColumnNumbers();
		$('#posts').BlocksIt({
			numOfCol: columns,
			offsetX: unitMargin,
			offsetY: unitMargin,
			blockElement: '.card'
		});
        $("img.lazy").lazyload({
            effect : "fadeIn",
            container: $("#view-area")
        });
        $("img.lazy").removeClass("lazy");
}
// scrolling math 

var workInProgress = "no";

function do_scroll_math(){
    var docHeight = $('#posts').height();
    var howFarDown = Math.abs($('#posts').position().top);
    var s = docHeight - howFarDown;
    console.log(s);
    if (s <= 1000) { // when we're almost at the bottom of the document
        if (workInProgress === "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            $('.endloader').css("bottom",0);
            $('.endloader').fadeTo('slow',1);

            var url = "contr_get_extra_posts.php";
            $.post(url, function (data) {
                $("#posts").append(data);
                fixDimensions();
                $('.card').fadeTo('slow', 1);
                $(document).scrollTop = s;
                    });
            $(".card").css("display","block");
            workInProgress = "no";}

        }
    }




// When document loads

$(document).ready(function(){
    do_scroll_math();
    $("img.lazy").lazyload({
        effect : "fadeIn",
        threshold : 500,
        container: $("#view-area")
    });
    $("img.lazy").removeClass("lazy");
});

// Things to load after everything else has loaded
$(window).load(function(){
    fixDimensions();
    $('#posts').waitForImages(function() {
        $('.loader').toggle();
        $('.card').fadeTo('slow', 1);
    });

});

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

// When document is scrolled or resized / code source: http://stackoverflow.com/questions/5489946/jquery-how-to-wait-for-the-end-or-resize-event-and-only-then-perform-an-ac

var do_scroll_it;
$('#view-area').scroll(function() {
    clearTimeout(do_scroll_it);
    do_scroll_it = setTimeout(function() {
        console.log('making the call');
        $("img.lazy").lazyload({
            container: $("#view-area"),
            effect : "fadeIn",
        });
        $("img.lazy").removeClass("lazy");
        do_scroll_math();
    }, 100);
});

var do_resize_it;
$(window).resize(function() {
    clearTimeout(do_resize_it);
    do_resize_it = setTimeout(function() {
        fixDimensions();
    }, 100);
});




