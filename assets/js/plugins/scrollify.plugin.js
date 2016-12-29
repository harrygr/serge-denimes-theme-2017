/**
 * A simple plugin to horizontally loop an image from right to left.
 * Example usage:
 * 
 * HTML: <div class="myContainer"><img src="//example.com/image.jpg" /></div>
 * JS: $('.myContainer').scrollify();
 * 
 * @author: harryg <harry@harryg.me>
 */

$(function () {
    $.fn.scrollify = function (options) {

        var $image1 = this.children('img:first-child');

        // copy the image element and re-class it
        $image1.css({
            position: 'absolute'
        })
            .clone()
            .appendTo(this)
            .removeClass('img1')
            .addClass('img2');
        var $image2 = this.children('.img2');

        var width = $image1.width();

        this.css({
            height: $image1.height(),
            position: 'relative',
            overflow: 'hidden'
        });

        animateWidth($image1, $image2, width, options);
    };

    function animateWidth($elem1, $elem2, width, options) {

        var settings = $.extend({
            easingFunction: "linear",
            loopTime: 5000
        }, options);

        $elem1.css({
            left: 0
        })
            .animate({
            left: -width
        }, {
            duration: settings.loopTime,
            queue: false,
            easing: settings.easingFunction
        });

        $elem2.css({
            left: width
        })
            .animate({
            left: 0
        }, {
            duration: settings.loopTime,
            queue: false,
            easing: settings.easingFunction,
            complete: function () {
                animateWidth($elem2, $elem1, width, settings);
            }
        });
    }
});