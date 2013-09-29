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

$(window).load(function() {
    showLazyImages();
    $('#posts').waitForImages(function() {
        $('.loader').toggle();
        $('.timeline').fadeTo('slow', 1);
    });
});

$(document).ready(function() {
    showLazyImages();
});

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

var do_scroll_it;
$('#view-area').scroll(function() {
    clearTimeout(do_scroll_it);
    do_scroll_it = setTimeout(function() {
        do_scroll_math();
        showLazyImages();
    }, 100);
});