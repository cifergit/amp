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
        validator: 'js/component/validator',
        windowalert: 'js/component/windowalert'
    }
});


requirejs(['jquery','global','validator','windowalert'], function ($,global,validator,windowalert) {
    global.init();
    console.log("login");

    //验证初始化
    var vali = validator.init({msgTemplate: '{#msg#}'});

    init();

    function init(){
        $('#J_ShowAlert').on('click',function(){
            $('#J_BookmarkCover').removeClass('hide');
            $('#J_BookmarkAlert').removeClass('hide');
        });

        /*vali.bind({
            domId: 'J_Name',
            eventType: 'blur',
            msgId: 'J_NameMsg',
            valiType: 'require,username',
            caption: ''
        });

        vali.bind({
            domId: 'J_Password',
            eventType: 'blur',
            msgId: 'J_PasswordMsg',
            valiType: 'require,passwd',
            caption: '密码'
        });*/

        //点击注册
        $("#J_SaveBookmark").on("click",function(){
            submitForm();
        });
    }

    //提交表单
    function submitForm(){
        /*if(!vali.batchVali()){
            return false;
        }*/
        var name = document.getElementById("J_Name").value;
        var link = document.getElementById("J_Link").value;
        var desc = document.getElementById("J_Desc").value;
        var reqData = {
            name : name,
            link : link,
            desc : desc
        };
        var reqUrl = '/my/bookmark/save_bookmark';
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
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
            success : function (response){
                if(response.errcode === 0){
                    windowalert.simple({
                        errmsg : '恭喜您，保存成功!',
                        leftButtionCallback : function(){
                            location.href = '/';
                        },
                        buttionLeftValue : '返回首页',
                        rightButtionCallback : function(){
                            location.href = '/my/bookmark';
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
    }
});
