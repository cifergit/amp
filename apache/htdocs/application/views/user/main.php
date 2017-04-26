<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/6/11
 * Time: 0:43
 */
?>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main-wrap">
    <section class="mod-inner">
        <h1 class="page_title">个人首页</h1>
        <div class="row">
            <div class="lable">昵称：</div>
            <div class="message"><?php echo $user->name;?></div>
        </div>
        <div class="row">
            <div class="lable">邮箱：</div>
            <div class="message"><?php echo $user->email;?></div>
        </div>
        <div class="row">
            <div class="lable">注册时间：</div>
            <div class="message"><?php echo $user->create_time;?></div>
        </div>
    </section>
</section>

<script type="text/javascript" data-main="/static/js/common/empty.js?t=1" src="/static/module/require/require.js"></script>