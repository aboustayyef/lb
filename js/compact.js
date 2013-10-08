// function to fix the widths of the excerpts
var workInProgress = 'no';

function showLazyImages(postNumber){
    var ourImage = $('.compact[data-post-number="' + postNumber + '"').find($('img'));
        ourImage.attr('src',ourImage.attr('data-original'));
    $("img.lazy").removeClass("lazy");
}

var handleClicks = function(postNumber){
        workInProgress='yes';
        var thePost = $('.compact[data-post-number="' + postNumber + '"');
        if (thePost.hasClass('open')) {
            thePost.removeClass('open');
            workInProgress='no';
        }else{
            $('.compact.open').removeClass('open');
            thePost.addClass('open');
            var position = thePost.find($('.blog_name')).offset().top;
            console.log(position);
            showLazyImages(postNumber);
            $('#view-area').scrollTop(41*postNumber);
            workInProgress='no';
        }
};

var fixExcerptWidths = function(){
    $.each($('.compact'),function(){
        var viewWidth = $(this).width();
        var blogNameWidth = $(this).find($('.blog_name')).outerWidth();
        var postTitleWidth = $(this).find($('.post_title')).outerWidth();
        var postTimeWidth = $(this).find($('.post_time')).outerWidth();
        var desiredExcerptWidth = viewWidth - blogNameWidth - postTitleWidth - postTimeWidth -20;
        
        var excerpt = $(this).find($('.excerpt-preview'));
        if (desiredExcerptWidth < 10) { // too short excerpt
            excerpt.css('display','none');
            $(this).find($('.post_title')).css('width',viewWidth - blogNameWidth - postTimeWidth -20 );
        }else{
            excerpt.css('display','block');
            excerpt.outerWidth(desiredExcerptWidth);
        }
        $(this).css('opacity','1');
    });
};

var do_scroll_math = function() {
    var docHeight = $('#posts').height();
    var howFarDown = Math.abs($('#posts').position().top);
    var s = docHeight - howFarDown;
    console.log(s);
    if (s <= 1500) { // when we're almost at the bottom of the document
        if (workInProgress === "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            $('.endloader').css("bottom", 0);
            $('.endloader').fadeTo('slow', 1);
            
            var url = "contr_get_extra_posts.php";
            $.post(url, function(data) {
                $("#posts").append(data);
                fixExcerptWidths();
                $('.compact').fadeTo('slow', 1);
                $(document).scrollTop = s;
            });
            $(".compact").css("opacity", '1');
            workInProgress = "no";
            handleClicks();
        }
    }
};

$(document).ready(function() {
    showLazyImages();
    handleClicks();
});

$(window).load(function() {
        $('.loader').hide();
        fixExcerptWidths();
});

var do_resize_compact;
$(window).resize(function() {
    clearTimeout(do_resize_compact);
    do_resize_compact = setTimeout(function() {
        $('.compact').css('opacity','0');
        fixExcerptWidths();
    }, 100);
});

var do_scroll_it;
$('#view-area').scroll(function() {
    clearTimeout(do_scroll_it);
    do_scroll_it = setTimeout(function() {
        do_scroll_math();
    }, 100);
});