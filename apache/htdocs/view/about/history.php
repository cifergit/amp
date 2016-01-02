<?php
/**
 * desc: history
 * User: cifer 
 * DateTime: 2016/1/1 20:37
 */
?>
<?php include "../../config/common.php";?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"  />
    <title>太空船-更新记录</title>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/about/history.css"/>
</head>
<body>

<?php include "../common/header.php";?>

<?php
$history = array();
$history["2016"]["01"] = "起航";
?>

<section class="main_wrap">
    <div class="main_inner">
        <section class="work">
            <h1>太空船更新记录</h1>
            <table>
                <thead>
                    <tr>
                        <th class="hd_1">版本</th>
                        <th class="hd_2">日期</th>
                        <th class="hd_3">更新内容</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.0.1</td>
                        <td>2016-01-01</td>
                        <td>太空船上线，增加静态主页。</td>
                    </tr>
                    <tr>
                        <td>1.1.1</td>
                        <td>2016-01-02</td>
                        <td>增加感言、更新记录两个页面。主页样式改版，动态拉取电影配置数据。</td>
                    </tr>
                    <tr>
                        <td>1.1.2</td>
                        <td>2016-01-03</td>
                        <td>主页样式改版。</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</section>

<?php include "../common/footer.php";?>

</body>
</html>
