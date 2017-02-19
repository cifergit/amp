<?php
/**
 * desc:
 * User: cifer
 * Date: 2016/6/11
 * Time: 0:43
 */
?>
<link rel="stylesheet" href="//www.boatsky.com/static/css/blog/blog_list.css">
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <div class="my_share">
            <div class="inner">
                <!--<h1 class="title">cifer的博客：</h1>-->
                <ul class="blog-ul">
                    <?php foreach($query->result() as $key => $blog){?>
                        <li class="blog-li">
                            <a class="blog-a" href="http://www.boatsky.com/blog/<?php echo $blog->id;?>.html" title="<?php echo $blog->title;?>">
                                <span class="num"><?php echo $key+1;?>.</span>
                                <span class="name"><?php echo $blog->title;?></span>
                                <span class="date"><?php echo $blog->create_time;?></span>
                                <span class="pv"><?php echo $blog->pv;?>人浏览</span>
                            </a>
                        </li>
                    <?php }?>
                </ul>
                <a class="mod_btn mod_btn_primary mod_btn_sm new_blog_btn hide" href="http://www.boatsky.com/blog/add">添加</a>
            </div>
        </div>
        <!--<div class="my_demo">
            <h2 class="demo_title hide">demo入口</h2>
            <ul class="demo_list">
                <li class="demo_item">
                    <a class="demo_a" href="http://www.boatsky.com/static/html/common/link.html">demo链接</a>
                </li>
            </ul>
        </div>-->
    </section>
</section>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js"
        src="//www.boatsky.com/static/module/require/require.js"></script>