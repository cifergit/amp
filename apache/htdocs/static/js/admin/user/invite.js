/**
 * Created by cifer on 2016/6/10.
 */
require.config({
    baseUrl: SERVER_ROOT,
    paths: {
        jquery: 'static/module/jquery/jquery',
        windowalert: 'static/js/component/windowalert',
        global: 'static/js/common/global'
    }
});

requirejs(['jquery','global','windowalert'], function ($,global,windowalert) {
    global.init();
    console.log("invite");
    init();

    function init(){
        $('#J_NewInviteCode').on("click",function(){
            $.ajax({
                type : "POST",
                url : SERVER_ROOT + "/admin/user/invite/add_invite",
                dataType: "json",
                error : function (response){
                    windowalert.simple({
                        errmsg : '抱歉，服务器繁忙，请稍候再试！',
                        leftButtionCallback : function(){
                            location.href = '/';
                        },
                        buttionLeftValue : '返回首页',
                        rightButtionCallback : function(){
                            windowalert.hideWindowalert();
                        },
                        buttionRightValue : '返回修改'
                    });
                },
                success : function(response){
                    if(response.errcode === 0){
                        windowalert.simple({
                            errmsg : '生成成功!',
                            leftButtionCallback : function(){
                                location.href = '/';
                            },
                            buttionLeftValue : '返回首页',
                            rightButtionCallback : function(){
                                location.reload();
                            },
                            buttionRightValue : '查看'
                        });
                    }
                    else {
                        windowalert.simple({
                            errmsg : response.errmsg,
                            leftButtionCallback : function(){
                                location.href = '/';
                            },
                            buttionLeftValue : '返回首页',
                            rightButtionCallback : function(){
                                windowalert.hideWindowalert();
                            },
                            buttionRightValue : '返回修改'
                        });
                    }
                }
            });
        });
    }
});