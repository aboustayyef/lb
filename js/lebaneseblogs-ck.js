var lbApp={init:function(){},posts:{window:$("#posts"),busy:"no",init:function(){global_viewtype==="cards"?this.module=$(".card"):global_viewtype==="timeline"?this.module=$(".timeline"):this.module=$(".compact")},show:function(){this.init();this.module.fadeTo("slow",1)},hide:function(){this.init();this.module.fadeTo("slow",0)},flow:function(){global_viewtype==="cards"?lbApp.interface.cards.flow():global_viewtype==="timeline"},addMore:function(){lbApp.posts.busy="yes";var e;global_page==="favorites"?e="contr_get_favorites_extra_posts.php":global_page==="saved"?e="contr_get_saved_extra_posts.php":e="contr_get_extra_posts.php";$.post(e,function(e){lbApp.posts.window.append(e);lbApp.posts.flow();lbApp.posts.show();lbApp.interface.showLazyImages();lbApp.posts.busy="no"})},saved:{init:function(){var e='<a class="addToSaved" href="#"><i class="icon-heart"></i> Save Post</a>',t='<a class="removeFromSaved" href="#"><i class="icon-heart selected"></i> Saved</a>';$("body").on("click","li.save_toggle",function(){var n=$(this).data("user"),r=$(this).data("url"),i=$('.save_toggle[data-url="'+r+'"]'),s=i.html();s===e?i.html("Saving.."):i.html("Removing..");$.post("contr_toggle_saved.php",{user:n,url:r},function(n){var i=$('.save_toggle[data-url="'+r+'"]'),s=i.html();s==="Saving.."?i.html(t):i.html(e)})})}},favorites:{init:function(){var e='<a class="addToFavorites" href="#"><i class="icon-star"></i> Add Blog to Favorites</a>',t='<i class="icon-star" style="color:#FC0"></i> Favorite (<a class="removeFromFavorites" href="#">remove</a>)';$("body").on("click",".favorite_toggle",function(){var n=$(this).data("blog"),r=$(this).data("user");$('.favorite_toggle[data-blog="'+n+'"]').each(function(){var t=$(this).html();t===e?$(this).html(" adding.. "):$(this).html(" removing.. ");console.log(t)});$.post("contr_toggle_favorites.php",{user:r,blog:n},function(r){$('.favorite_toggle[data-blog="'+n+'"]').each(function(){var n=$(this).html();n===" adding.. "?$(this).html(t):$(this).html(e);console.log(n)})});global_page==="favorites"&&location.reload()})}},images:{show:function(){$("img.lazy").lazyload({threshold:500,effect:"fadeIn",container:$("#view-area")});$("img.lazy").removeClass("lazy")},nudge:function(){var e=$("#view-area").scrollTop();$("#view-area").scrollTop(e+1)}}},"interface":{columns:Math.floor(($("#view-area").outerWidth()-20)/320),init:function(){(global_page==="browse"||global_page==="top"||global_page==="favorites"||global_page==="saved")&&this.leftNav.init();this.setDimensions();this.menus.init();this.modal.init();$("#view-area").css("-webkit-overflow-scrolling","touch")},cards:{flow:function(){var e=320,t=Math.floor(($("#view-area").outerWidth()-20)/e);t<1&&(t=1);var n=t*e;console.log(n);$("#posts").css("width",n);$("#posts").css("margin","0 auto");$("#posts").BlocksIt({numOfCol:t,offsetX:10,offsetY:10,blockElement:".card-container"})}},revealContent:function(){$(".loader").fadeTo("fast",0,function(){$("#view-area").fadeTo("fast",1)})},header:$(".mainbar-wrapper"),sidebar:$("#left-col-wrapper"),viewArea:{window:$("#view-area"),handleScroll:function(){this.window.on("scroll",function(){if(lbApp.posts.busy==="yes"){console.log("busy updating");return}var e=Math.abs(lbApp.posts.window.position().top),t=lbApp.posts.window.height()-e;console.log("distanceToBottom: "+t);t<3e3&&lbApp.posts.addMore()})}},setDimensions:function(){lbApp.interface.sidebar.css("height",jQuery(window).outerHeight());lbApp.interface.viewArea.window.css("height",jQuery(window).outerHeight()-lbApp.interface.header.outerHeight());$("div.left-col-inner").height()>$("#left-col-wrapper").height()?$("#left-col-wrapper").css("overflow-y","scroll"):$("#left-col-wrapper").css("overflow-y","hidden")},showLazyImages:function(){$("img.lazy").each(function(){$(this).attr("src",$(this).data("original"));$(this).removeClass("lazy")})},leftNav:{init:function(){$(window).width()>768?this.show():this.hide();$("#hamburger").on("click",function(){lbApp.interface.leftNav.show();lbApp.posts.flow()});$(".leftNav-dismiss").on("click",function(){lbApp.interface.leftNav.hide();lbApp.posts.flow()})},toggle:function(){lbApp.sidebar.toggle();$("#hamburger").toggle()},hide:function(){lbApp.interface.sidebar.css("display","none");$("#hamburger").css("display","block")},show:function(){lbApp.interface.sidebar.css("display","block");$("#hamburger").css("display","none")},visible:function(){return lbApp.interface.sidebar.css("display")==="block"?!0:!1}},modal:{init:function(){$(".modal-dismiss").on("click",function(){lbApp.interface.modal.hide()});$(document).on("keydown",function(e){e.which===27&&lbApp.interface.modal.hide()})},hide:function(){$("#modal").css("display","none")},show:function(){$("#modal").css("display","block")},message:function(e){$("#modal-body").html("<p>"+e+"<p>");lbApp.interface.modal.show()}},menus:{init:function(){$("#menu-icons > li").on("click",function(){if($(this).hasClass("selected")){$(".menu").hide();$(this).removeClass("selected")}else{$(".menu").hide();$("#menu-icons > li").removeClass("selected");$(this).addClass("selected");var e=$(this).attr("data-menu");console.log(e+"test");$("#"+e).show();if(e=="menu-search"){console.log("yes");$("#search-box").focus()}}})}},compactView:{init:function(){lbApp.posts.module.on("click",function(){lbApp.interface.compactView.handleClicks($(this))});this.selection.init()},selection:{init:function(){theSelection=lbApp.interface.compactView.selection;theSelection.show();$(document).on("keydown",function(e){var t=e.which;if(t===74||t===40){theSelection.moveDown();theSelection.show()}else if(t===75||t===38){theSelection.moveUp();theSelection.show()}else(t===13||t===32||t===79)&&lbApp.interface.compactView.handleClicks($(".compact.selected"))})},position:0,moveUp:function(){this.position>0&&(this.position=this.position-1)},moveDown:function(){this.position=parseInt(this.position,10)+1},show:function(){$(".compact.selected").removeClass("selected");$(".compact[data-post-number="+this.position+"]").addClass("selected")},focus:function(e){$(".compact.selected").removeClass("selected");this.position=e.attr("data-post-number");$(".compact[data-post-number="+this.position+"]").addClass("selected")}},handleClicks:function(e){var t=e.attr("data-post-number");this.selection.position=t;this.selection.show();if(e.hasClass("open"))e.removeClass("open");else{$(".compact.open").removeClass("open");e.addClass("open");$("#view-area").scrollTop(41*t)}}}},bloggerPage:{window:$(".bloggerPosts"),flow:function(){this.cardWidth=320;this.columns=Math.floor(lbApp.interface.viewArea.window.outerWidth()/this.cardWidth);this.windowWidth=this.columns*this.cardWidth;this.window.css("width",this.windowWidth);this.window.css("margin","0 auto");$(".blogMeta").css({width:this.window.width()-60,margin:"0 auto"});this.window.BlocksIt({numOfCol:this.columns,offsetX:10,offsetY:10,blockElement:".card-container"})},show:function(){$(".card").css("opacity","1")},loadImages:function(){$("img.lazy").lazyload({threshold:500,effect:"fadeIn"});$("img.lazy").removeClass("lazy");var e=$(".blogger").scrollTop();$(window).scrollTop(e+1)}},aboutPage:{init:function(){var e=0;$("#section-choose li").each(function(){e+=$(this).outerWidth()});$("ul#section-choose").css({width:e+3,margins:"0 auto"});$("#submitBlog").on("click",function(){var e=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/,t=$("#submitblog").val();if(e.test(t)){var n={key:"qsdljkhqepoi3420$98346adfs34",kind:"[SUBMISSION]",submittedText:t};$.ajax({url:"mailer.php",type:"POST",data:n,success:function(e){$("#submitblog").val("");lbApp.interface.modal.message(e)}})}else lbApp.interface.modal.message("Sorry, you should submit a URL");return!1});$("#submitFeedback").on("click",function(){var e=$("textarea#feedback").val();if(e!==""){var t={key:"qsdljkhqepoi3420$98346adfs34",kind:"[FEEDBACK]",submittedText:e};$.ajax({url:"mailer.php",type:"POST",data:t,success:function(e){$("textarea#feedback").val("");lbApp.interface.modal.message(e)}})}else lbApp.interface.modal.message("Sorry, Feedback message cannot be left empty");return!1})}},searchPage:{init:function(){searchTerm=$("#searchresults").data("term");this.findBlogNames();this.findPostTitles();this.findPostContents()},findBlogNames:function(){$.post("contr_search.php",{term:searchTerm,scope:"blognames"},function(e){$("#blognames").html(e)})},findPostTitles:function(){$("#blogtitles").html('<h3 class ="status">Searching for Blog Posts with the term \''+searchTerm+'\' in their titles</h3><img src="img/interface/ajax-loader.gif" alt="spinning wheel">');$.post("contr_search.php",{term:searchTerm,scope:"blogtitles"},function(e){$("#blogtitles").html(e);if($("#blogtitles").height()>250){$("#blogtitles").height(250);$("#blogtitles").after('<div class ="expand"><a class = "expandTitles" href ="#"><i class ="icon icon-expand-alt"></i> See All Results</a></div>');$(".expandTitles").on("click",function(){$("#blogtitles").height("auto");$(this).hide()})}})},findPostContents:function(){$("#blogcontents").html('<h3 class ="status">Searching for Blog Posts with the term \''+searchTerm+'\' in their text</h3><img src="img/interface/ajax-loader.gif" alt="spinning wheel">');$.post("contr_search.php",{term:searchTerm,scope:"blogcontents"},function(e){$("#blogcontents").html(e);if($("#blogcontents").height()>250){$("#blogcontents").height(250);$("#blogcontents").after('<div class ="expand"><a class = "expandContents" href ="#"><i class ="icon icon-expand-alt"></i> See All Results</a></div>');$(".expandContents").on("click",function(){$("#blogcontents").height("auto");$(this).hide()})}})}}};$(document).ready(function(){lbApp.interface.init();if(global_page==="browse"){lbApp.posts.init();lbApp.posts.flow();lbApp.posts.show();lbApp.interface.viewArea.handleScroll();global_viewtype==="compact"&&lbApp.interface.compactView.init();lbApp.interface.revealContent();lbApp.posts.favorites.init();lbApp.posts.saved.init();$(".endloader").css("opacity",1)}if(global_page==="about"){lbApp.aboutPage.init();lbApp.interface.revealContent()}if(global_page==="blogger"){lbApp.bloggerPage.flow();lbApp.bloggerPage.show();lbApp.interface.revealContent();lbApp.bloggerPage.loadImages();lbApp.posts.favorites.init();lbApp.posts.saved.init()}if(global_page==="top"){lbApp.interface.cards.flow();lbApp.interface.revealContent()}if(global_page==="search"){lbApp.interface.revealContent();lbApp.searchPage.init()}if(global_page==="favorites"){lbApp.posts.init();lbApp.posts.flow();lbApp.posts.show();lbApp.interface.viewArea.handleScroll();global_viewtype==="compact"&&lbApp.interface.compactView.init();lbApp.interface.revealContent();lbApp.posts.favorites.init();lbApp.posts.saved.init()}if(global_page==="saved"){lbApp.posts.init();lbApp.posts.flow();lbApp.posts.show();lbApp.interface.viewArea.handleScroll();global_viewtype==="compact"&&lbApp.interface.compactView.init();lbApp.interface.revealContent();lbApp.posts.favorites.init();lbApp.posts.saved.init()}});$(window).load(function(){lbApp.interface.showLazyImages()});var do_resize;$(window).resize(function(){clearTimeout(do_resize);do_resize=setTimeout(function(){if(global_page==="browse"){lbApp.interface.setDimensions();lbApp.posts.flow()}global_page==="blogger"&&lbApp.bloggerPage.flow();global_page==="top"&&lbApp.interface.cards.flow();if(global_page==="favorites"||global_page==="saved"){lbApp.interface.setDimensions();lbApp.posts.flow()}},300)});