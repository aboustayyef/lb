// function to fix the widths of the excerpts
var workInProgress = 'no';


// selection ***********

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
    focus : function(post){
        $('.compact.selected').removeClass('selected');
        selection.position = post.attr("data-post-number");
        $('.compact[data-post-number='+selection.position+']').addClass('selected');
    }
};



function showLazyImages(post){
    var ourImage = post.find($('img'));
        ourImage.attr('src',ourImage.attr('data-original'));
}

var images = {
    show : function(){
        //do nothing.. The method should exist, but it is not needed in the compact mode.
    },
};

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


// object that handles scrolling of the pageview

var posts ={
    reset : function(){
        
        // how many posts are loaded?
        this.number = $('.compact').length;
        
        // What is the height of (each) post? 
        this.postheight = $('.compact').eq(0).outerHeight();
        
        // how many posts exist per view (window)
        this.perView = Math.floor($('#view-area').height()/this.postheight);

        // How many posts are above the first visible post? (at load: 0)
        this.amountScrolled = Math.floor(Math.abs($('#view-area').scrollTop())/this.postheight);
        this.firstPost = 0;
    },
    scrollDown : function(howManyRows){
        this.reset();
        // first make sure we're not at the bottom
        var destination = (this.amountScrolled * this.postheight)+(this.postheight * howManyRows);
        $('#view-area').scrollTop(destination);
    },
    scrollUp : function(howManyRows){
        this.reset();
        // first make sure we're not at the top
        var destination = (this.amountScrolled * this.postheight)-(this.postheight * howManyRows);
        if (destination > 0) {
            $('#view-area').scrollTop(destination);
        } else {
            $('#view-area').scrollTop(0);
        }
    },
    show : function(){
        //nothing.. deployed because _interface.js uses it
    },
    hide : function(){
        //nothing deployed because _interface.js uses it
    },
    flow : function(){
        fixExcerptWidths();
    }
};

var do_scroll_math = function() {
    var docHeight = $('#posts').height();
    var howFarDown = $('#view-area').scrollTop();
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
                posts.flow();
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


/**
*   Compact specific general handlers
*/

$(document).ready(function(){
    selection.show();
    $('.compact').on('click',function(){
        selection.focus($(this));
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

var do_resize_compact;
$(window).resize(function() {
    clearTimeout(do_resize_compact);
    do_resize_compact = setTimeout(function() {
        posts.flow();
        posts.show();
    }, 100);
});

var do_scroll_it;
$('#view-area').scroll(function() {
    clearTimeout(do_scroll_it);
    do_scroll_it = setTimeout(function() {
        do_scroll_math();
    }, 100);
});