<?php include "./config/common.php";?>
<?php include "./config/movie_data.php";?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="太空船2">
    <title>太空船</title>
    <meta name="description" content="太空船电影网，电影排行榜，电影为舟,分享是岸,太空为海,梦想是船" />
    <meta name="keywords" content="太空船电影网，电影排行榜，电影推荐、电影评分，电影分享" />
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/movie/index.css"/>
</head>
<body>

<?php include "./view/common/header.php";?>


<section class="main_wrap">

    <section class="crumb_warp" title="为什么太空船变成了轮船？还这么丑！吖啊，这些细节就不要在意了，看下面推荐的电影就好了^-^">
        <article class="boat_wrap">
            <section class="boat_inner">
                <div class="boat_header">
                    <div class="boat_window"></div>
                    <div class="boat_window boat_window_2"></div>
                    <div class="boat_window"></div>
                </div>
                <div class="boat_footer"></div>

            </section>
        </article>
    </section>

    <section class="main_inner">
        <?php $str_today = date("Y-m-d");?>
        <?php if(!empty($movie_data[$str_today]) && !empty($movie_data[$str_today]["name"])){?>
            <article class="today_movie">
                <h2 title="啧啧，每天推荐一部，看不过来有木有？">每日电影推荐，必属精品！</h2>
                <dl>
                    <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                        <?php echo $movie_data[$str_today]["name"];?>
                    </dt>
                    <?php if(!empty($movie_data[$str_today]["desc"])){?>
                    <dd class="desc"><?php echo $movie_data[$str_today]["desc"];?></dd>
                    <?php }?>
                </dl>
            </article>
        <?php }?>


        <article class="history_movie"  title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
            <h2 class="history_title">电影推荐历史</h2>
            <ul>
                <?php foreach($movie_data as $key => $movie){
                    if(strtotime($key) < strtotime($str_today) && !empty($movie) && !empty($movie["name"])){?>
                        <li <?php if(!empty($movie["desc"])){?>title="<?php echo $movie["desc"];}?>"><?php echo $key;?>&nbsp;&nbsp;<?php echo $movie["name"];?></li>
                    <?php }
                    else {
                        break;
                    }
                 }?>
            </ul>
        </article>
    </section>

</section>

<?php include "./view/common/footer.php";?>

</body>
</html>