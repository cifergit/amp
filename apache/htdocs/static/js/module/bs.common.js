$(document).ready(function(){
    //禁止用户复制
    forbidCopy();
    //给页面增加最小高度
    pageMinHeight();
    //给用户计数
    countUserPv();
    //给页面增加最小高度
    function pageMinHeight() {
        var clientWidth = document.body.clientHeight;
        var minHeight = clientWidth - 40 -50;
        $('.main_wrap').css("min-height",minHeight);
    }
    //禁止用户复制
    function forbidCopy() {
        $(document).bind("selectstart", function(){return  false;});
        $(document).keydown(function(event) {
            if ((event.ctrlKey&&event.which==67) || (event.ctrlKey&&event.which==86)) {
                return false;
            }
        });
    }
    //给用户计数
    function countUserPv() {
        if(window.localStorage){
            var count = 1;
            if(window.localStorage.getItem("boatsky_user_pv")){
                count = parseInt(window.localStorage.getItem("boatsky_user_pv"));
                count++;
            }
            try {
                window.localStorage.setItem("boatsky_user_pv",count);
            }catch(e) {
                window.localStorage.boatsky_user_pv = count;
            }

            $("#userPv").removeClass("hide").html("这是你第"+count+"次来喔");
        }
    }
});