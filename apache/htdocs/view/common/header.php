
<?php
/**
 * desc: header
 * User: cifer 
 * DateTime: 2016/1/1 18:21
 */
?>
<header>
    <nav id="topNavWrap">
        <ul>
            <li></li>
            <li title="电影主页"><a href="<?php echo $server_root;?>">电影</a></li>
            <li title="作者感言"><a href="<?php echo $server_root;?>about/author.php">感言</a></li>
            <li title="网站更新记录"><a href="<?php echo $server_root;?>about/history.php">记录</a></li>
            <li title="添加推荐电影，暂时不开放给游客，管理员专用"><a href="<?php echo $server_root;?>admin/movie_add.php">推荐</a></li>
        </ul>
    </nav>
    <script type="text/javascript" src="<?php echo $server_root;?>static/js/module/bs.common.js"></script>
</header>
