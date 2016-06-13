<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/6/11
 * Time: 10:39
 */
?><link rel="stylesheet" href="http://www.boatsky.com/static/module/kindeditor/themes/default/default.css"/>
<link rel="stylesheet" href="//www.boatsky.com/static/css/blog/blog_new.css"/>
<script charset="utf-8" src="http://www.boatsky.com/static/module/kindeditor/kindeditor-all.js"></script>
<script charset="utf-8" src="http://www.boatsky.com/static/module/kindeditor/lang/zh-CN.js"></script>
<script>
	KindEditor.ready(function(K) {
        window.kindeditors = K.create('#J_Content',{
            cssPath : '/static/module/kindeditor/plugins/code/prettify.css',
            imageUploadJson: '/static/module/kindeditor/php/upload_json.php',
            fileManagerJson: '/static/module/kindeditor/php/file_manager_json.php',
            allowFileManager : true
        });
    });
</script>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <h1 class="page_title">创建博客</h1>
        <form class="blog_form mod_form" action="" method="post">
            <div class="form_row">
                <label class="label" for="J_Title">标题</label>
                <input type="text" id="J_Title" name="J_Title" class="form_item" placeholder="标题"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_TitleMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_Desc">简介</label>
                <input type="text" id="J_Desc" name="J_Desc" class="form_item" placeholder="简介"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_DescMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_Content">内容</label>
                <textarea id="J_Content" name="J_Content" style="width:850px;height:500px;">
                </textarea>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_ContentMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_HtmlDesc">搜索描述</label>
                <input type="text" id="J_HtmlDesc" name="J_HtmlDesc" class="form_item" placeholder="搜索描述"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_HtmlDescMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_HtmlKey">搜索关键字</label>
                <input type="text" id="J_HtmlKey" name="J_HtmlKey" class="form_item" placeholder="搜索关键字"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_HtmlKeyMsg"></span>
            </div>

            <div class="form_row">
                <label class="label">&nbsp;</label>
                <button type="button" class="mod_btn mod_btn_primary mod_btn_md submit_btn" id="J_SubmitBtn">提交</button>
            </div>
        </form>
    </section>
</section>

<script type="text/javascript" data-main="/static/js/blog/blog_new.js" src="/static/module/require/require.js"></script>