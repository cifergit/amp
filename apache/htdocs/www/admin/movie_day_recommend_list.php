<?php include "../../config/common/common.php";?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"  />
    <title>太空船-添加电影</title>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo $server_root;?>static/css/movie_manage/movie_add.css"/>
    <style>
        table {
            width: 100%;
        }
        th {
            width: 25%;
            text-align: left;
        }
        .th_1 {
            width: 10%;
        }
        .th_2 {
            width: 30%;
        }
        .th_4 {
            width: 20%;
        }
    </style>
</head>

<body>

<?php include "../../view/common/header.php";?>

<section class="main_wrap">
    <section class="main_inner">
        <table>
            <thead>
                <tr>
                    <th class="th_1">id</th>
                    <th class="th_2">名字</th>
                    <th class="th_3">介绍</th>
                    <th class="th_4">日期</th>
                </tr>
            </thead>
            <tbody>
            <?php
            try {
                $dbh = new PDO($db_mysql_connect, $db_user, $db_password);
                $dbh->query("SET NAMES 'utf8'");
                $sql = "select * from t_movie_day_recommend;";
                $rs =$dbh->query($sql);
                foreach($rs as $row){
                    ?>
                    <tr>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $row["name"];?></td>
                        <td><?php echo $row["comment"];?></td>
                        <td><?php echo $row["recommend_time"];?></td>
                    </tr>
                <?php
                }
            }
            catch (PDOException $e){
                echo '数据库连接失败'.$e->getMessage();
            }
            ?>
            </tbody>
        </table>
    </section>
</section>

<?php include "../../view/common/footer.php";?>

</body>
</html>