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
            domId: 'companyName',
            eventType: 'blur',
            msgId: 'companyNameErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 40,
            caption: '公司名'
        });

        vali.bind({
            domId: 'position',
            eventType: 'blur',
            msgId: 'positionErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 40,
            caption: '职位'
        });

        vali.bind({
            domId: 'companyAddress',
            eventType: 'blur',
            msgId: 'companyAddressErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 80,
            caption: '地址'
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

        var companyName = $.trim(document.getElementById("companyName").value);
        var position = $.trim(document.getElementById("position").value);
        var companyAddress = $.trim(document.getElementById("companyAddress").value);


        var reqData = {
            company : companyName,
            position : position,
            company_address : companyAddress
        };
        var reqUrl = '/people/change_baseinfo';
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
        });
    }

});

