// Behavior of Menus

var closeMenus = function(){ // function to close other menus when one is opened
    //remove menu navs
    $('#show-about li').removeClass('selected');$('#show-search li').removeClass('selected');$('#show-login li').removeClass('selected');

    $('#left-col-wrapper.float_it').css('display','none');
    $('#left-col-wrapper').removeClass('float_it');

    $('#menu-about').hide(); $('#menu-search').hide();$('#menu-login').hide();
};

$('#show-about li').click(function(){
    if ($('#show-about li').hasClass('selected')) {
       closeMenus();
    }else{
    closeMenus();
    $('#show-about li').toggleClass('selected');
    $('#menu-about').toggle();}
});

$('#show-search li').click(function(){
    if ($('#show-search li').hasClass('selected')) {
       closeMenus();
    }else{
    closeMenus();
    $('#show-search li').toggleClass('selected');
    $('#menu-search').toggle();}
});

var leftNav = {
    toggle: function(){
        $('#left-col-wrapper').toggle();
        $('#hamburger').toggle();
    },
    hide: function(){
        $('#left-col-wrapper').css("display","none");
        $('#hamburger').css("display","block");
    },
    show: function(){
        $('#left-col-wrapper').css("display", "block");
        $('#hamburger').css("display","none");
    },
    visible: function(){
        if ($('#left-col-wrapper').css("display") === "block") {
            return true;
        }else {
            return false;
        }
    },
    init: function(){
        if ($(window).width()>768) { //by default, show left nave for larger windows
            leftNav.show();
        }else{
            leftNav.hide(); // hide left nav for small screens
        }
    }
};


/********************
*   Event Handlers
*********************/ 

$('#hamburger').on('click', function(){
    leftNav.show();
    posts.flow();
});

$('.leftNav-dismiss').on('click', function(){
    leftNav.hide();
    posts.flow();
});


/*******************************************************************
*    MODAL Class
********************************************************************/
var modal = {
    hide: function(){
        $('#modal').css('display','none');
    },
    show: function(){
        $('#modal').css('display','block');
    },
    message: function(message){
        $('#modal-body').html("<p>"+message+"<p>");
        modal.show();
    }
};