
/******************************************************************************/
/* The debouncer function is to throttle the events of resizing and scrolling */
/******************************************************************************/

var deBouncer = function($,cf,of, interval){
    // deBouncer by hnldesign.nl
    // based on code by Paul Irish and the original debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        var timeout;
        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            }
            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);
            timeout = setTimeout(delayed, threshold || interval);
        };
    };
    jQuery.fn[cf] = function(fn){  return fn ? this.bind(of, debounce(fn)) : this.trigger(cf); };
};

//register debouncing functions
//deBouncer(jQuery,'new eventname', 'original event', timeout);
//Note: keep the jQuery namespace in mind, don't overwrite existing functions!

deBouncer(jQuery,'smartresize', 'resize', 100);
deBouncer(jQuery,'smartscroll', 'scroll', 100);


/****************************************/
/* Lazy loading plugin                  */
/****************************************/


/*
 * Lazy Load - jQuery plugin for lazy loading images
 *
 * Copyright (c) 2007-2013 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 *
 * Version:  1.9.3
 *
 */

(function($, window, document, undefined) {
    var $window = $(window);

    $.fn.lazyload = function(options) {
        var elements = this;
        var $container;
        var settings = {
            threshold       : 0,
            failure_limit   : 0,
            event           : "scroll",
            effect          : "show",
            container       : window,
            data_attribute  : "original",
            skip_invisible  : true,
            appear          : null,
            load            : null,
            placeholder     : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
        };

        function update() {
            var counter = 0;

            elements.each(function() {
                var $this = $(this);
                if (settings.skip_invisible && !$this.is(":visible")) {
                    return;
                }
                if ($.abovethetop(this, settings) ||
                    $.leftofbegin(this, settings)) {
                        /* Nothing. */
                } else if (!$.belowthefold(this, settings) &&
                    !$.rightoffold(this, settings)) {
                        $this.trigger("appear");
                        /* if we found an image we'll load, reset the counter */
                        counter = 0;
                } else {
                    if (++counter > settings.failure_limit) {
                        return false;
                    }
                }
            });

        }

        if(options) {
            /* Maintain BC for a couple of versions. */
            if (undefined !== options.failurelimit) {
                options.failure_limit = options.failurelimit;
                delete options.failurelimit;
            }
            if (undefined !== options.effectspeed) {
                options.effect_speed = options.effectspeed;
                delete options.effectspeed;
            }

            $.extend(settings, options);
        }

        /* Cache container as jQuery as object. */
        $container = (settings.container === undefined ||
                      settings.container === window) ? $window : $(settings.container);

        /* Fire one scroll event per scroll. Not one scroll event per image. */
        if (0 === settings.event.indexOf("scroll")) {
            $container.bind(settings.event, function() {
                return update();
            });
        }

        this.each(function() {
            var self = this;
            var $self = $(self);

            self.loaded = false;

            /* If no src attribute given use data:uri. */
            if ($self.attr("src") === undefined || $self.attr("src") === false) {
                if ($self.is("img")) {
                    $self.attr("src", settings.placeholder);
                }
            }

            /* When appear is triggered load original image. */
            $self.one("appear", function() {
                if (!this.loaded) {
                    if (settings.appear) {
                        var elements_left = elements.length;
                        settings.appear.call(self, elements_left, settings);
                    }
                    $("<img />")
                        .bind("load", function() {

                            var original = $self.attr("data-" + settings.data_attribute);
                            $self.hide();
                            if ($self.is("img")) {
                                $self.attr("src", original);
                            } else {
                                $self.css("background-image", "url('" + original + "')");
                            }
                            $self[settings.effect](settings.effect_speed);

                            self.loaded = true;

                            /* Remove image from array so it is not looped next time. */
                            var temp = $.grep(elements, function(element) {
                                return !element.loaded;
                            });
                            elements = $(temp);

                            if (settings.load) {
                                var elements_left = elements.length;
                                settings.load.call(self, elements_left, settings);
                            }
                        })
                        .attr("src", $self.attr("data-" + settings.data_attribute));
                }
            });

            /* When wanted event is triggered load original image */
            /* by triggering appear.                              */
            if (0 !== settings.event.indexOf("scroll")) {
                $self.bind(settings.event, function() {
                    if (!self.loaded) {
                        $self.trigger("appear");
                    }
                });
            }
        });

        /* Check if something appears when window is resized. */
        $window.bind("resize", function() {
            update();
        });

        /* With IOS5 force loading images when navigating with back button. */
        /* Non optimal workaround. */
        if ((/(?:iphone|ipod|ipad).*os 5/gi).test(navigator.appVersion)) {
            $window.bind("pageshow", function(event) {
                if (event.originalEvent && event.originalEvent.persisted) {
                    elements.each(function() {
                        $(this).trigger("appear");
                    });
                }
            });
        }

        /* Force initial check if images should appear. */
        $(document).ready(function() {
            update();
        });

        return this;
    };

    /* Convenience methods in jQuery namespace.           */
    /* Use as  $.belowthefold(element, {threshold : 100, container : window}) */

    $.belowthefold = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = (window.innerHeight ? window.innerHeight : $window.height()) + $window.scrollTop();
        } else {
            fold = $(settings.container).offset().top + $(settings.container).height();
        }

        return fold <= $(element).offset().top - settings.threshold;
    };

    $.rightoffold = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = $window.width() + $window.scrollLeft();
        } else {
            fold = $(settings.container).offset().left + $(settings.container).width();
        }

        return fold <= $(element).offset().left - settings.threshold;
    };

    $.abovethetop = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = $window.scrollTop();
        } else {
            fold = $(settings.container).offset().top;
        }

        return fold >= $(element).offset().top + settings.threshold  + $(element).height();
    };

    $.leftofbegin = function(element, settings) {
        var fold;

        if (settings.container === undefined || settings.container === window) {
            fold = $window.scrollLeft();
        } else {
            fold = $(settings.container).offset().left;
        }

        return fold >= $(element).offset().left + settings.threshold + $(element).width();
    };

    $.inviewport = function(element, settings) {
         return !$.rightoffold(element, settings) && !$.leftofbegin(element, settings) &&
                !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
     };

    /* Custom selectors for your convenience.   */
    /* Use as $("img:below-the-fold").something() or */
    /* $("img").filter(":below-the-fold").something() which is faster */

    $.extend($.expr[":"], {
        "below-the-fold" : function(a) { return $.belowthefold(a, {threshold : 0}); },
        "above-the-top"  : function(a) { return !$.belowthefold(a, {threshold : 0}); },
        "right-of-screen": function(a) { return $.rightoffold(a, {threshold : 0}); },
        "left-of-screen" : function(a) { return !$.rightoffold(a, {threshold : 0}); },
        "in-viewport"    : function(a) { return $.inviewport(a, {threshold : 0}); },
        /* Maintain BC for couple of versions. */
        "above-the-fold" : function(a) { return !$.belowthefold(a, {threshold : 0}); },
        "right-of-fold"  : function(a) { return $.rightoffold(a, {threshold : 0}); },
        "left-of-fold"   : function(a) { return !$.rightoffold(a, {threshold : 0}); }
    });

})(jQuery, window, document);




/********************************************************/
/* The BlocksIt function is to tile posts like pinterest*/
/********************************************************/

(function($) {

    //BlocksIt default options
    var blocksOptions = {
        numOfCol: 5,
        offsetX: 5,
        offsetY: 5,
        blockElement: 'div'
    };
    
    //dynamic variable
    var container, colwidth;
    var blockarr = [];
    
    //ie indexOf fix
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function(elt /*, from*/) {
            var len = this.length >>> 0;

            var from = Number(arguments[1]) || 0;
            from = (from < 0) ? Math.ceil(from) : Math.floor(from);
            if (from < 0)
                from += len;

                for (; from < len; from++) {
                    if (from in this &&
                    this[from] === elt)
                    return from;
                }
            return -1;
        };
    }
    
    //create empty blockarr
    var createEmptyBlockarr = function() {
        //empty blockarr
        blockarr = [];
        for(var i=0; i<blocksOptions.numOfCol; i++) {
            blockarrPush('empty-'+i, i, 0, 1, -blocksOptions.offsetY);
        }
    };
    
    //add new block to blockarr
    var blockarrPush = function(id, x, y, width, height) {
        //define block object based on block width
        for(var i=0; i<width; i++) {
            var block = {};
            block.x = x + i;
            block.size = width;
            block.endY = y + height + blocksOptions.offsetY*2;
            
            blockarr.push(block);
        }
    };
    
    //remove block from blockarr
    var blockarrRemove = function(x, num) {
        for(var i=0; i<num; i++) {
            //remove block beside
            var index = getBlockIndex(x+i, 'x');
            blockarr.splice(index, 1);
        }
    };
    
    //retrieve block index based on block's x position
    var getBlockIndex = function(value, type) {
        
        for(var i=0; i<blockarr.length; i++) {
            var obj = blockarr[i];
            if(type == "x" && obj.x == value) {
                return i;
            } else if(type == "endY" && obj.endY == value) {
                return i;
            }
        }
    };

    //get height from blockarr range based on block.x and size
    //retrun min and max height
    var getHeightArr = function(x, size) {
        var temparr = [];
        for(var i=0; i<size; i++) {
            temparr.push(blockarr[getBlockIndex(x+i, 'x')].endY);
        }
        var min = Math.min.apply(Math, temparr);
        var max = Math.max.apply(Math, temparr);
        
        return [min, max, temparr.indexOf(min)];
    };
    
    //get block x and y position
    var getBlockPostion = function(size) {
        
        //if block width is not default 1
        //extra algorithm check
        if(size > 1) {
            //prevent extra loop
            var arrlimit = blockarr.length - size;
            //define temp variable
            var defined = false;
            var tempHeight, tempIndex;
            
            for(var i=0; i<blockarr.length; i++) {
                var obj = blockarr[i];
                var x = obj.x;

                //check for block within range only
                if(x >= 0 && x <= arrlimit) {
                    var heightarr = getHeightArr(x, size);
                    
                    //get shortest group blocks
                    if(!defined) {
                        defined = true;
                        tempHeight = heightarr;
                        tempIndex = x;
                    } else {
                        if(heightarr[1] < tempHeight[1]) {
                            tempHeight = heightarr;
                            tempIndex = x;
                        }
                    }
                }
            }
            return [tempIndex, tempHeight[1]];
        } else { //simple check for block with width 1
            tempHeight = getHeightArr(0, blockarr.length);
            return [tempHeight[2], tempHeight[0]];
        }   
    }
    
    //set block position
    var setPosition = function(obj, index) {
        //check block size
        if(!obj.data('size') || obj.data('size') < 0) {
            obj.data('size', 1);
        } else if(obj.data('size') > blocksOptions.numOfCol) {
            obj.data('size', blocksOptions.numOfCol);
        }
        
        //define block data
        var pos = getBlockPostion(obj.data('size'));
        var blockWidth = colwidth * obj.data('size') - (obj.outerWidth() - obj.width());

        //update style first before get object height
        obj.css({
            'width': blockWidth - blocksOptions.offsetX*2,
            'left': pos[0] * colwidth,
            'top': pos[1],
            'position': 'absolute'
        });
        
        var blockHeight = obj.outerHeight();
        
        //modify blockarr for new block
        blockarrRemove(pos[0], obj.data('size'));
        blockarrPush(obj.attr('id'), pos[0], pos[1], obj.data('size'), blockHeight);
    };
    
    $.fn.BlocksIt = function(options) {
        //BlocksIt options
        if (options && typeof options === 'object') {
            $.extend(blocksOptions, options);
        }
        
        container = $(this);
        colwidth = container.width() / blocksOptions.numOfCol;

        //create empty blockarr
        createEmptyBlockarr();

        container.children(blocksOptions.blockElement).each(function(e) {
            setPosition($(this), e);
        });
        
        //set final height of container
        var heightarr = getHeightArr(0, blockarr.length);
        container.height(heightarr[1] + blocksOptions.offsetY);
        
        return this;
    };

})(jQuery);
