// set behavior of cards in timeline view

// Things to load after everything else has loaded

function showLazyImages(){
    $("img.lazy").lazyload({
        effect: "fadeIn",
        threshold: 500,
        container: $("#view-area")
    });
    $("img.lazy").removeClass("lazy");
}

var workInProgress = 'no';
function do_scroll_math() {
    var docHeight = $('#posts').height();
    var howFarDown = Math.abs($('#posts').position().top);
    var s = docHeight - howFarDown;
    console.log(s);
    if (s <= 1000) { // when we're almost at the bottom of the document
        if (workInProgress === "no") { // used to prevent overlapping background loading
            workInProgress = "yes";
            $('.endloader').css("bottom", 0);
            $('.endloader').fadeTo('slow', 1);
            
            var url = "contr_get_extra_posts.php";
            $.post(url, function(data) {
                $("#posts").append(data);
                $('.timeline').fadeTo('slow', 1);
                $(document).scrollTop = s;
            });
            workInProgress = 'no';
        }
    
    }
}

// the objects images and posts must exist, they are called in interface.js

var images ={
    show: function(){
        showLazyImages();
        var t = $('#view-area').scrollTop();
        $('#view-area').scrollTop(t+1); //nudge 1 pixel to counter lazy load bug.
    }
};

var posts = {
    show: function(){
        $('.timeline').fadeTo('slow', 1);
    },
    flow: function(){
        // nothing
    },
    hide: function(){
        //nothing
    }
};

var do_scroll_it;
$('#view-area').scroll(function() {
    clearTimeout(do_scroll_it);
    do_scroll_it = setTimeout(function() {
        do_scroll_math();
        showLazyImages();
    }, 100);
});