var viewArea = {
    getDetails: function(){
        var W = $(window).outerWidth(); // width of entire window
        var L = $('#left-col-wrapper').outerWidth(); // width of left nav
        var lDisplay = $('#left-col-wrapper').css("display");
        
        ///////
        this.width = lDisplay === "block" ? (W - L) : W ; // width of view area
        this.height = $(window).outerHeight()-$('.mainbar-wrapper').outerHeight();
        ///////
    },
};

var posts = {
    busy: "no",
    show: function(){
        $('.card').fadeTo('slow', 1);
    },
    hide: function(){
        $('.card').fadeTo('slow', 0);
    },
    getDetails: function(){
        var cardWidth = 320; // 278px + 2 (border 1 px) + 20 (margin 10px);
        this.columns = Math.floor(viewArea.width/cardWidth);
        this.width = this.columns*cardWidth; // width of posts area
        this.height = $('#posts').height();
        this.scrollAmount = Math.abs($('#posts').position().top);
        this.distanceToBottom = this.height - this.scrollAmount;
    },
    addMore: function(){
        this.busy = "yes"; //prevent concurrent loading of this function
        var url = "contr_get_extra_posts.php";
        $.post(url, function(data) {
            $("#posts").append(data);
            posts.flow();
            posts.show();
            images.show();
            posts.busy = "no";

        });

    },
    flow: function(){
        viewArea.getDetails(); posts.getDetails(); // reload all dimensions
        $('#posts').css("width", posts.width);
        $('#posts').css("margin", "0 auto");
        $('#posts').BlocksIt({
            numOfCol: posts.columns,
            offsetX: 10,
            offsetY: 10,
            blockElement: '.card'
        });
    },
};

var images = {
    show: function(){
        $("img.lazy").lazyload({
            threshold: 500,
            effect: "fadeIn",
            container: $("#view-area")
        });
    $("img.lazy").removeClass("lazy");
    t = $('#view-area').scrollTop();
    $('#view-area').scrollTop(t+1); //nudge 1 pixel to counter lazy load bug.
    },
};



/****************************
*   Event Handlers
***************************/

$(window).load(function(){ //when page first loads
    $('.loader').fadeTo('fast',0, function(){
        posts.flow();
        images.show();
        posts.show();
    });
});

$('#view-area').scroll(function() { // when page scrolls
    if (posts.busy === "yes") return;
    posts.getDetails();
    if (posts.distanceToBottom < 3000) {
          posts.addMore();
    }
});

var do_resize_cards;
$(window).resize(function() {
    clearTimeout(do_resize_cards);
    do_resize_cards = setTimeout(function() {
        posts.flow();
    }, 300);
});