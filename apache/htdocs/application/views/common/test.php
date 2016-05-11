<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="太空船">
    <title>test</title>
    <meta name="description" content="推荐最值的看的电影，太空船推荐，必属精品！" />
    <meta name="keywords" content="太空船，电影推荐网，电影排行榜，太空船网，太空船电影，太空船电影网，太空船电影推荐，电影推荐，电影评分，电影分享" />
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/movie/index.css"/>
</head>
<body>


<?php $this->load->view('common/header');?>

<div class="main_wrap">
    <?php echo $_SERVER['SERVER_ADDR'];?>
    <?php
    foreach ($query->result() as $row)
    {
        echo $row->id;
        echo $row->name;
    }?>
</div>

<?php $this->load->view('common/footer');?>

</body>
</html>