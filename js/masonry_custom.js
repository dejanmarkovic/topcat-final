/**
 * Created by LPAC006013 on 06/12/14.
 */
var phoneSize = 480;
jQuery(document).ready(function($) {

    var $container = $('#sidebar-footer');
    if($(document).width() >= phoneSize) {
        $container.masonry({
            columnWidth: '.widget',
            isFitWidth: true,
            isAnimated: true,
            itemSelector: '.widget'
        });
    }
    $(window).resize(function() {
        if($(document).width() >= phoneSize) {
            $container.masonry({
                columnWidth: '.widget',
                isFitWidth: true,
                isAnimated: true,
                itemSelector: '.widget'
            });

        }
        // < phoneSize disable masonry
        else if($(document).width() < phoneSize) {
            $container.masonry({
                columnWidth: '.widget',
                isFitWidth: true,
                isAnimated: true,
                itemSelector: '.widget'
            });
            $container.masonry('destroy');
        }
    });
});

