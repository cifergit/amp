<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/6/11
 * Time: 16:48
 */
?>

<link rel="stylesheet" href="http://www.boatsky.com/static/module/kindeditor/themes/default/default.css"/>
<link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/module/syntaxHighlighter/styles/shCoreDefault.css"/>
<link rel="stylesheet" href="//www.boatsky.com/static/css/blog/blog_detail.css"/>

<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushCurrent.js"></script>


<script type="text/javascript">
    SyntaxHighlighter.defaults['quick-code'] = false;
    SyntaxHighlighter.defaults['toolbar'] = false;
    //SyntaxHighlighter.defaults['html-script'] = true;
    SyntaxHighlighter.all();
</script>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main-wrap">
    <section class="mod-inner">
        <h1 class="blog_title"><?php echo $blog->title;?></h1>
        <div class="blog_mess">
            <span class="blog-message-item">原创作者：<?php echo $blogAuthor->name;?></span>
            <span class="blog-message-item">创建时间：<?php echo $blog->create_time;?></span>
            <span class="blog-message-item">阅读人次：<?php echo $blog->pv;?></span>
            <span class="blog-message-item">版权归作者所有，未经其本人允许，请勿转载，谢谢合作^_^。</span>
        </div>
        <!--<div class="blog_desc">
            <?php /*echo $blog->desc;*/?>
        </div>-->
        <div class="">
            <?php echo htmlspecialchars_decode($blog->content);?>
        </div>

        <div class="prev_next_wrap">
            <?php if(!empty($prevBlog->id)){?>
                <a class="prev_btn" href="//www.boatsky.com/blog/<?php echo $prevBlog->id;?>.html" title="<?php echo $prevBlog->title;?>"><span class="mod_arrow_left">&lt;</span><?php echo $prevBlog->title;?></a>
            <?php }?>
            <?php if(!empty($nextBlog->id)){?>
                <a class="next_btn" href="//www.boatsky.com/blog/<?php echo $nextBlog->id;?>.html" title="<?php echo $nextBlog->title;?>"><?php echo $nextBlog->title;?><span class="mod_arrow_right">&gt;</span></a>
            <?php }?>
        </div>

    </section>
</section>

<script type="text/javascript" data-main="/static/js/common/empty.js" src="/static/module/require/require.js"></script>