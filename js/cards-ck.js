var posts={busy:"no",show:function(){$(".card").fadeTo("slow",1)},hide:function(){$(".card").fadeTo("slow",0)},getDetails:function(){var e=320;this.columns=Math.floor(viewArea.width/e);this.width=this.columns*e;this.height=$("#posts").height();this.scrollAmount=Math.abs($("#posts").position().top);this.distanceToBottom=this.height-this.scrollAmount},addMore:function(){this.busy="yes";var e="contr_get_extra_posts.php";$.post(e,function(e){$("#posts").append(e);posts.flow();posts.show();images.show();posts.busy="no"})},flow:function(){viewArea.getDetails();posts.getDetails();$("#posts").css("width",posts.width);$("#posts").css("margin","0 auto");$("#posts").BlocksIt({numOfCol:posts.columns,offsetX:10,offsetY:10,blockElement:".card"})}},images={show:function(){$("img.lazy").lazyload({threshold:500,effect:"fadeIn",container:$("#view-area")});$("img.lazy").removeClass("lazy");var e=$("#view-area").scrollTop();$("#view-area").scrollTop(e+1)}};$("#view-area").scroll(function(){if(posts.busy==="yes")return;posts.getDetails();posts.distanceToBottom<3e3&&posts.addMore()});var do_resize_cards;$(window).resize(function(){clearTimeout(do_resize_cards);do_resize_cards=setTimeout(function(){posts.flow()},300)});var closeMenus=function(){$("#show-about li").removeClass("selected");$("#show-search li").removeClass("selected");$("#show-login li").removeClass("selected");$("#left-col-wrapper.float_it").css("display","none");$("#left-col-wrapper").removeClass("float_it");$("#menu-about").hide();$("#menu-search").hide();$("#menu-login").hide()};$("#show-about li").click(function(){if($("#show-about li").hasClass("selected"))closeMenus();else{closeMenus();$("#show-about li").toggleClass("selected");$("#menu-about").toggle()}});$("#show-search li").click(function(){if($("#show-search li").hasClass("selected"))closeMenus();else{closeMenus();$("#show-search li").toggleClass("selected");$("#menu-search").toggle()}});var leftNav={toggle:function(){$("#left-col-wrapper").toggle();$("#hamburger").toggle()},hide:function(){$("#left-col-wrapper").css("display","none");$("#hamburger").css("display","block")},show:function(){$("#left-col-wrapper").css("display","block");$("#hamburger").css("display","none")},visible:function(){return $("#left-col-wrapper").css("display")==="block"?!0:!1},init:function(){$(window).width()>768?leftNav.show():leftNav.hide()}};$("#hamburger").on("click",function(){leftNav.show();posts.flow()});$(".leftNav-dismiss").on("click",function(){leftNav.hide();posts.flow()});var modal={hide:function(){$("#modal").css("display","none")},show:function(){$("#modal").css("display","block")},message:function(e){$("#modal-body").html("<p>"+e+"<p>");modal.show()}},viewArea={getDetails:function(){var e=$(window).outerWidth(),t=$("#left-col-wrapper").outerWidth(),n=$("#left-col-wrapper").css("display");this.width=n==="block"?e-t:e;this.height=$(window).outerHeight()-$(".mainbar-wrapper").outerHeight()}},windows={setSizes:function(){viewArea.getDetails();$("#view-area").css("height",viewArea.height);$("#left-col-wrapper").css("height",$(window).height())}};$(window).load(function(){windows.setSizes();leftNav.init();$("#view-area").css("-webkit-overflow-scrolling","touch");$(".loader").fadeTo("fast",0,function(){posts.flow();images.show();posts.show()})});$(window).resize(function(){windows.setSizes()});