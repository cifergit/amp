/**
 * desc: login js
 * User: cifer
 * Date: 2016/6/10
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

        //昵称
        var Username = function(domObj, valiItem, retObj) {
            var caption = valiItem.caption,
                v = domObj.value;
            var username = /^[0-9a-zA-Z\u4E00-\u9FA5]{2,13}$/;
            var email = /^[a-zA-Z0-9]+((\.|-|_|\+)?[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(-[a-zA-Z0-9])*(\.[a-zA-Z]+){1,3}$/;
            if (!(username.test(v) || email.test(v))) {
                retObj.code = -1;
                retObj.msg = caption + '请输入2-13个中文字母数字，中文限7个';
            }
            return retObj;
        };

        var usernameRelues = {
            name: "username",
            rule: Username
        };

        vali.addRules(usernameRelues);


        vali.bind({
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
        });

        //点击注册
        $("#J_LoginBtn").on("click",function(){
            submitForm();
        });
    }

    //提交表单
    function submitForm(){
        if(!vali.batchVali()){
            return false;
        }
        var name = document.getElementById("J_Name").value;
        var password = document.getElementById("J_Password").value;
        var reqData = {
            name : name,
            password : password
        };
        var reqUrl = '/login/login';
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
                        errmsg : '恭喜您，登录成功!',
                        leftButtionCallback : function(){
                            location.href = '/';
                        },
                        buttionLeftValue : '返回首页',
                        rightButtionCallback : function(){
                            location.href = '/user';
                        },
                        buttionRightValue : '个人中心'
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


