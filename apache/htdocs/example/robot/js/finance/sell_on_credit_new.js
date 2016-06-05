/**
 * @desc 赊销
 * @author cifer
 * @date 2016-05-13
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

        //选择分类
        $('.mod_form_item_product').on('click','.js_icon_check',function(){
            var $subCategory = $(this).parent();
            if($subCategory.hasClass('sub_category_cur')){
                $subCategory.removeClass('sub_category_cur');
            }
            else {
                $subCategory.addClass('sub_category_cur');
            }
        });

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
            domId: 'creditExcept',
            eventType: 'blur',     //
            msgId: 'creditExceptErrmsg',
            valiType: 'require,number,range',
            min: 1,
            caption: '赊销预期'
        });

        vali.bind({
            domId: 'creditMoney',
            eventType: 'blur',
            msgId: 'creditMoneyErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 100000000,
            caption: '赊销金额'
        });

        vali.bind({
            domId: 'creditDate',
            eventType: 'blur',
            msgId: 'creditDateErrmsg',
            valiType: 'require,length',
            min: 1,
            max: 3650,
            caption: '赊销天数'
        });

        vali.bind({
            domId: 'companyName',
            eventType: 'blur',
            msgId: 'companyNameErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 30,
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

    //提交注册表单
    function submitForm(){
        var subCategoryArr = [];
        $('.sub_category_cur').each(function(){
            if($(this).data('subcategory_id')){
                subCategoryArr.push($(this).data('subcategory_id'));
            }
        });
        if(subCategoryArr.length == 0){
            $('#categoryErrmsg').show().html('您最少需要选择一个产品类别');
            window.scrollTo(0, 0);
            return false;
        }
        else {
            $('#categoryErrmsg').hide().html('您最少需要选择一个产品类别');
        }
        if(!vali.batchVali()){
            return false;
        }
        var subCategoryStr = subCategoryArr.join(',');
        var creditExcept = document.getElementById("creditExcept").value;
        var creditMoney = document.getElementById("creditMoney").value;
        var creditDate = document.getElementById("creditDate").value;
        var companyName = document.getElementById("companyName").value;
        var contactName = document.getElementById("contactName").value;
        var contactTel = document.getElementById("contactTel").value;
        var contactEmail = document.getElementById("contactEmail").value;
        var remark = document.getElementById("remark").value;

        var reqData = {
            needed : subCategoryStr,
            expect : creditExcept,
            scale : creditMoney,
            expire : creditDate,
            company : companyName,
            contactname : contactName,
            contact : contactTel,
            email : contactEmail,
            content : remark
        };
        var reqUrl = '/service/add_sell_on_credit_new';
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
                windowalert.simple({
                    errmsg : '抱歉，服务器繁忙，请稍候再试！',
                    leftButtionCallback : function(){
                        location.href = '/service/index';
                    },
                    buttionLeftValue : '金融服务',
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
                            location.href = '/service/index';
                        },
                        buttionLeftValue : '金融服务',
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
                            location.href = '/service/index';
                        },
                        buttionLeftValue : '金融服务',
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
