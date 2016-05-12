<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/6
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
    <meta name="keywords" content="太空船，电影推荐网，电影排行榜，太空船网，太空船电影，太空船电影网，太空船电影推荐，电影推荐，电影评分，电影分享" />
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/movie/index.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<div class="main_wrap">


    <section class="main_inner mod_inner">
        <?php
        $indexMovieCount = 1;
        foreach ($arrMovie as $movie)
        {?>
            <?php if($indexMovieCount == 1){?>
            <article class="today_movie">
                <h2 title="啧啧，每天推荐一部，很好看有木有？">今日推荐，必属精品！</h2>
                <dl>
                    <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                        <?php echo $movie->name;?>
                    </dt>
                    <dd class="desc"><?php echo $movie->movie_point;?></dd>
                </dl>
            </article>
        <?php }else if($indexMovieCount == 2) {?>
            <article class="today_movie">
                <h2 title="昨日推荐,你看完了吗？">昨日推荐,你看完了吗？</h2>
                <dl>
                    <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                        <?php echo $movie->name;?>
                    </dt>
                    <dd class="desc"><?php echo $movie->movie_point;?></dd>
                </dl>
            </article>
        <?php } else {?>
            <article class="today_movie">
                <h2 title="啧啧，每天推荐一部，看不过来有木有？">前日推荐,犹如在昨日？</h2>
                <dl>
                    <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                        <?php echo $movie->name;?>
                    </dt>
                    <dd class="desc"><?php echo $movie->movie_point;?></dd>
                </dl>
            </article>
        <?php }
            $indexMovieCount++;?>
        <?php }
        ?>
    </section>
</div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js" src="//www.boatsky.com/static/module/require/require.js"></script>

</body>
</html>