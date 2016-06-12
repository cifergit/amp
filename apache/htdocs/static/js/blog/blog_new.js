/**
 * Created by cifer on 2016/6/11.
 */
require.config({
    baseUrl: baseUrl,
    paths: {
        jquery: 'module/jquery/jquery',
        kindeditor : 'module/kindeditor/kindeditor-all',
        kindeditor_cn : 'module/kindeditor/lang/zh-CN',
        validator: 'js/component/validator',
        windowalert: 'js/component/windowalert',
        global: 'js/common/global'
    }
});


requirejs(['jquery','global','kindeditor','validator','windowalert'], function ($,global, kindeditor,validator,windowalert) {
    global.init();
    console.log("blog new");
    KindEditor.ready(function(K) {
        window.editor = K.create('#J_Content');
    });
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
        vali.bind({
            domId: 'J_Content',
            eventType: 'blur',
            msgId: 'J_ContentMsg',
            valiType: 'require,length',
            min: 1,
            max: 20000,
            caption: ''
        });
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
        var title = document.getElementById("J_Title").value;
        var desc = document.getElementById("J_Desc").value;
        var content = document.getElementById("J_Content").value;
        var html_desc = document.getElementById("J_HtmlDesc").value;
        var html_key = document.getElementById("J_HtmlKey").value;
        var reqData = {
            title : title,
            desc : desc,
            content : content,
            html_desc : html_desc,
            html_key : html_key
        };
        var reqUrl = '/blog/blog_add';
        $.ajax({
            type : "POST",
            dataType : "json",
            data : reqData,
            url : reqUrl,
            error : function (er){
                windowalert.simple({
                    errmsg : '抱歉，服务器繁忙，请稍候再试！',
                    leftButtionCallback : function(){
                        location.href = '/blog';
                    },
                    buttionLeftValue : '返回博客页',
                    rightButtionCallback : function(){
                        windowalert.hideWindowalert();
                    },
                    buttionRightValue : '返回修改'
                });
            },
            success : function (response){
                if(response.errcode === 0){
                    windowalert.simple({
                        errmsg : '恭喜您，提交成功!',
                        leftButtionCallback : function(){
                            location.href = '/blog';
                        },
                        buttionLeftValue : '返回博客列页',
                        rightButtionCallback : function(){
                            location.href = '/user';
                            //document.body.scrollTop = 0;
                            //location.reload();
                        },
                        buttionRightValue : '个人中心'
                    });
                }
                else {
                    windowalert.simple({
                        errmsg : response.errmsg,
                        leftButtionCallback : function(){
                            location.href = '/blog';
                        },
                        buttionLeftValue : '博客列表',
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
