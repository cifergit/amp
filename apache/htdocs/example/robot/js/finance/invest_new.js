/**
 * @desc 创投
 * @author cifer
 * @date 2016-05-22
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
        windowalert: 'robot/js/component/windowalert',
        webuploader: 'robot/modules/webuploader/webuploader'
    }
});

requirejs(['jquery','global','validator','webuploader','windowalert'], function ($,global,validator,webuploader,windowalert) {
    global.init();
    var vali = validator.init({msgTemplate: '{#msg#}'});
    init();

    function init(){

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

        /*vali.bind({
            domId: 'uploadPlanSrc',
            eventType: 'blur',
            msgId: 'uploadPlanErrmsg',
            valiType: 'require',
            caption: '商业计划'
        });*/

        vali.bind({
            domId: 'productDesc',
            eventType: 'blur',
            msgId: 'productDescErrmsg',
            valiType: 'require,length',
            min: 2,
            max: 6000,
            caption: '项目描述'
        });

        vali.bind({
            domId: 'sellExcept',
            eventType: 'blur',
            msgId: 'sellExceptErrmsg',
            valiType: 'require,number',
            min: 1,
            max: 100000000,
            caption: '销售预期'
        });

        vali.bind({
            domId: 'financingScale',
            eventType: 'blur',
            msgId: 'financingScaleErrmsg',
            valiType: 'require,number',
            min: 1,
            max: 100000000,
            caption: '融资规模'
        });

        vali.bind({
            domId: 'exceptMinReturn',
            eventType: 'blur',
            msgId: 'exceptReturnErrmsg',
            valiType: 'require,float',
            decimalNum : 2,
            caption: '预期回报率'
        });

        vali.bind({
            domId: 'exceptMaxReturn',
            eventType: 'blur',
            msgId: 'exceptReturnErrmsg',
            valiType: 'require,float',
            decimalNum : 2,
            caption: '预期回报率'
        });

        vali.bind({
            domId: 'uploadPlanSrc',
            eventType: 'blur',
            msgId: 'uploadPlanErrmsg',
            valiType: 'require',
            decimalNum : 2,
            caption: '商业计划书'
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
        var $list = $('#thelist');
        var $btn = $('#ctlBtn');
        var state = 'pending';
        var uploader = webuploader.create({

            // swf文件路径
            swf: resourceUrl + 'robot/modules/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/service/cover_upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,

            //自动上传
            auto : true
        });
        uploader.on( 'fileQueued', function( file ) {
            $('#thelist').html( '<div id="' + file.id + '" class="item">' +
                '<h4 class="info">' + file.name + '</h4>' +
                '<p class="state">等待上传...</p>' +
                '</div>' );
        });

        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress progress-striped active">' +
                    '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                    '</div>' +
                    '</div>').appendTo( $li ).find('.progress-bar');
            }

            $li.find('p.state').text('上传中');

            $percent.css( 'width', percentage * 100 + '%' );
        });

        uploader.on( 'uploadSuccess', function( file, response  ) {
            if(response.status == 'ok'){
                $('#uploadPlanSrc').val(response.msg);
                $( '#'+file.id ).find('p.state').text('上传成功');
            }
            else {
                $( '#'+file.id ).find('p.state').text('上传失败');
                alert('上传失败，请您上传10M以下的doc,docx,ppt,pptx,pdf的文件');
            }
        });

        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).find('p.state').text('上传出错');
            alert('上传出错，请您上传10M以下的doc,docx,ppt,pptx,pdf的文件');
        });

        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').fadeOut();

        });

        uploader.on( 'all', function( type ) {
            if ( type === 'startUpload' ) {
                state = 'uploading';
            } else if ( type === 'stopUpload' ) {
                state = 'paused';
            } else if ( type === 'uploadFinished' ) {
                state = 'done';
            }

            if ( state === 'uploading' ) {
                $btn.text('暂停上传');
            } else {
                $btn.text('开始上传');
            }
        });

    }

    function submitForm(){
        if(!vali.batchVali()){
            return false;
        }

        var productDesc = document.getElementById("productDesc").value;
        var sellExcept = document.getElementById("sellExcept").value;
        var financingScale = document.getElementById("financingScale").value;
        var exceptMinReturn = document.getElementById("exceptMinReturn").value;
        var exceptMaxReturn = document.getElementById("exceptMaxReturn").value;
        var uploadPlanSrc = document.getElementById("uploadPlanSrc").value;
        var companyName = document.getElementById("companyName").value;
        var contactName = document.getElementById("contactName").value;
        var contactTel = document.getElementById("contactTel").value;
        var contactEmail = document.getElementById("contactEmail").value;
        var remark = document.getElementById("remark").value;
        if(parseFloat(exceptMinReturn) > parseFloat(exceptMaxReturn)){
            $('#exceptReturnErrmsg').show().html('预期回报率前者须小于后者');
            return false;
        }
        var reqData = {
            describes : productDesc,
            expect : sellExcept,
            scale : financingScale,
            min_repay : exceptMinReturn,
            max_repay : exceptMaxReturn,
            cover : uploadPlanSrc,
            company : companyName,
            contactname : contactName,
            contact : contactTel,
            email : contactEmail,
            content : remark
        };

        var reqUrl = '/service/add_invest_new';
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


