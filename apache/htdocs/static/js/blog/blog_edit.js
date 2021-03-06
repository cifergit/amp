﻿/**
 * Created by cifer on 2016/6/11.
 */
require.config({
    baseUrl: baseUrl,
    paths: {
        jquery: 'module/jquery/jquery',
        validator: 'js/component/validator',
        windowalert: 'js/component/windowalert',
        global: 'js/common/global'
    }
});


requirejs(['jquery','global','validator','windowalert'], function ($,global, validator,windowalert) {
    global.init();
    console.log("blog new");
   

    //验证初始化
    var vali = validator.init({msgTemplate: '{#msg#}'});
    init();
    function init(){
        vali.bind({
            domId: 'J_Title',
            eventType: 'blur',
            msgId: 'J_TitleMsg',
            valiType: 'require,length',
            min: 1,
            max: 30,
            caption: ''
        });
        vali.bind({
            domId: 'J_Desc',
            eventType: 'blur',
            msgId: 'J_DescMsg',
            valiType: 'length',
            max: 300,
            caption: ''
        });
        /*vali.bind({
            domId: 'J_Content',
            eventType: 'blur',
            msgId: 'J_ContentMsg',
            valiType: 'require,length',
            min: 1,
            max: 20000,
            caption: ''
        });*/
        vali.bind({
            domId: 'J_HtmlDesc',
            eventType: 'blur',
            msgId: 'J_HtmlDescMsg',
            valiType: 'length',
            max: 50,
            caption: ''
        });

        vali.bind({
            domId: 'J_HtmlKey',
            eventType: 'blur',
            msgId: 'J_HtmlKeyMsg',
            valiType: 'length',
            max: 200,
            caption: ''
        });

        $('#J_SubmitBtn').on('click',function(){
            submitForm();
        });
    }
    //提交表单
    function submitForm(){
        if(!vali.batchVali()){
            return false;
        }
        var id = document.getElementById("J_Id").value;
        var title = document.getElementById("J_Title").value;
        var desc = document.getElementById("J_Desc").value;
        //var content = document.getElementById('J_Content').value;
        var content = kindeditors.html();
        var html_desc = document.getElementById("J_HtmlDesc").value;
        var html_key = document.getElementById("J_HtmlKey").value;
        var reqData = {
            id : id,
            title : title,
            desc : desc,
            content : content,
            html_desc : html_desc,
            html_key : html_key
        };
        var reqUrl = '/blog/blog_edit';
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
                        msg : '恭喜您，提交成功!'
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
});

