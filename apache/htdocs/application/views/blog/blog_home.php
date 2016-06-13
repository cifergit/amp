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
                <h1 class="title">我的分享：</h1>
                <ol class="blog_ol" type="1">
                    <?php foreach($query->result() as $blog){?>
                        <li>
                            <a href="http://www.boatsky.com/blog/<?php echo $blog->id;?>"><?php echo $blog->title;?><span class="date"><?php echo $blog->create_time;?></span></a>
                        </li>
                    <?php }?>
                </ol>
                <a class="mod_btn mod_btn_primary mod_btn_sm new_blog_btn" href="http://www.boatsky.com/blog/add">写博客</a>
            </div>
        </div>
    </section>
</section>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js"
        src="//www.boatsky.com/static/module/require/require.js"></script>