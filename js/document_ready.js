// parameters
var padding = 10;
var border = 1;
var content = 278;
var unitWidth = content+(border*2)+(padding*2); // 300
var unitMargin = 10;
var unitTotalWidth = unitWidth + (2*unitMargin); //320
var chan = getURLParameter('channel');

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
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
	desiredWidth = getDesiredWidth();
    var wdth = $(window).width();
    var extraSpace = wdth % unitTotalWidth;
	//fix post entries next
		$('#entries-main-container').width(desiredWidth);
        $('#lb_interface').width(desiredWidth);
		var columns = getColumnNumbers();
		$('#entries-main-container').BlocksIt({
			numOfCol: columns,
			offsetX: unitMargin,
			offsetY: unitMargin,
			blockElement: '.blogentry'
		});

    // sharing tools
    $('.blogentry').mouseenter(function(){
        $(".sharing_tools",this).fadeTo('fast',1);
    });
    $('.blogentry').mouseleave(function(){
        $(".sharing_tools",this).fadeTo('fast',0);
    });
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
        if (workInProgress == "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            var url = "show_more_posts.php";
            $.post(url, { start_from: position, channel: chan}, function (data) {
	            $("#entries-main-container").append(data);
               	fixDimensions();
                
                $('.blogentry').fadeTo('slow', 1);
                position = position + 14;
                workInProgress = "no";
                $(document).scrollTop = s;
            });
        }
    }
}


// When document loads
$(document).ready(function(){
	fixDimensions();
    $('#lb_interface .blogentry').fadeTo('fast', 1);
	$('#entries-main-container').waitForImages(function() {
		$('.loader').fadeTo('fast',0);
	   	$('.blogentry').fadeTo('slow', 1);
	});
    $("#whichchannel").change(function(){
        if ($(this).val()!='') {
            window.location.href=$(this).val() ;
        }
    });
	do_scroll_math();

}); 

// When document scrolls

$(window).scroll(function () {
        do_scroll_math();
});

// When document is resized / code source: http://stackoverflow.com/questions/5489946/jquery-how-to-wait-for-the-end-or-resize-event-and-only-then-perform-an-ac

var doit;
$(window).resize(function() {
    clearTimeout(doit);
    doit = setTimeout(function() {
        fixDimensions();
    }, 100);
});




