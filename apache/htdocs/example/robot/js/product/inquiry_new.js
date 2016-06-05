/**
 * @desc 产品询价
 * @author cifer
 * @date 2016-05-12
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global',
        validator: 'robot/js/common//validator',
        url : 'robot/js/common//url',
        windowalert: 'robot/js/component/windowalert',
        formatJson : 'robot/js/common/formatJson'
    }
});

requirejs(['jquery','global','validator','url','formatJson','windowalert'], function ($,global,validator,url,formatJson,windowalert) {
    global.init();
    var vali = validator.init({msgTemplate: '{#msg#}'});
    init();

    function init(){

        //初始化已选择规格
        initDefaultSpec();

        //给validator增加联系人电话的规则
        var telOrPhone = function(domObj, valiItem, retObj) {
            var caption = valiItem.caption,
                v = domObj.value;
            var telReg = /^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/;
            var phoneReg = /^1[0-9]{10}$/;
            if (!phoneReg.test(v) && !telReg.test(v)) {
                retObj.code = -1;
                retObj.msg = caption + '格式不正确，如里是固定电话，区号后加-';
            }
            return retObj;
        };

        var telOrPhoneRelues = {
            name: "telOrPhone",
            rule: telOrPhone
        };
        vali.addRules(telOrPhoneRelues);

        vali.bind({
            domId: 'companyName',   //需要校验的dom元素ID
            eventType: 'blur',     //触发验证的事件类型companyNameErrmsg
            msgId: 'companyNameErrmsg',
            valiType: 'require,length',    //校验类型
            min: 2,                 // 最小值
            max: 30,                //最大值
            caption: '公司名称'
        });

        vali.bind({
            domId: 'contactName',
            eventType: 'blur',
            msgId: 'contactNameErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 30,
            caption: '联系人姓名'
        });

        vali.bind({
            domId: 'contactTel',
            eventType: 'blur',
            msgId: 'contactTelErrmsg',
            valiType: 'require,telOrPhone',
            caption: '电话号码'
        });

        vali.bind({
            domId: 'contactEmail',
            eventType: 'blur',
            msgId: 'contactEmailErrmsg',
            valiType: 'require,email',
            caption: '邮箱'
        });

        vali.bind({
            domId: 'remark',
            eventType: 'blur',
            msgId: 'remarkErrmsg',
            valiType: 'length',
            max: 3000,
            caption: '备注'
        });

        $("#submitFormBtn").on("click",function(){
            submitForm();
        });

    }

    //初始化已选择规格
    function initDefaultSpec() {
        var paramName = '';
        if(url.getUrlParam("attr_names",window.location.href)){
            paramName = url.getUrlParam("attr_names",window.location.href);
            paramName = decodeURIComponent(paramName);
            var paramNameArr = paramName.split('|');
            $('#specWrap').html(formatJson.render($('#showSelectSpecTemplate').html(), {data:paramNameArr}));
        }

    }

    function submitForm(){
        if(!vali.batchVali()){
            return false;
        }
        var productId = document.getElementById('productId').value;
        var companyName = document.getElementById("companyName").value;
        var contactName = document.getElementById("contactName").value;
        var contactTel = document.getElementById("contactTel").value;
        var contactEmail = document.getElementById("contactEmail").value;
        var remark = document.getElementById("remark").value;
        var spec_value_ids = url.getUrlParam('attr_ids',window.location.href);
        if(!spec_value_ids){
            spec_value_ids = '';
        }
        var reqData = {
            p_id : productId,
            company : companyName,
            contactname : contactName,
            contact : contactTel,
            email : contactEmail,
            content : remark,
            spec_value_ids : spec_value_ids
        };

        var reqUrl = '/product/add_inquiry';
        $.ajax({
            type : "POST",
            dataType : "json",
            url : reqUrl,
            data : reqData,
            error : function (er){
                windowalert.simple({
                    errmsg : '抱歉，服务器繁忙，请稍候再试！',
                    leftButtionCallback : function(){
                        location.href = '/product';
                    },
                    buttionLeftValue : '产品中心',
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
                            location.href = '/product';
                        },
                        buttionLeftValue : '产品中心',
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
                            location.href = '/product';
                        },
                        buttionLeftValue : '产品中心',
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

