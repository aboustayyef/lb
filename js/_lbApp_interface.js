lbApp.interfaceElements =
{
  init: function()    // initialize all menu items below
  {
    this.viewArea.adjust(); // Adjust the height of the viewing window to fit browser
    this.sidebar.init(); // Adjust sidebar's height and whether it should be visible at first load
    this.header.menus.init(); // initialize menu
  },
  header :
  {
    $header: $('.mainbar-wrapper'),
    menus : // for handling the Navigation menu
    {
      init: function()
      {
        $('#menu-icons > li').on('click',function(){
          if ($(this).hasClass('selected'))
          { // If clicked on open menu, just close it
            $('.menu').hide(); // hide all open windows
            $(this).removeClass('selected');
          }else{ // clicked on a closed menu
            $('.menu').hide(); // hide all open windows
            $('#menu-icons > li').removeClass("selected"); // deselect all
            $(this).addClass("selected"); // select the one we clicked on
            var whichWindow = $(this).data('menu'); // choose menu to open
            $('#'+whichWindow).show(); // open it
            if (whichWindow == 'menu-search') // add focus() to the search
            {
              $('#search-box').focus();
            }
          }
        });
      }

    },
  },
  sidebar :
  {
    // sidebar changes height everytime window is resized.
    $sideBar : $('div#left-col-wrapper'),
    adjust: function()
    {
      this.$sideBar.css('height', $(window).outerHeight());
    },
    init: function()
    {
      
      this.adjust(); // Adjust height
      //by default, show left sidebar for larger windows & hide it for small screens
      if (($(window).width()<768) || (global_leftColumnInitialState === "closed") )
      {
        this.hide();
      }else{
        this.show();
      }
    },
    hide: function(){
      this.$sideBar.hide();
      $('#hamburger').show();
    },
    show: function(){
      this.$sideBar.show();
      $('#hamburger').hide();
    },
    visible: function(){
      if (this.$sideBar.css("display") === "block") {
        return true;
      }else {
        return false;
      }
    },
  },
  viewArea :
  {
    // viewArea changes height everytime window is resized.
    $viewArea : $('#view-area'),
    cardWidth : 320, //278px + 2 (border 1 px) + 20 (margin 10px);
    adjust: function()
    {
      this.$viewArea.css('height', $(window).outerHeight() - lbApp.interfaceElements.header.$header.outerHeight());
    },
    numberOfColumns: function()
    {
      return Math.floor(this.$viewArea.outerWidth()/this.cardWidth);
    },
    windowWidth : function(){
      return this.numberOfColumns()* this.cardWidth;
    },
    revealContent: function()
    {
      $('.loader').fadeTo('fast',0, function(){
        $('#view-area').fadeTo('fast',1);
      });
    },
  }
};

/* Interface Events */

//leftbar event handlers
$('#hamburger').on('click', function(e){
  lbApp.interfaceElements.sidebar.show();
  lbApp.reArrange();
});

$('.leftNav-dismiss').on('click', function(e){
  lbApp.interfaceElements.sidebar.hide();
  lbApp.reArrange();
});

$(window).smartresize(function(){
  lbApp.reArrange();
});