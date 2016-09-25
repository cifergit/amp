define(function(require,exports,module){

    //var $ = require("jquery");
    function initNav(){
        var thisHref = location.href;
        console.log(thisHref);
        if(thisHref.indexOf("www.boatsky.com/blog") > -1){
            console.log(1);
            $(".top_nav_li_blog").addClass("cur");
        }
        else if(thisHref.indexOf("www.boatsky.com/movie") > -1){
            console.log(2);
            $(".top_nav_li_movie").addClass("cur");
        }
        else if(thisHref.indexOf("www.boatsky.com/bookmark") > -1){
            console.log(2);
            $(".top_nav_li_bookmark").addClass("cur");
        }
        else if(thisHref.indexOf("boatsky.com/register") > -1 || thisHref.indexOf("boatsky.com/login") > -1 || thisHref.indexOf("boatsky.com/user") > -1){
            $(".top_nav_li_user").addClass("cur");
        }
        else {
            console.log(3);
            $(".top_nav_li_home").addClass("cur");
        }
    }

    function pageMinHeight() {
        var clientWidth = document.documentElement.clientHeight || document.body.clientHeight;
        var minHeight = clientWidth - 40 -50 - 40;
        $('.main_wrap').css("min-height",minHeight);
    }

    exports.init = function() {
        initNav();
        pageMinHeight();
        console.log("global work");
    }
});
