<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/18
 * Time: 23:40
 */
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="太空船">
    <title>太空船-会员注册</title>
    <meta name="description" content="太空船会员注册" />
    <meta name="keywords" content="太空船会员注册，boatsky register" />
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/user/register.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<div class="main_wrap">
    <section class="main_inner mod_inner">
        <h1 class="page_title">一步注册</h1>
        <form class="register_form" action="" method="post">
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="email">邮箱</label>
                    <input type="email" id="email" name="email" class="form_item email" placeholder="请输入邮箱"/>
                </div>
                <div class="form_row">
                    <span class="errmsg">1</span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="email">昵称</label>
                    <input type="text" id="username" name="username" class="form_item username" placeholder="昵称"/>
                </div>
                <div class="form_row">
                    <span class="errmsg">1</span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="email">邀请码</label>
                    <input type="text" id="invite_code" name="invite_code" class="form_item invite_code" placeholder="邀请码"/>
                </div>
                <div class="form_row">
                    <span class="errmsg">1</span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="email">密码</label>
                    <input type="password" id="password" name="password" class="form_item password" placeholder="密码"/>
                </div>
                <div class="form_row">
                    <span class="errmsg">1</span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="email">确认密码</label>
                    <input type="password" id="password_again" name="password_again" class="form_item password" placeholder="确认密码"/>
                </div>
                <div class="form_row">
                    <span class="errmsg">1</span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <button type="button" class="register_btn" id="registerBtn">注册</button>
                </div>
            </div>
        </form>
    </section>
</div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript" data-main="/static/js/user/register.js?t=1" src="/static/module/require/require.js"></script>

</body>
</html>