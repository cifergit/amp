<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="太空船">
    <title>cifer的博客</title>
    <meta name="description" content="cifer的博客" />
    <meta name="keywords" content="cifer，cifer的博客" />
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <!--#include virtual="/static/blog_list.html" -->

</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <div class="my_share">
            <div class="inner">
                <h1 class="title">我的分享：</h1>
                <ol class="blog_ol" type="1">
                    <li><a href="//www.boatsky.com/blog/index/regexp">万金油之正则表达式<span class="date">2016-06-02</span></a></li>
                    <li><a href="http://www.boatsky.com/blog/index/html_write">如何用正确的姿势写HTML<span class="date">2016-06-23</span></a></li>
                </ol>
            </div>
        </div>
    </section>
</section>

<?php $this->load->view('common/footer');?>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js" src="//www.boatsky.com/static/module/require/require.js"></script>

</body>
</html>