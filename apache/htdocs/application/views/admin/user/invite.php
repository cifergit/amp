<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/18
 * Time: 23:40
 */?>
<link rel="stylesheet" href="//www.boatsky.com/static/css/user/register.css"/>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <h1 class="page_title">验证码</h1>
        <button type="button" class="mod_btn mod_btn_primary" id="J_NewInviteCode">生成验证码</button>
        <table>
            <tr>
                <th>id</th>
                <th>验证码</th>
                <th>创建人</th>
                <th>使用人</th>
                <th>创建时间</th>
            </tr>
            <?php foreach ($inviteList->result() as $invite){?>
            <tr>
                <td><?php echo $invite->id;?></td>
                <td><?php echo $invite->invite_code;?></td>
                <td><?php echo $invite->create_user_id;?></td>
                <td><?php echo $invite->used_user_id;?></td>
                <td><?php echo $invite->create_time;?></td>
                <td><?php echo $invite->status;?></td>
            </tr>
            <?php }?>
        </table>
    </section>
</section>

<script type="text/javascript" data-main="/static/js/admin/user/invite.js?t=1" src="/static/module/require/require.js"></script>