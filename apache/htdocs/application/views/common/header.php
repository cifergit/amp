<header class="header">
    <nav class="mod_inner">
        <ul id="topNavWrap">
            <li class="top_nav_li top_nav_li_home" title="主页"><a href="//www.boatsky.com">主页</a></li>
            <li class="top_nav_li top_nav_li_movie" style="display: none;" title="电影"><a href="//www.boatsky.com/movie">电影</a></li>
            <li class="top_nav_li top_nav_li_blog" title="博客"><a href="//www.boatsky.com/blog">博客</a></li>
            <li class="top_nav_li top_nav_li_bookmark" title="书签"><a href="//www.boatsky.com/bookmark">书签</a></li>
            <?php if(!empty($uid) && !empty($uname) && !empty($ukey)){?>
            <li class="top_nav_li top_nav_li_user" title="用户"><a href="//www.boatsky.com/user"><?php echo $uname;?></a></li>
            <?php }else {?>
            <li class="top_nav_li top_nav_li_user" title="登录"><a href="//www.boatsky.com/login">登录</a></li>
            <?php }?>
            <!--<li class="top_nav_li" title="作者感言"><a href="//www.boatsky.com/about/author.php">感言</a></li>
            <li class="top_nav_li" title="网站更新记录"><a href="//www.boatsky.com/about/history.php">记录</a></li>-->
            <li class="top_nav_li" style="display: none;" title="添加推荐电影，暂时不开放给游客，管理员专用"><a href="//www.boatsky.com/">推荐</a></li>
        </ul>
    </nav>
</header>
