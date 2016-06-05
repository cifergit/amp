/**
 * Created by cifer on 2016/05/10.
 */
define('mod_product',function(require,exports,module){
    var $ = require('jquery');
    function hoverSubNav(){
        var hoverDelay = 500;
        var itemHoverTimer;
        $(".js_product_li").hover(function() {
            $(".sub_nav_wrap").removeClass("hide");
            clearTimeout(itemHoverTimer);
        }, function() {
            var that = this;
            itemHoverTimer = setTimeout(function() {
                $(".sub_nav_wrap").addClass("hide");
            }, hoverDelay);
        });
        $('.sub_nav_wrap').hover(function() {
            clearTimeout(itemHoverTimer);
        }, function() {
            itemHoverTimer = setTimeout(function() {
                $(".sub_nav_wrap").addClass("hide");
            }, hoverDelay);
        });
    }

    /*function changeTab(){

        if(window.location.href.indexOf('service') > -1 || window.location.href.indexOf('finance') > -1){
            $('.financial_li').addClass('cur').siblings("li").removeClass("cur");
        }
        else {
            $('.product_li').addClass('cur').siblings("li").removeClass("cur");
        }

        $(".product_financial_li").on("click",function(){
            if(!$(this).hasClass("cur")){
                $(this).addClass("cur").siblings("li").removeClass("cur");
            }
        });
    }*/

    exports.init = function() {
        hoverSubNav();
    }
});
