<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/12
 * Time: 22:06
 */
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"  />
    <title>太空船-电影库</title>
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="<?php echo SERVER_ROOT;?>/static/css/common/global.css"/>
    <link rel="stylesheet" href="<?php echo SERVER_ROOT;?>/static/css/admin/movie/movie_add.css"/>
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

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="main_inner">
        <table>
            <thead>
            <tr>
                <th class="th_1">id</th>
                <th class="th_2">名字</th>
                <th class="th_3">推荐理由</th>
                <th class="th_4">日期</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($movieQuery->result() as $movie){?>
                    <tr>
                        <td><?php echo $movie->id;?></td>
                        <td><?php echo $movie->name;?></td>
                        <td><?php echo $movie->movie_point;?></td>
                        <td><?php echo $movie->create_time;?></td>
                    </tr>

             <?php }?>
            </tbody>
        </table>
    </section>
</section>

<?php $this->load->view('common/footer');?>

</body>
</html>