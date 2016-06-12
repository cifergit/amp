<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/6/11
 * Time: 16:48
 */
?>

<link rel="stylesheet" href="http://www.boatsky.com/static/module/kindeditor/themes/default/default.css"/>
<link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/component/syntaxHighlighter/styles/shCoreDefault.css"/>
<link rel="stylesheet" href="//www.boatsky.com/static/css/blog/detail.css"/>
<script type="text/javascript" src="http://www.boatsky.com/static/component/syntaxHighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="http://www.boatsky.com/static/component/syntaxHighlighter/scripts/shBrushXml.js"></script>
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
        <h1 class="page_title"><?php echo $blog->title;?></h1>
        <div class="">
            创建时间：<?php echo $blog->create_time;?>      更新时间：<?php echo $blog->update_time;?>
        </div>
        <div class="">
            <?php echo htmlspecialchars_decode($blog->content);?>
        </div>

    </section>
</section>

<script type="text/javascript" data-main="/static/js/common/empty.js" src="/static/module/require/require.js"></script>