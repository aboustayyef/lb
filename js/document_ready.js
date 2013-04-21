// parameters
var padding = 10;
var border = 1;
var content = 278;
var unitWidth = content+(border*2)+(padding*2); // 300
var unitMargin = 10;
var unitTotalWidth = unitWidth + (2*unitMargin); //320

// preparation functions

function getDesiredWidth(){
	var wdth = $(window).width();
	var extraSpace = wdth % unitTotalWidth;
	var desiredWidth = wdth - extraSpace;
	if (desiredWidth>(unitTotalWidth*7)) {
		desiredWidth=(unitTotalWidth*7); //max 7 columns
	}
	return desiredWidth;
}

function getColumnNumbers(){
	var desiredWidth = getDesiredWidth();
	var columns = desiredWidth / unitTotalWidth;
	if (columns > 7) { // maximum columns
		columns = 7;
	}
	return columns;
}

function fixDimensions(){
	desiredWidth = getDesiredWidth();

	//fix post entries next
	$('#entries-main-container').width(desiredWidth);
	var columns = getColumnNumbers();

		$('#entries-main-container').BlocksIt({
			numOfCol: columns,
			offsetX: unitMargin,
			offsetY: unitMargin,
			blockElement: '.blogentry'
		});
}

// scrolling math 

var workInProgress = "no";
var position = 18; // initial value is the one right after the first bunch

function do_scroll_math() {
    var wh = $(window).height();
    var dh = $(document).height();
    var s = $(document).scrollTop();

    if (s >= (dh - wh - 1000)) { // when we're almost at the bottom of the document
        if (workInProgress == "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            var url = "show_more_posts.php";
            $.post(url, {
                start_from: position
            }, function (data) {
                $("#entries-main-container").append(data);
               	var columns = getColumnNumbers();
                $('#entries-main-container').BlocksIt({
					numOfCol: columns,
					offsetX: unitMargin,
					offsetY: unitMargin,
					blockElement: '.blogentry'
                });
                
                $('.blogentry').fadeTo('slow', 1);

                position = position + 20;
                workInProgress = "no";
                $(document).scrollTop = s;

            });
        }
    }
}


// When document loads
$(document).ready(function(){
	fixDimensions();
	$('.loader').fadeTo('fast',0);
   	$('.blogentry').fadeTo('slow', 1);

	do_scroll_math();
}); 

// When document scrolls

$(window).scroll(function () {
        do_scroll_math();
});

// When document is resized / code source: http://stackoverflow.com/questions/5489946/jquery-how-to-wait-for-the-end-or-resize-event-and-only-then-perform-an-ac

var doit;
function resizedw(){
    fixDimensions();

}
$(window).resize(function() {
    clearTimeout(doit);
    doit = setTimeout(function() {
        resizedw();
    }, 100);
});




