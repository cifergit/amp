<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/12
 * Time: 23:44
 * */
?>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/movie/index.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="main_inner mod_inner">
        <?php
        foreach ($movieQuery->result() as $row)
        {?>
            <article class="today_movie" style="margin-right: 20px;">
                <h2 title="啧啧，每天推荐一部，看不过来有木有？">每日推荐一部电影，必属精品！</h2>
                <dl>
                    <dt class="name" title="我去，为什么不能复制啊？作者原创版权所有，暂时不提供复制哦～">
                        <?php echo $row->name;?>
                    </dt>
                    <dd class="desc"><?php echo $row->movie_point;?></dd>
                </dl>
            </article>
        <?php }
        ?>

    </section>
</section>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js" src="//www.boatsky.com/static/module/require/require.js"></script>