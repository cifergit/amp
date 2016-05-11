<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/6
 * Time: 23:44
 * */
$server_root = "http://www.boatsky.com";
/**
 * desc:
 * User: cifer
 * DateTime: 2016/1/7 0:11
 */
$db_host = "127.0.0.1";
$db_name = "cifer";
$db_user = "cifer";
$db_password = "CFNf24hXFFz4XWUZ";
$environment = "dev";
if($environment == "dev"){
    $db_user = "root";
    $db_password = "mysql5";
}
$db_mysql_connect = "mysql:host=$db_host;dbname=$db_name";
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
        <?php $nTimeDay = date("j");?>
        <?php
        $arr_history_movie = array();
        $str_today_movie = array();
        try {
            $dbh = new PDO($db_mysql_connect, $db_user, $db_password);
            $dbh->query("SET NAMES 'UTF8'");
            $min_movie_index = 1;
            $max_movie_index = 30;
            if($max_movie_index <= 31){
                $today_movie_index = $nTimeDay%$max_movie_index+1;
            }
            else {
                $today_movie_index = $max_movie_index%$nTimeDay+1;
            }

            $sql = "select id,name,movie_point from t_movie where id = ".$today_movie_index;
            $rs = $dbh->query($sql);
            if(!empty($rs)){
                $rs2 = array();
                ?>

                <?php foreach($rs as $today_movie){?>
                    <article class="today_movie">
                        <h2 title="啧啧，每天推荐一部，看不过来有木有？">每日只推荐一部电影，必属精品！</h2>
                        <dl>
                            <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                                <?php echo $today_movie["name"];?>
                            </dt>
                            <dd class="desc"><?php echo $today_movie["movie_point"];?></dd>
                        </dl>
                    </article>
                <?php } }
        }
        catch (PDOException $e){
            echo '数据库连接失败'.$e->getMessage();
        }
        ?>

    </section>
</div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js" src="//www.boatsky.com/static/module/require/require.js"></script>

</body>
</html>