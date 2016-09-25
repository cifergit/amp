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
<link rel="stylesheet" href="//www.boatsky.com/static/css/blog/blog_detail.css?t=1"/>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushXml.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushSass.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushCss.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushSql.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/module/syntaxHighlighter/scripts/shBrushJava.js"></script>


<script type="text/javascript">
    SyntaxHighlighter.defaults['quick-code'] = false;
    SyntaxHighlighter.defaults['toolbar'] = false;
    //SyntaxHighlighter.defaults['html-script'] = true;
    SyntaxHighlighter.all();
</script>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <h1 class="blog_title"><?php echo $blog->title;?></h1>
        <div class="blog_mess">
            创建时间：<?php echo $blog->create_time;?>      更新时间：<?php echo $blog->update_time;?>   作者：cifer  点击：<?php echo $blog->pv;?>
        </div>
        <div class="blog_desc">
            <?php echo $blog->desc;?>
        </div>
        <div class="">
            <?php echo htmlspecialchars_decode($blog->content);?>
        </div>

        <div class="prev_next_wrap">
            <?php if(!empty($prevBlog->id)){?>
                <a class="prev_btn" href="//www.boatsky.com/blog/<?php echo $prevBlog->id;?>" title="<?php echo $prevBlog->title;?>"><span class="mod_arrow_left">&lt;</span><?php echo $prevBlog->title;?></a>
            <?php }?>
            <?php if(!empty($nextBlog->id)){?>
                <a class="next_btn" href="//www.boatsky.com/blog/<?php echo $nextBlog->id;?>" title="<?php echo $nextBlog->title;?>"><?php echo $nextBlog->title;?><span class="mod_arrow_right">&gt;</span></a>
            <?php }?>
        </div>

    </section>
</section>

<script type="text/javascript" data-main="/static/js/common/empty.js" src="/static/module/require/require.js"></script>