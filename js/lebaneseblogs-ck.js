var lbApp={init:function(){},posts:{window:$("#posts"),busy:"no",init:function(){global_viewtype==="cards"?this.module=$(".card"):global_viewtype==="timeline"?this.module=$(".timeline"):this.module=$(".compact")},show:function(){this.init();this.module.fadeTo("slow",1)},hide:function(){this.init();this.module.fadeTo("slow",0)},flow:function(){if(global_viewtype==="cards"){this.cardWidth=320;this.columns=Math.floor(lbApp.interface.viewArea.window.outerWidth()/this.cardWidth);this.windowWidth=this.columns*this.cardWidth;this.window.css("width",this.windowWidth);this.window.css("margin","0 auto");this.window.BlocksIt({numOfCol:this.columns,offsetX:10,offsetY:10,blockElement:".card"})}else global_viewtype==="timeline"},addMore:function(){lbApp.posts.busy="yes";var e="contr_get_extra_posts.php";$.post(e,function(e){lbApp.posts.window.append(e);lbApp.posts.flow();lbApp.posts.show();lbApp.posts.images.show();lbApp.posts.busy="no"})},images:{show:function(){$("img.lazy").lazyload({threshold:500,effect:"fadeIn",container:$("#view-area")});$("img.lazy").removeClass("lazy");var e=$("#view-area").scrollTop();$("#view-area").scrollTop(e+1)}}},"interface":{init:function(){(global_page==="browse"||global_page==="top")&&this.leftNav.init();this.setDimensions();this.menus.init();this.modal.init();$("#view-area").css("-webkit-overflow-scrolling","touch")},revealContent:function(){$(".loader").fadeTo("fast",0,function(){$("#view-area").fadeTo("fast",1)})},header:$(".mainbar-wrapper"),sidebar:$("#left-col-wrapper"),viewArea:{window:$("#view-area"),handleScroll:function(){this.window.on("scroll",function(){if(lbApp.posts.busy==="yes"){console.log("busy updating");return}var e=Math.abs(lbApp.posts.window.position().top),t=lbApp.posts.window.height()-e;console.log("distanceToBottom: "+t);t<3e3&&lbApp.posts.addMore()})}},setDimensions:function(){lbApp.interface.sidebar.css("height",jQuery(window).outerHeight()-2);lbApp.interface.viewArea.window.css("height",jQuery(window).outerHeight()-lbApp.interface.header.outerHeight())},leftNav:{init:function(){$(window).width()>768?this.show():this.hide();$("#hamburger").on("click",function(){lbApp.interface.leftNav.show();lbApp.posts.flow()});$(".leftNav-dismiss").on("click",function(){lbApp.interface.leftNav.hide();lbApp.posts.flow()})},toggle:function(){lbApp.sidebar.toggle();$("#hamburger").toggle()},hide:function(){lbApp.interface.sidebar.css("display","none");$("#hamburger").css("display","block")},show:function(){lbApp.interface.sidebar.css("display","block");$("#hamburger").css("display","none")},visible:function(){return lbApp.interface.sidebar.css("display")==="block"?!0:!1}},modal:{init:function(){$(".modal-dismiss").on("click",function(){lbApp.interface.modal.hide()});$(document).on("keydown",function(e){e.which===27&&lbApp.interface.modal.hide()})},hide:function(){$("#modal").css("display","none")},show:function(){$("#modal").css("display","block")},message:function(e){$("#modal-body").html("<p>"+e+"<p>");lbApp.interface.modal.show()}},menus:{init:function(){$("#menu-icons > li").on("click",function(){if($(this).hasClass("selected")){$(".menu").hide();$(this).removeClass("selected")}else{$(".menu").hide();$("#menu-icons > li").removeClass("selected");$(this).addClass("selected");var e=$(this).attr("data-menu");console.log(e+"test");$("#"+e).show()}})}},compactView:{init:function(){lbApp.posts.module.on("click",function(){lbApp.interface.compactView.handleClicks($(this))});this.selection.init()},selection:{init:function(){theSelection=lbApp.interface.compactView.selection;theSelection.show();$(document).on("keydown",function(e){var t=e.which;if(t===74||t===40){theSelection.moveDown();theSelection.show()}else if(t===75||t===38){theSelection.moveUp();theSelection.show()}else(t===13||t===32||t===79)&&lbApp.interface.compactView.handleClicks($(".compact.selected"))})},position:0,moveUp:function(){this.position>0&&(this.position=this.position-1)},moveDown:function(){this.position=parseInt(this.position,10)+1},show:function(){$(".compact.selected").removeClass("selected");$(".compact[data-post-number="+this.position+"]").addClass("selected")},focus:function(e){$(".compact.selected").removeClass("selected");this.position=e.attr("data-post-number");$(".compact[data-post-number="+this.position+"]").addClass("selected")}},handleClicks:function(e){var t=e.attr("data-post-number");this.selection.position=t;this.selection.show();if(e.hasClass("open"))e.removeClass("open");else{$(".compact.open").removeClass("open");e.addClass("open");$("#view-area").scrollTop(41*t)}}}},bloggerPage:{window:$(".bloggerPosts"),flow:function(){this.cardWidth=320;this.columns=Math.floor(lbApp.interface.viewArea.window.outerWidth()/this.cardWidth);this.windowWidth=this.columns*this.cardWidth;this.window.css("width",this.windowWidth);this.window.css("margin","0 auto");$(".blogMeta").css({width:this.window.width()-60,margin:"0 auto"});this.window.BlocksIt({numOfCol:this.columns,offsetX:10,offsetY:10,blockElement:".card"})},loadImages:function(){$("img.lazy").lazyload({threshold:500,effect:"fadeIn"});$("img.lazy").removeClass("lazy");var e=$(".blogger").scrollTop();$(window).scrollTop(e+1)}},aboutPage:{init:function(){var e=0;$("#section-choose li").each(function(){e+=$(this).outerWidth()});$("ul#section-choose").css({width:e+3,margins:"0 auto"});$("#submitBlog").on("click",function(){var e=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/,t=$("#submitblog").val();if(e.test(t)){var n={key:"qsdljkhqepoi3420$98346adfs34",kind:"[SUBMISSION]",submittedText:t};$.ajax({url:"mailer.php",type:"POST",data:n,success:function(e){$("#submitblog").val("");lbApp.interface.modal.message(e)}})}else lbApp.interface.modal.message("Sorry, you should submit a URL");return!1});$("#submitFeedback").on("click",function(){var e=$("textarea#feedback").val();if(e!==""){var t={key:"qsdljkhqepoi3420$98346adfs34",kind:"[FEEDBACK]",submittedText:e};$.ajax({url:"mailer.php",type:"POST",data:t,success:function(e){$("textarea#feedback").val("");lbApp.interface.modal.message(e)}})}else lbApp.interface.modal.message("Sorry, Feedback message cannot be left empty");return!1})}}};$(window).load(function(){lbApp.interface.init();if(global_page==="browse"){lbApp.posts.init();lbApp.posts.flow();lbApp.posts.images.show();lbApp.posts.show();lbApp.interface.viewArea.handleScroll();global_viewtype==="compact"&&lbApp.interface.compactView.init();lbApp.interface.revealContent()}if(global_page==="about"){lbApp.aboutPage.init();lbApp.interface.revealContent()}if(global_page==="blogger"){lbApp.bloggerPage.flow();lbApp.interface.revealContent();lbApp.bloggerPage.loadImages();$(".endloader").hide()}global_page==="top"&&lbApp.interface.revealContent()});var do_resize;$(window).resize(function(){clearTimeout(do_resize);do_resize=setTimeout(function(){if(global_page==="browse"){lbApp.interface.setDimensions();lbApp.posts.flow()}global_page==="blogger"&&lbApp.bloggerPage.flow()},300)});