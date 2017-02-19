<header class="header">
    <nav class="mod_inner">
        <ul id="topNavWrap">
            <li class="top-nav-li <?php if($currentNav == 'blog'){echo 'top-nav-li--active';}?>" title="博客"><a href="//www.boatsky.com/blog.html">博客</a></li>
            <li class="top-nav-li <?php if($currentNav == 'bookmark'){echo 'top-nav-li--active';}?>" title="书签"><a href="//www.boatsky.com/bookmark.html">书签</a></li>
            <li class="top-nav-li <?php if($currentNav == 'about'){echo 'top-nav-li--active';}?>" title="关于"><a href="//www.boatsky.com/about.html">关于</a></li>
            <li class="top-nav-li <?php if($currentNav == 'links'){echo 'top-nav-li--active';}?>" title="友链"><a href="//www.boatsky.com/links.html">友链</a></li>
            <?php if(!empty($uid) && !empty($uname) && !empty($ukey)){?>
                <li class="top-nav-li" title="用户"><a href="//www.boatsky.com/user.html"><?php echo $uname;?></a></li>
            <?php }else {?>
                <li class="top-nav-li" title="登录"><a href="//www.boatsky.com/login.html">登录</a></li>
            <?php }?>

            <li class="top_nav_li top_nav_li_home hide" title="推荐电影"><a href="//www.boatsky.com/movie.html">推荐电影</a></li>
            <li class="top_nav_li top_nav_li_movie" style="display: none;" title="电影"><a href="//www.boatsky.com/movie.html">电影</a></li>

            <!--<li class="top_nav_li" title="作者感言"><a href="//www.boatsky.com/about/author.php">感言</a></li>
            <li class="top_nav_li" title="网站更新记录"><a href="//www.boatsky.com/about/history.php">记录</a></li>-->
            <li class="top_nav_li" style="display: none;" title="添加推荐电影，暂时不开放给游客，管理员专用"><a href="//www.boatsky.com/">推荐</a></li>
        </ul>
    </nav>
</header>
