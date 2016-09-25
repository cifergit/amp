/**
 * Created by cifer on 2016/5/18.
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
    console.log("register");

    var emailBool = false;
    var nameBool = false;
    var inviteCodeBool = false;

    //验证初始化
    var vali = validator.init({msgTemplate: '{#msg#}'});

    init();

    function init(){

        //昵称
        var Username = function(domObj, valiItem, retObj) {
            var caption = valiItem.caption,
                v = domObj.value;
            var username = /^[0-9a-zA-Z\u4E00-\u9FA5]{2,13}$/;
            if (!username.test(v)) {
                retObj.code = -1;
                retObj.msg = caption + '请输入2-13个中文字母数字，中文限7个以内';
            }
            return retObj;
        };

        var InviteCode = function(domObj, valiItem, retObj) {
            var caption = valiItem.caption,
                v = domObj.value;
            var inviteCode = /[0-9a-z]{10}$/;
            if (!inviteCode.test(v)) {
                retObj.code = -1;
                retObj.msg = caption + '错误';
            }
            return retObj;
        };

        var usernameRelues = {
            name: "username",
            rule: Username
        };

        var inviteCodeRelues = {
            name: "inviteCode",
            rule: InviteCode
        };
        vali.addRules(usernameRelues);
        vali.addRules(inviteCodeRelues);

        vali.bind({
            domId: 'J_Email',
            eventType: 'blur',
            msgId: 'J_EmailMsg',
            valiType: 'require,email',
            caption: '邮箱'
        });

        vali.bind({
            domId: 'J_Name',
            eventType: 'blur',
            msgId: 'J_NameMsg',
            valiType: 'require,username',
            caption: ''
        });

        vali.bind({
            domId: 'J_InviteCode',
            eventType: 'blur',
            msgId: 'J_InviteCodeMsg',
            valiType: 'require,inviteCode',
            caption: '邀请码'
        });

        vali.bind({
            domId: 'J_Password',
            eventType: 'blur',
            msgId: 'J_PasswordMsg',
            valiType: 'require,passwd',
            caption: '密码'
        });

        vali.bind({
            domId: 'J_PasswordConfirm',
            eventType: 'blur',
            msgId: 'J_PasswordConfirmMsg',
            valiType: 'require,passwd',
            caption: '确认密码'
        });

        //判断邮箱唯一性
        $('#J_Email').on('blur',function(){
            var email = document.getElementById("J_Email").value;
            if(vali.doVali('J_Email')){
                checkEmail(email);
            }
        });

        //判断邮箱唯一性
        $('#J_Name').on('blur',function(){
            var name = document.getElementById("J_Name").value;
            if(vali.doVali('J_Name')){
                checkName(name);
            }
        });

        //点击注册
        $("#J_RegisterBtn").on("click",function(){
            submitClick();
        });
    }

    //提交注册
    function submitClick(){
        if(!vali.batchVali()){
            return false;
        }
        var email = document.getElementById("J_Email").value;
        var name = document.getElementById("J_Name").value;
        var invite_code = document.getElementById("J_InviteCode").value;
        var password = document.getElementById("J_Password").value;
        var password_confirm = document.getElementById("J_PasswordConfirm").value;
        if(password !== password_confirm){
            windowalert.simple({
                errmsg : '两次密码输入不一致！',
                leftButtionCallback : function(){
                    location.href = '/';
                },
                buttionLeftValue : '返回首页',
                rightButtionCallback : function(){
                    document.getElementById("J_Password").value = "";
                    document.getElementById("J_PasswordConfirm").value = "";
                    windowalert.hideWindowalert();
                },
                buttionRightValue : '返回修改'
            });
            return;
        }
        //覆盖格式验证
        checkEmail(email);
        checkName(name);
        checkInviteCode(invite_code);
    }

    function submitForm(){
        var email = document.getElementById("J_Email").value;
        var name = document.getElementById("J_Name").value;
        var invite_code = document.getElementById("J_InviteCode").value;
        var password = document.getElementById("J_Password").value;
        var password_confirm = document.getElementById("J_PasswordConfirm").value;
        var reqData = {
            email : email,
            name : name,
            invite_code : invite_code,
            password : password,
            password_confirm : password_confirm
        };
        var reqUrl = '/register/add_user';
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
                windowalert.simple({
                    msg : '抱歉，服务器繁忙，请稍候再试！'
                });
            },
            success : function (response){
                if(response.errcode === 0){
                    windowalert.simple({
                        msg : '恭喜您，注册成功!'
                    });
                }
                else {
                    windowalert.simple({
                        msg : response.errmsg
                    });
                }

            }
        });
    }

    //判断邮箱唯一,true唯一，false不唯一
    function checkEmail(email){
        var reqUrl = '/register/check_email';
        var reqData = {
            email : email
        };
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
                emailBool = false;
                windowalert.simple({
                    msg : '抱歉，服务器繁忙，请稍候再试！'
                });
            },
            success : function (response){
                if(response.errcode === 0){
                    emailBool = true;
                    $('#J_EmailMsg').html('');
                }
                else {
                    emailBool = false;
                    $('#J_EmailMsg').show().html(response.errmsg);
                }
            }
        });
    }

    //判断邮箱唯一,true唯一，false不唯一
    function checkName(name){
        var reqUrl = '/register/check_name';
        var reqData = {
            name : name
        };
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
                nameBool = false;
                windowalert.simple({
                    msg : '抱歉，服务器繁忙，请稍候再试！'
                });
            },
            success : function (response){
                if(response.errcode === 0){
                    nameBool = true;
                    $('#J_NameMsg').html('');
                }
                else {
                    nameBool = false;
                    $('#J_NameMsg').show().html(response.errmsg);
                }
            }
        });
    }

    //判断邀请码是否存在且是否未被使用,0可用
    function checkInviteCode(inviteCode){
        var reqUrl = '/register/check_invite_code';
        var reqData = {
            invite_code : inviteCode
        };
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
                inviteCodeBool = false;
                windowalert.simple({
                    msg : '抱歉，服务器繁忙，请稍候再试！'
                });
            },
            success : function (response){
                if(response.errcode === 0){
                    inviteCodeBool = true;
                    if(emailBool && nameBool && inviteCodeBool){
                        submitForm();
                    }
                }
                else {
                    inviteCodeBool = false;
                    windowalert.simple({
                        msg : response.errmsg
                    });
                }
            }
        });
    }
});

