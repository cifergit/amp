<?php include "../../config/common/common.php";?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"  />
    <title>太空船-管理员电影推荐</title>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/admin/movie_add.css?t=2"/>
</head>

<body>

<?php include "../../view/common/header.php";?>

<section class="main_wrap">
    <section class="main_inner">
        <h2 class="page_title">本功能暂时仅供管理员使用，后续版本对外开放</h2>
        <form>
            <div class="add_movie_form">
                <div class="row">
                    <div class="title">电影名：</div>
                    <div class="content">
                        <input class="input" type="text" value="" placeholder="电影名字" id="movie_name" name="movie_name">
                    </div>
                </div>
                <div class="row">
                    <div class="title">点评：</div>
                    <div class="content">
                        <input class="input" type="text" value="" placeholder="点评" id="movie_comment" name="movie_comment">
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="title">推荐日期：</div>
                    <div class="content">
                        <input class="input" type="text" value="" placeholder="推荐日期" id="recommend_time" name="recommend_time">
                    </div>
                </div>
                <div class="row">
                    <div class="title">暗号：</div>
                    <div class="content">
                        <input class="input" type="text" value="" placeholder="管理员暗号" id="admin_code" name="admin_code">
                    </div>
                </div>
                <div class="row">
                    <div class="title">&nbsp;</div>
                    <div class="content">
                        <button type="button" class="submit_btn" id="submitBtn">提交</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</section>

<script type="text/javascript" src="<?php echo $server_root;?>static/js/module/bs.admin.movie.manage.js"></script>
<?php include "../../view/common/footer.php";?>

</body>
</html>