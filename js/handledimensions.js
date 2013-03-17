console.log(viewtype);
$(document).ready(function () {
    content_size();
    console.log("Vertical Offset"+ verticalOffset());
    $('#main-container').waitForImages(function () {
        $('#main-container').BlocksIt({
            numOfCol: how_many_columns(),
            offsetX: 10,
            offsetY: verticalOffset(),
            blockElement: '.blogentry'
        });

        //fade out the "loading" element
        $('#loadingnew').fadeTo('fast', 0, function () {});
        $('#loadingnew').css("display","none");
        $('#loadingnew').css("padding",0);

        //fade in the blogs and the preferences cog
        $('.blogentry').fadeTo('slow', 1, function () {});
        $('.prefopen img').fadeTo('slow', 1, function () {});
    });

    $(".prefopen").click(function () {
        $("#prefpanel").slideToggle("fast");
    });

    $(".switchview").click(function(){
        switchView();
    });

    $(window).resize(function () {
        content_size();
        $('#main-container').waitForImages(function () {
            $('#main-container').BlocksIt({
                numOfCol: how_many_columns(),
                offsetX: 10,
                offsetY: verticalOffset(),
                blockElement: '.blogentry'
            });
        });
    });
    $("#switchToGridView").css('cursor', 'pointer');
    $("#switchToListView").css('cursor', 'pointer');
    $("#switchToGridView").click(function(){
        viewtype = "list";
        $("#switchToGridView").css("display","none");
        $("#switchToListView").css("display","block");
        switchView();
    });
    $("#switchToListView").click(function(){
        viewtype = "grid";
        $("#switchToGridView").css("display","block");
        $("#switchToListView").css("display","none");
        switchView();
    });


    var position = 16;
    var workInProgress = "no";
    $(window).scroll(function () {
        var wh = $(window).height();
        var dh = $(document).height();
        var s = $(document).scrollTop();
        status = "Window Height: " + wh + " Document Height: " + dh + " Scroll Top: " + s;
        console.log(status);
        console.log(workInProgress);
        console.log(position);

        if (s >= (dh - wh - 600)) { // when we're almost at the bottom of the document
            if (workInProgress == "no") { // used to prevent overlapping background loading
                console.log('initiated work');
                workInProgress = "yes";
                var url = "addmore.php";
                $.post(url, {
                    start_from: position
                }, function (data) {
                    $("#main-container").append(data);
                    if (viewtype == "list") {
                        $(".dash_thumbnail").css("display", "none");
                        $(".sharing_tools").css("display", "none");
                        $(".blog_thumb img").css("width", 32);
                        $("div.blog_info").css("width", 'inherit');
                        $("div.thumb_and_title").css("margin-bottom", 0);
                    } else {
                        $(".dash_thumbnail").css("display", "block");
                        $(".sharing_tools").css("display", "block");
                        $(".blog_thumb img").css("width", 50);
                        $("div.blog_info").css("width", 220);
                        $("div.thumb_and_title").css("margin-bottom", 10);

                    }
                    $('#main-container').waitForImages(function () {
                        $('#main-container').BlocksIt({
                            numOfCol: how_many_columns(),
                            offsetX: 10,
                            offsetY: verticalOffset(),
                            blockElement: '.blogentry'
                        });

                        $('.blogentry').fadeTo('fast', 1, function () {});
                        position = position + 20;
                        workInProgress = "no";
                        $(document).scrollTop() = s;

                    });
                });
            }
        }
    });

    function content_size() {
        var x = $(window).width();
        var margins = x % 320;
        var desiredwidth = x - margins;
        if (x != desiredwidth) {
            $("#wrapper").css("width", desiredwidth);
        }
    }

    function verticalOffset(){
        if (viewtype == "grid") {
            return 10;
        } else {
            return 2;
        }
    }

    function switchView() {
        if (viewtype == "grid") {
            viewtype = "list";
            $(".dash_thumbnail").css("display", "none");
            $(".sharing_tools").css("display", "none");
            $(".blog_thumb img").css("width", 32);
            $("div.blog_info").css("width", 'inherit');
            $("div.thumb_and_title").css("margin-bottom", 0);

        } else {
            viewtype = "grid";
            $(".dash_thumbnail").css("display", "block");
            $(".sharing_tools").css("display", "block");
            $(".blog_thumb img").css("width", 50);
            $("div.blog_info").css("width", 220);
            $("div.thumb_and_title").css("margin-bottom", 10);
        }
        content_size();
        $('#main-container').waitForImages(function () {
            $('#main-container').BlocksIt({
                numOfCol: how_many_columns(),
                offsetX: 10,
                offsetY: verticalOffset(),
                blockElement: '.blogentry'
            });
        });;
    }

    function how_many_columns() {
        if (viewtype == "grid") {
            var x = $(window).width();
            var margins = x % 320;
            var desiredwidth = x - margins;
            var columns = desiredwidth / 320;
            return columns;
        } else {
            return 1;
        }

    }

});