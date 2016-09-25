<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/7/10
 * Time: 23:04
 */ ?>
<link rel="stylesheet" href="//www.boatsky.com/static/css/my/bookmark.css">
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <div class="my_share">
            <div class="inner">
                <h1 class="title">我的书签：</h1>
                <ol class="blog_ol" type="1">
                    <?php foreach($bookmarkList as $bookmark){?>
                        <li>
                            <a href="<?php echo $bookmark->link;?>"><?php echo $bookmark->name;?><span class="date"><?php echo $bookmark->create_time;?></span></a>
                        </li>
                    <?php }?>
                </ol>
                <button class="mod_btn mod_btn_primary mod_btn_sm new_blog_btn" id="J_ShowAlert">增加书签</button>
            </div>
        </div>
    </section>
</section>

<section class="bookmark_cover hide" id="J_BookmarkCover"></section>
<section class="bookmark_alert hide" id="J_BookmarkAlert">
    <form class="mod_form">
        <div class="mod_row mod_row_center">
            添加、编辑书签
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="name">
                    <span class="label_word">名字:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_Name" name="J_Name" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="nameMsg">111</span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="link">
                    <span class="label_word">链接:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_Link" name="J_Link" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="linkMsg"></span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="name">
                    <span class="label_word">描述:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_Desc" name="J_Desc" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="descMsg"></span>
            </div>
        </div>
        <div class="mod_row mod_row_center">
            <button type="button" class="mod_btn mod_btn_primary mod_btn_sm" id="J_SaveBookmark">保存</button>
        </div>
    </form>
</section>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/my/bookmark.js"
        src="//www.boatsky.com/static/module/require/require.js"></script>