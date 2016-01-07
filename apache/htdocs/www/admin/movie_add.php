<?php include "../../config/common/common.php";?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"  />
    <title>太空船-管理员电影推荐</title>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/movie_manage/movie_add.css"/>
    <style>
        input,button {
            margin-bottom: 20px;
            height: 30px;
            line-height: 30px;;
        }
    </style>
</head>

<body>

<?php include "../../view/common/header.php";?>

<section class="main_wrap">
    <section class="main_inner">
        <h2>本功能暂时只有管理员能使用，全面开放将在后续版本实现</h2>
        <form action="<?php echo $server_root;?>controller/admin/movie_add.php" method="post">
            电影名：<input type="text" value="" placeholder="电影名字" id="movie_name" name="movie_name"><br>
            点评：<input type="text" value="" placeholder="点评" id="movie_comment" name="movie_comment"><br>
            推荐日期：<input type="text" value="" placeholder="推荐日期" id="recommend_time" name="recommend_time"><br>
            暗号：<input type="text" value="" placeholder="管理员暗号" id="movie_password" name="movie_password"><br>
            <button type="submit">提交</button>
        </form>
    </section>
</section>

<?php include "../../view/common/footer.php";?>

</body>
</html>