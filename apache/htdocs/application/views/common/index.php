<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/12
 * Time: 23:44
 * */
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="太空船">
    <title>太空船-电影推荐网</title>
    <meta name="description" content="推荐最值的看的电影，太空船推荐，必属精品！" />
    <meta name="keywords" content="太空船，太空船电影，太空船网，太空船电影网，太空船电影推荐，太空船电影推荐网，电影推荐网，电影排行榜，电影推荐，电影评分，电影分享，boatsky,boatsky.com,www.boatsky.com" />
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/movie/index.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<div class="main_wrap">
    <section class="main_inner mod_inner">
        <?php
        foreach ($movieQuery->result() as $row)
        {?>
            <article class="today_movie" style="margin-right: 20px;">
                <h2 title="啧啧，每天推荐一部，看不过来有木有？">每日推荐一部电影，必属精品！</h2>
                <dl>
                    <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                        <?php echo $row->name;?>
                    </dt>
                    <dd class="desc"><?php echo $row->movie_point;?></dd>
                </dl>
            </article>
        <?php }
        ?>

    </section>
</div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js" src="//www.boatsky.com/static/module/require/require.js"></script>

</body>
</html>