<script>
    var globalMess = {};
    SERVER_ROOT = '<?php echo SERVER_ROOT;?>';
    if(typeof(SERVER_ROOT) != 'undefined' && SERVER_ROOT){
    }
    else {
        SERVER_ROOT ='//www.boatsky.com';
    }
</script>
<header class="header">
    <nav class="mod_inner">
        <ul id="topNavWrap">
            <li class="top_nav_li top_nav_li_home" title="主页"><a href="//www.boatsky.com">主页</a></li>
            <li class="top_nav_li top_nav_li_movie" title="电影"><a href="//www.boatsky.com/movie">电影</a></li>
            <li class="top_nav_li top_nav_li_blog" title="博客"><a href="//www.boatsky.com/blog">博客</a></li>
            <li class="top_nav_li top_nav_li_user" title="会员"><a href="//www.boatsky.com/register">注册</a></li>
            <!--<li class="top_nav_li" title="作者感言"><a href="//www.boatsky.com/about/author.php">感言</a></li>
            <li class="top_nav_li" title="网站更新记录"><a href="//www.boatsky.com/about/history.php">记录</a></li>-->
            <li class="top_nav_li" style="display: none;" title="添加推荐电影，暂时不开放给游客，管理员专用"><a href="//www.boatsky.com/">推荐</a></li>
        </ul>
    </nav>
</header>
