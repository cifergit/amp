<?php
/**
 * desc login view.
 * User: cifer
 * Date: 2016/6/10
 * Time: 18:55
 */?>
<link rel="stylesheet" href="//www.boatsky.com/static/css/user/login.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="main_inner mod_inner">
        <h1 class="page_title">立即登录</h1>
        <h3 class="page_title">没有账号？<a href="/register">注册一个</a>吧</h3>
        <form class="register_form" action="" method="post">
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="J_Name">用户名</label>
                    <input type="text" id="J_Name" name="J_Name" class="form_item username" placeholder="邮箱或昵称"/>
                </div>
                <div class="form_row form_row_msg">
                    <span class="errmsg" id="J_NameMsg"></span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="J_Password">密码</label>
                    <input type="password" id="J_Password" name="J_Password" class="form_item password" placeholder="密码"/>
                </div>
                <div class="form_row form_row_msg">
                    <span class="errmsg" id="J_PasswordMsg"></span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <button type="button" class="mod_btn mod_btn_primary login_btn" id="J_LoginBtn">登录</button>
                </div>
            </div>
        </form>
    </section>
</section>

<script type="text/javascript" data-main="/static/js/user/login.js?t=1" src="/static/module/require/require.js"></script>