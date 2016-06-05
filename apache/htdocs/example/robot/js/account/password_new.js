/**
 * @desc change password
 * @author cifer
 * @date 2016/5/28
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}

require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global',
        windowalert: 'robot/js/component/windowalert',
        validator: 'robot/js/common//validator'
    }
});


requirejs(['jquery','global','validator','windowalert'], function ($,global,validator,windowalert) {
    global.init();
    var vali = validator.init({msgTemplate: '{#msg#}'});
    init();

    function init(){
        vali.bind({
            domId: 'oldPassword',
            eventType: 'blur',
            msgId: 'oldPasswordErrmsg',
            valiType: 'require,length',
            min: 6,
            max: 20,
            caption: '旧密码'
        });

        vali.bind({
            domId: 'newPassword',
            eventType: 'blur',
            msgId: 'newPasswordErrmsg',
            valiType: 'require,length',
            min: 6,
            max: 20,
            caption: '新密码'
        });

        vali.bind({
            domId: 'confirmPassword',
            eventType: 'blur',
            msgId: 'confirmPasswordErrmsg',
            valiType: 'require,length',
            min: 6,
            max: 20,
            caption: '确认密码'
        });

        $("#submitFormBtn").on("click",function(){
            submitForm();
        });
    }

    //提交注册表单
    function submitForm(){
        if(!vali.batchVali()){
            return false;
        }

        var oldPassword = $.trim(document.getElementById("oldPassword").value);
        var newPassword = $.trim(document.getElementById("newPassword").value);
        var confirmPassword = $.trim(document.getElementById("confirmPassword").value);

        if(oldPassword === newPassword){
            $('#newPasswordErrmsg').show().html('新旧密码不能相同');
            return false;
        }
        else {
            $('#newPasswordErrmsg').hide().html("");
        }

        if(newPassword !== confirmPassword){
            $('#confirmPasswordErrmsg').show().html('两次密码不一致');
            return false;
        }
        else {
            $('#confirmPasswordErrmsg').hide().html("");
        }

        var reqData = {
            old_password : oldPassword,
            new_password : newPassword,
            confirm_password : confirmPassword
        };
        var reqUrl = '/people/change_password';
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
                    buttionLeftValue : '首页',
                    rightButtionCallback : function(){
                        windowalert.hideWindowalert();
                    },
                    buttionRightValue : '返回修改'
                });
            },
            success : function (e){
                if(e.status == 'ok'){
                    windowalert.simple({
                        errmsg : '恭喜您，提交成功!',
                        leftButtionCallback : function(){
                            location.href = '/';
                        },
                        buttionLeftValue : '首页',
                        rightButtionCallback : function(){
                            document.body.scrollTop = 0;
                            location.reload();
                        },
                        buttionRightValue : '继续提交'
                    });
                }
                else {
                    windowalert.simple({
                        errmsg : e.msg,
                        leftButtionCallback : function(){
                            location.href = '/';
                        },
                        buttionLeftValue : '首页',
                        rightButtionCallback : function(){
                            windowalert.hideWindowalert();
                        },
                        buttionRightValue : '返回修改'
                    });
                }
            }
        })
    }

});
