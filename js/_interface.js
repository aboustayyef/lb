// Javascript for interface behavior 

/**
*   sets dimensions of elements of the interface at load or at window size change
*
*   Depends on : 
*/
//@codekit-prepend "_test.js";

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


// this is the script that handles all resizing of windows

var windows = {
    setSizes: function(){
        viewArea.getDetails();
        $('#view-area').css('height', viewArea.height);
        $('#left-col-wrapper').css('height', $(window).height());
    }
};

// Things to do after everything else has loaded

$(window).load(function() {
    windows.setSizes();
    leftNav.init();
    $('#view-area').css('-webkit-overflow-scrolling', 'touch');    // for safari smooth scrolling
    $('.loader').fadeTo('fast',0, function(){
    posts.flow(); // fix dimensions & locations in posts. each viewtype will have a "posts" object with flow() and show() methos
    images.show(); // load lazy images
    posts.show(); // show everything
    });
});

// Things to do when window is resized
$(window).resize(function() {
    windows.setSizes();
});