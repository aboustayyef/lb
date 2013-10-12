// Behavior of Menus

var closeMenus = function(){ // function to close other menus when one is opened
    //remove menu navs
    $('#show-about li').removeClass('selected');$('#show-search li').removeClass('selected');$('#show-login li').removeClass('selected');

    $('#left-col-wrapper.float_it').css('display','none');
    $('#left-col-wrapper').removeClass('float_it');

    $('#menu-about').hide(); $('#menu-search').hide();$('#menu-login').hide();
};

$('#hamburger').on('click', function(){
    var c = $('#left-col-wrapper');
    var d = c.css('display');

    if (d==='block') {
        closeMenus();
    }else{
        closeMenus();
        c.css('display','block');
        c.addClass('float_it');
        console.log(c.css());
    }

});

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