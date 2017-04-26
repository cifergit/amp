<?php
/**
 * desc register view.
 * User: cifer
 * Date: 2016/5/18
 * Time: 23:40
 */?>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/user/register.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<div class="main-wrap">
    <section class="main_inner mod-inner">
        <h1 class="page_title">一步注册</h1>
        <form class="register_form" action="" method="post">
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="email">邮箱</label>
                    <input type="email" id="J_Email" name="J_Email" class="form_item email" placeholder="请输入邮箱"/>
                </div>
                <div class="form_row form_row_msg">
                    <span class="errmsg" id="J_EmailMsg"></span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="J_Name">昵称</label>
                    <input type="text" id="J_Name" name="J_Name" class="form_item username" placeholder="昵称"/>
                </div>
                <div class="form_row form_row_msg">
                    <span class="errmsg" id="J_NameMsg"></span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <label class="label" for="J_InviteCode">邀请码</label>
                    <input type="text" id="J_InviteCode" name="J_InviteCode" class="form_item invite_code" placeholder="邀请码"/>
                </div>
                <div class="form_row form_row_msg">
                    <span class="errmsg" id="J_InviteCodeMsg"></span>
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
                    <label class="label" for="J_PasswordConfirm">确认密码</label>
                    <input type="password" id="J_PasswordConfirm" name="J_PasswordConfirm" class="form_item password" placeholder="确认密码"/>
                </div>
                <div class="form_row form_row_msg">
                    <span class="errmsg" id="J_PasswordConfirmMsg"></span>
                </div>
            </div>
            <div class="form_item">
                <div class="form_row">
                    <button type="button" class="register_btn" id="J_RegisterBtn">注册</button>
                </div>
            </div>
        </form>
    </section>
</div>

<script type="text/javascript" data-main="/static/js/user/register.js?t=1" src="/static/module/require/require.js"></script>




