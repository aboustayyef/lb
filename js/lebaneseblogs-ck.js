// codescript code to concatenate all js files and reduce http requests
// parameters
function getDesiredWidth(){var e=$(window).width()-$("#left-col-wrapper").outerWidth();extraSpace=e%unitTotalWidth;var t=e-extraSpace;t>unitTotalWidth*5&&(t=unitTotalWidth*5);return t}function getColumnNumbers(){var e=getDesiredWidth(),t=e/unitTotalWidth;t>5&&(t=5);return t}function fixDimensions(){var e=getDesiredWidth();$("#posts").width(e);$("#posts").css("margin-left",extraSpace/2-5);var t=$(window).height()-$(".mainbar-wrapper").height();$("#view-area").css("height",t);$("#left-col-wrapper").css("height",t);$("#left-col-wrapper").fadeTo("slow",1);var n=getColumnNumbers();$("#posts").BlocksIt({numOfCol:n,offsetX:unitMargin,offsetY:unitMargin,blockElement:".card"});$("img.lazy").lazyload({effect:"fadeIn",container:$("#view-area")});$("img.lazy").removeClass("lazy")}function do_scroll_math(){var e=$("#posts").height(),t=Math.abs($("#posts").position().top),n=e-t;console.log(n);if(n<=1e3&&workInProgress==="no"){workInProgress="yes";$(".endloader").css("bottom",0);$(".endloader").fadeTo("slow",1);var r="contr_get_extra_posts.php";$.post(r,function(e){$("#posts").append(e);fixDimensions();$(".card").fadeTo("slow",1);$(document).scrollTop=n});$(".card").css("display","block");workInProgress="no"}}var padding=10,border=1,content=278,unitWidth=content+border*2+padding*2,unitMargin=10,unitTotalWidth=unitWidth+2*unitMargin,extraSpace,workInProgress="no";$(document).ready(function(){do_scroll_math();$("img.lazy").lazyload({effect:"fadeIn",threshold:500,container:$("#view-area")});$("img.lazy").removeClass("lazy")});$(window).load(function(){fixDimensions();$("#posts").waitForImages(function(){$(".loader").toggle();$(".card").fadeTo("slow",1)})});$("#searchtoggle").click(function(){$("#search").css("opacity","1");$("#search").css("width","200px");$("#search").focus();$("#searchtoggle").toggle()});$("#search").focusout(function(){$("#search").css("width","0");$("#search").css("opacity","0");$("#searchtoggle").toggle()});var do_scroll_it;$("#view-area").scroll(function(){clearTimeout(do_scroll_it);do_scroll_it=setTimeout(function(){console.log("making the call");$("img.lazy").lazyload({container:$("#view-area"),effect:"fadeIn"});$("img.lazy").removeClass("lazy");do_scroll_math()},100)});var do_resize_it;$(window).resize(function(){clearTimeout(do_resize_it);do_resize_it=setTimeout(function(){fixDimensions()},100)});