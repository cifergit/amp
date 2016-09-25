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

    //验证分类初始化
    var valiClass = validator.init({msgTemplate: '{#msg#}'});
    var valiBookmark = validator.init({msgTemplate: '{#msg#}'});

    init();

    function init(){

        //显示标签修改弹窗
        $('#J_ShowAlert').on('click',function(){
            $('#J_BookmarkCover').removeClass('hide');
            $('#J_BookmarkAlert').removeClass('hide');
        });

        //显示标签分类修改弹窗
        $('#J_ShowClassAlert').on('click',function(){
            $('#J_BookmarkCover').removeClass('hide');
            $('#J_BookmarkClassAlert').removeClass('hide');
        });

        //关闭弹窗
        $('.J_IconDelete').on('click',function(){
            $(this).parent().addClass('hide');
            $('#J_BookmarkCover').addClass('hide');
        });

        //编辑书签分类
        $('.J_BookmarkEdit').on('click',function(){
            var id = $.trim($(this).data('id'));
            if(id){
                getBookmark(id);
            }
        });

        //编辑书签分类
        $('.J_BookmarkClassEdit').on('click',function(){
            var id = $.trim($(this).data('class_id'));
            if(id){
                getBookmarkClass(id);
            }
        });

        valiBookmark.bind({
            domId: 'J_Name',
            eventType: 'blur',
            msgId: 'J_NameMsg',
            valiType: 'require',
            caption: '标签名字'
        });

        valiBookmark.bind({
            domId: 'J_Link',
            eventType: 'blur',
            msgId: 'J_LinkMsg',
            valiType: 'require,length',
            min: 0,
            max: 100,
            caption: '链接'
        });

        valiBookmark.bind({
            domId: 'J_IconLink',
            eventType: 'blur',
            msgId: 'J_IconLinkMsg',
            valiType: 'length',
            min: 0,
            max: 100,
            caption: '图标链接'
        });

        valiBookmark.bind({
            domId: 'J_Desc',
            eventType: 'blur',
            msgId: 'J_DescMsg',
            valiType: 'length',
            min: 0,
            max: 100,
            caption: '标签分类名字'
        });


        valiClass.bind({
            domId: 'J_ClassName',
            eventType: 'blur',
            msgId: 'J_ClassNameMsg',
            valiType: 'require,length',
            min: 1,
            max: 30,
            caption: '标签分类名字'
        });

        valiClass.bind({
            domId: 'J_ClassDesc',
            eventType: 'blur',
            msgId: 'J_ClassDescMsg',
            valiType: 'length',
            min: 0,
            max: 100,
            caption: '标签分类名字'
        });

        //保存书签
        $("#J_SaveBookmark").on("click",function(){
            saveBookmark();
        });

        //保存书签分类
        $("#J_SaveBookmarkClass").on("click",function(){
            saveBookmarkClass();
        });
    }

    //得到本分类的信息
    function getBookmarkClass(id){
        $.ajax({
            type : "POST",
            dataType : "json",
            data : {id : id},
            url : "/admin/bookmark/bookmark/get_bookmark_class",
            error : function (er){
                windowalert.simple({
                    msg : '抱歉，服务器繁忙，请稍候再试！'
                });
            },
            success : function (response){
                if(response.code === 0){
                    if(response.data){
                        console.log(response.data);
                        var bookmarkClass = response.data;
                        $('#J_ClassId').val(bookmarkClass.id);
                        $('#J_ClassName').val(bookmarkClass.name);
                        $('#J_ClassDesc').val(bookmarkClass.desc);
                        $('#J_ClassStatus').val(bookmarkClass.status);
                        $('#J_BookmarkCover').removeClass('hide');
                        $('#J_BookmarkClassAlert').removeClass('hide');
                    }
                }
                else {
                    windowalert.simple({
                        msg : response.msg
                    });
                }
            }
        });
    }

    //得到本标签的信息
    function getBookmark(id){
        $.ajax({
            type : "POST",
            dataType : "json",
            data : {id : id},
            url : "/admin/bookmark/bookmark/get_bookmark",
            error : function (er){
                windowalert.simple({
                    msg : '抱歉，服务器繁忙，请稍候再试！'
                });
            },
            success : function (response){
                if(response.code === 0){
                    if(response.data){
                        console.log(response.data);
                        var bookmark = response.data;
                        $('#J_Id').val(bookmark.id);
                        $('#J_Name').val(bookmark.name);
                        $('#J_Link').val(bookmark.link);
                        $('#J_IconLink').val(bookmark.icon_link);
                        $('#J_Desc').val(bookmark.desc);
                        $('#J_Status').val(bookmark.status);
                        $('#J_BookmarkClassId').val(bookmark.bookmark_class_id);
                        $('#J_BookmarkCover').removeClass('hide');
                        $('#J_BookmarkAlert').removeClass('hide');
                    }
                }
                else {
                    windowalert.simple({
                        msg : response.msg
                    });
                }
            }
        });
    }

    //提交表单
    function saveBookmark(){
        if(!valiBookmark.batchVali()){
            return false;
        }
        var id = document.getElementById("J_Id").value;
        var bookmark_class_id = document.getElementById("J_BookmarkClassId").value;
        var name = document.getElementById("J_Name").value;
        var link = document.getElementById("J_Link").value;
        var icon_link = document.getElementById("J_IconLink").value;
        var desc = document.getElementById("J_Desc").value;
        var status = document.getElementById("J_Status").value;
        var reqData = {
            bookmark_class_id : bookmark_class_id,
            icon_link : icon_link,
            name : name,
            link : link,
            desc : desc,
            status : status
        };
        if(id){
            reqData.id = id;
        }
        var reqUrl = '/admin/bookmark/bookmark/save_bookmark';
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
                if(response.code == 0){
                    windowalert.simple({
                        msg : '恭喜您，保存书签成功!',
                        buttonEvent : [
                            {
                                value : '确定',
                                callbackEvent : function(){
                                    location.reload();
                                }
                            }
                        ]
                    });
                }
                else {
                    windowalert.simple({
                        msg : response.msg
                    });
                }
            }
        });
    }

    //增加编辑分类
    function saveBookmarkClass(){
        if(!valiClass.batchVali()){
            return false;
        }
        var id = document.getElementById("J_ClassId").value;
        var name = document.getElementById("J_ClassName").value;
        var desc = document.getElementById("J_ClassDesc").value;
        var status = document.getElementById("J_ClassStatus").value;
        var reqData = {
            name : name,
            desc : desc,
            status : status
        };
        if(id){
            reqData.id = id;
        }
        var reqUrl = '/admin/bookmark/bookmark/save_bookmark_class';
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
                if(response.code == 0){
                    windowalert.simple({
                        msg : '恭喜您，保存书签分类成功!',
                        buttonEvent : [
                            {
                                value : '确定',
                                callbackEvent : function(){
                                    location.reload();
                                }
                            }
                        ]
                    });
                }
                else {
                    windowalert.simple({
                        msg : response.msg
                    });
                }
            }
        });
    }
});
