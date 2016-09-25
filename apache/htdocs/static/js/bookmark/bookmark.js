/**
 * desc: bookmark js
 * User: cifer
 * Date: 2016/7/15
 * Time: 19:01
 */
require.config({
    baseUrl: baseUrl,
    paths: {
        jquery: 'module/jquery/jquery',
        global: 'js/common/global',
        windowalert: 'js/component/windowalert'
    }
});


requirejs(['jquery','global','windowalert'], function ($,global,windowalert) {
    global.init();

    init();

    function init(){
        $('.J_BookmarkA').on('click',function(e){
            var id = $.trim($(this).data('id'));
            $.ajax({
                type : "POST",
                dataType : "json",
                data : {id : id},
                url : '/bookmark/add_bookmark_pv',
                error : function (er){
                    windowalert.simple({
                        msg : '抱歉，服务器繁忙，请稍候再试！'
                    });
                },
                success : function (response){
                    if(response.code == 0){
                    }
                    else {
                        windowalert.simple({
                            msg : response.msg
                        });
                    }
                }
            });
        });
    }
});

