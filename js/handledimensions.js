
        $(document).ready(function(){
            content_size();
            $('#main-container').waitForImages(function() {
                $('#main-container').BlocksIt({
                  numOfCol: how_many_columns(),
                  offsetX: 10,
                  offsetY: 10,
                  blockElement: '.blogentry'
                });

                //fade out the "loading" element
                $('#loader').fadeTo('fast', 0   , function(){}); 
                
                //fade in the blogs and the preferences cog
                $('.blogentry').fadeTo('slow', 1, function(){});       
                $('.prefopen img').fadeTo('slow',1, function(){});           
            });

            $( ".prefopen" ).click(function(){
                $("#prefpanel").slideToggle("fast");
            });

        });

        
        $(window).resize(function(){
            content_size();
            $('#main-container').waitForImages(function() {
                $('#main-container').BlocksIt({
                  numOfCol: how_many_columns(),
                  offsetX: 10,
                  offsetY: 10,
                  blockElement: '.blogentry'
                });
            });
        }); 
        

        function content_size()
            {
            var x = $(window).width();
            var margins= x%320;
            var desiredwidth = x-margins;
            if (x!=desiredwidth) {
            $("#wrapper").css("width",desiredwidth);      
            }};
        
        var how_many_columns = function(){
            var x = $(window).width();
            var margins= x%320;
            var desiredwidth = x-margins;
            var columns = desiredwidth/320;
            return columns;
        }