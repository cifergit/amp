<?php include "../config/common/common.php";?>
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
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/movie/index.css"/>
</head>
<body>

<?php include "../view/common/header.php";?>

<!-- 电影为舟,分享是岸,太空为海,梦想是船-->

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
        <?php
        $arr_history_movie = array();
        $str_today_movie = array();
        try {
            $dbh = new PDO($db_mysql_connect, $db_user, $db_password);
            $dbh->query("SET NAMES 'utf8'");
            $sql = "select * from t_movie_day_recommend where recommend_time <= '$str_today'";
            $rs = $dbh->query($sql);
            if(!empty($rs)){
                $rs2 = array();
                ?>

                <?php foreach($rs as $today_movie){

                    if($str_today == $today_movie["recommend_time"]){?>
                        <article class="today_movie">
                            <h2 title="啧啧，每天推荐一部，看不过来有木有？">今日电影推荐（太空船推荐，必属精品！）</h2>
                            <dl>
                                <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                                    <?php echo $today_movie["name"];?>
                                </dt>
                                <dd class="desc"><?php echo $today_movie["comment"];?></dd>
                            </dl>
                        </article>
                    <?php }
                    else {
                        $rs2[] = $today_movie;
                    }
                }?>

                <article class="history_movie"  title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                    <h2 class="history_title">电影推荐历史</h2>
                    <ul>
                        <?php foreach($rs2 as $history_movie){?>
                            <li <?php if(!empty($history_movie["comment"])){?>title="<?php echo $history_movie["comment"];}?>"><?php echo $history_movie["recommend_time"];?>&nbsp;&nbsp;<?php echo $history_movie["name"];?></li>
                        <?php }?>
                    </ul>
                </article>

            <?php }
        }
        catch (PDOException $e){
            echo '数据库连接失败'.$e->getMessage();
        }
        ?>

    </section>

</section>

<?php include "../view/common/footer.php";?>

</body>
</html>

