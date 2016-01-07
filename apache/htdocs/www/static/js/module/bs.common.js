$(document).ready(function(){
    //禁止用户复制
    //forbidCopy();
    //给页面增加最小高度
    pageMinHeight();
    //给用户计数
    countUserPv();
    //头部cur
    initHeadNavCur();
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

    //初始化头部链接cur态,默认是美的商城
    function initHeadNavCur() {
        var thisUrl = location.href;
        var hrefArray = [];
        //作者感言
        var author = ["/author"];
        hrefArray.push(author);
        //更新记录
        var history = ["/history"];
        hrefArray.push(history);
        //管理
        var manage = ["/admin"];
        hrefArray.push(manage);
        var flag = false;//默认没找到，往下找
        for (var i = 0; i < hrefArray.length; i++) {
            if (flag) {
                break;
            }
            var jLength = hrefArray[i].length;
            for (var j = 0; j < jLength; j++) {
                if (thisUrl.indexOf(hrefArray[i][j]) > -1) {
                    if (i == 0) {
                        addItemOn("感言");
                        flag = true;
                        break;
                    }
                    else if (i == 1) {
                        addItemOn("记录");
                        flag = true;
                        break;
                    }
                    else if(i == 2){
                        addItemOn("推荐");
                        flag = true;
                        break;
                    }
                }
            }
        }
        if (!flag) {
            addItemOn("电影");
        }
    }

    function addItemOn(str) {
        var navList = $('#topNavWrap li');
        var navListLength = navList.length;
        for (var n = 0; n < navListLength; n++) {
            if ($.trim(navList.eq(n).find("a").html()) == str) {
                navList.eq(n).addClass('item_on');
                break;
            }
        }
    }
});