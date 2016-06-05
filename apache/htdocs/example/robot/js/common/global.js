/**
 * @desc 全局公共
 * @author cifer
 * @date 2016-05-05
 */
define('global',function(require,exports,module){
    var $ = require('jquery');
    var login = require("robot/js/common/login");
    //login.init();
    //var $ = require("jquery");
    function initNav(){
        var thisHref = location.href;
        if(thisHref.indexOf('/about/ingdan') > -1){
            $('.js_header_li').removeClass('cur');
            $('.js_header_li_us').addClass('cur');
        }
        else if(thisHref.indexOf('/onestop') > -1){
            $('.js_header_li').removeClass('cur');
            $('.js_header_li_onestop').addClass('cur');
        }
        else if(thisHref.indexOf('/product') > -1 || thisHref.indexOf('/service') > -1){
            $('.js_header_li').removeClass('cur');
            $('.js_header_li_product').addClass('cur');
        }
        else if(thisHref.indexOf('/news') > -1){
            $('.js_header_li').removeClass('cur');
            $('.js_header_li_news').addClass('cur');
        }
    }

    function pageMinHeight() {
        var clientWidth = document.documentElement.clientHeight || document.body.clientHeight;
        var minHeight = clientWidth - 197 -100;
        $('.main_wrap').css("min-height",minHeight);
    }

    //用户hover
    function hoverUserWrap(){
        var hoverDelay = 500;
        var itemHoverTimer;
        $("#headerUserPortrait").hover(function() {
            $("#headerUserWrap").addClass("header_user_wrap_hover");
            clearTimeout(itemHoverTimer);
        }, function() {
            var that = this;
            itemHoverTimer = setTimeout(function() {
                $("#headerUserWrap").removeClass("header_user_wrap_hover");
            }, hoverDelay);
        });
        $('#headerAccountNav').hover(function() {
            clearTimeout(itemHoverTimer);
        }, function() {
            itemHoverTimer = setTimeout(function() {
                $("#headerUserWrap").removeClass("header_user_wrap_hover");
            }, hoverDelay);
        });
    }

    exports.init = function() {
        initNav();
        pageMinHeight();
        hoverUserWrap();
    }
});

