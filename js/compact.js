// function to fix the widths of the excerpts
var workInProgress = 'no';

var selection = {
    position : 0,
    moveUp : function(){
        if (selection.position >0) {
            selection.position = selection.position - 1;
        }
    },
    moveDown : function(){
        //if (selection.position < $('.compact').length){
           selection.position = parseInt(selection.position,10) + 1;
//        }
    },
    show : function(){
        $('.compact.selected').removeClass('selected');
        $('.compact[data-post-number='+selection.position+']').addClass('selected');
    },
};


function showLazyImages(post){
    var ourImage = post.find($('img'));
        ourImage.attr('src',ourImage.attr('data-original'));
    $("img.lazy").removeClass("lazy");
}


var handleClicks = function(post){
        console.log(post);
        var whichPost = post.attr('data-post-number');
        selection.position=whichPost;
        selection.show();
        if (post.hasClass('open')) {
            //clicking on an open post will only close it.
            post.removeClass('open');
        }else{
            // close currently open class
            $('.compact.open').removeClass('open');
            
            // open selected class class
            post.addClass('open');
            showLazyImages(post);
            $('#view-area').scrollTop(41*(whichPost));
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
        if ($('.compact').outerWidth() > 480) {
            if (desiredExcerptWidth < 10) { // too short excerpt
                excerpt.css('display','none');
                $(this).find($('.post_title')).css('width',viewWidth - blogNameWidth - postTimeWidth -20 );
            }else{
                excerpt.css('display','block');
                excerpt.outerWidth(desiredExcerptWidth);
            }
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
                $('.compact').on('click',function(){
                    handleClicks($(this));
                });
                $(document).scrollTop = s;
            });
            $(".compact").css("opacity", '1');
            workInProgress = "no";
            handleClicks();
        }
    }
};

$(document).ready(function(){
    selection.show();
    $('.compact').on('click',function(){
        handleClicks($(this));
    });
});



/**
*   Handle keystroke navigations
*/

$(document).on('keydown', function(event){
    var keyPressed = event.which;
    console.log('key pressed: '+keyPressed);
    if ((keyPressed === 74) || (keyPressed === 40)) { //j or Down arrow
       
        selection.moveDown();
        selection.show();

    } else if ((keyPressed === 75) || (keyPressed === 38)) { //k or up arrow
        
        selection.moveUp();
        selection.show();

    } else if ((keyPressed === 13) || (keyPressed === 32) || (keyPressed === 79)) { //Spacebar or Enter Key or 'o' button
        handleClicks($('.compact.selected'));
        }
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