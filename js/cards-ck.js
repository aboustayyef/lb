// set behavior of cards in cards view
// parameters
function getDesiredWidth(){var e=$(window).width();$(window).width()>768&&(e=$(window).width()-$("#left-col-wrapper").outerWidth());extraSpace=e%unitTotalWidth;var t=e-extraSpace;t>unitTotalWidth*5&&(t=unitTotalWidth*5);return t}function getColumnNumbers(){var e=getDesiredWidth(),t=e/unitTotalWidth;t>5&&(t=5);return t}function fixCards(){console.log("fixCards");var e=getDesiredWidth();$("#posts").width(e);$(window).width()>768?$("#posts").css("margin-left",extraSpace/2-5):$("#posts").css("margin-left",extraSpace/2);var t=getColumnNumbers();$("#posts").BlocksIt({numOfCol:t,offsetX:unitMargin,offsetY:unitMargin,blockElement:".card"});$("img.lazy").lazyload({effect:"fadeIn",container:$("#view-area")});$("img.lazy").removeClass("lazy")}function do_scroll_math(){var e=$("#posts").height(),t=Math.abs($("#posts").position().top),n=e-t;console.log(n);if(n<=1e3&&workInProgress==="no"){workInProgress="yes";$(".endloader").css("bottom",0);$(".endloader").fadeTo("slow",1);var r="contr_get_extra_posts.php";$.post(r,function(e){$("#posts").append(e);fixCards();$(".card").fadeTo("slow",1);$(document).scrollTop=n});$(".card").css("display","block");workInProgress="no"}}var padding=10,border=1,content=278,unitWidth=content+border*2+padding*2,unitMargin=10,unitTotalWidth=unitWidth+2*unitMargin,extraSpace,workInProgress="no";$(document).ready(function(){do_scroll_math();$("img.lazy").lazyload({effect:"fadeIn",threshold:500,container:$("#view-area")});$("img.lazy").removeClass("lazy")});$(window).load(function(){fixCards();$(".loader").toggle();$(".card").fadeTo("slow",1)});var do_scroll_it;$("#view-area").scroll(function(){clearTimeout(do_scroll_it);do_scroll_it=setTimeout(function(){do_scroll_math()},100)});var do_resize_cards;$(window).resize(function(){clearTimeout(do_resize_cards);do_resize_cards=setTimeout(function(){fixCards()},100)});