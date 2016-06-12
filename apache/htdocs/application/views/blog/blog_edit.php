<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/6/11
 * Time: 20:34
 */
?>
<link rel="stylesheet" href="http://www.boatsky.com/static/module/kindeditor/themes/default/default.css"/>
<link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/component/syntaxHighlighter/styles/shCoreDefault.css"/>
<link rel="stylesheet" href="//www.boatsky.com/static/css/blog/blog_new.css"/>
<script type="text/javascript" src="http://www.boatsky.com/static/component/syntaxHighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/component/syntaxHighlighter/scripts/shBrushXml.js"></script>
<script type="text/javascript">
    SyntaxHighlighter.defaults['quick-code'] = false;
    SyntaxHighlighter.defaults['toolbar'] = false;
    SyntaxHighlighter.all();
</script>

</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <h1 class="page_title">修改博客</h1>
        <form class="blog_form mod_form" action="" method="post">
            <input type="hidden" id="J_Id" name="J_Id" value="<?php echo $blog->id;?>">
            <div class="form_row">
                <label class="label" for="J_Title">标题</label>
                <input type="text" id="J_Title" name="J_Title" class="form_item" placeholder="标题" value="<?php echo $blog->title;?>"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_TitleMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_Desc">简介</label>
                <input type="text" id="J_Desc" name="J_Desc" class="form_item" placeholder="简介" value="<?php echo $blog->desc;?>"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_DescMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_Content">内容</label>
                <textarea id="J_Content" name="J_Content" style="width:700px;height:300px;">
                    <?php echo $blog->content;?>
                </textarea>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_ContentMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_HtmlDesc">搜索描述</label>
                <input type="text" id="J_HtmlDesc" name="J_HtmlDesc" class="form_item" placeholder="搜索描述" value="<?php echo $blog->html_desc;?>"/>
            </div>
            <div class="form_row form_row_msg">
                <span class="errmsg" id="J_HtmlDescMsg"></span>
            </div>

            <div class="form_row">
                <label class="label" for="J_HtmlKey">搜索关键字</label>
                <input type="text" id="J_HtmlKey" name="J_HtmlKey" class="form_item" placeholder="搜索关键字" value="<?php echo $blog->html_key;?>"/>
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

<script type="text/javascript" data-main="/static/js/blog/blog_edit.js" src="/static/module/require/require.js"></script>