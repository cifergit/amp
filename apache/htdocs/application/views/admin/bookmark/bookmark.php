<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/7/10
 * Time: 23:04
 */ ?>
<link rel="stylesheet" href="//www.boatsky.com/static/css/admin/bookmark/bookmark.css">
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">
        <table class="bookmark_class_table">
            <tbody>
        <?php foreach($bookmarkClassArr as $bookmarkClass){?>
            <tr class="bookmark_class_tr">
                <td><?php echo $bookmarkClass->id;?></td>
                <td><?php echo $bookmarkClass->name;?></td>
                <td><?php echo $bookmarkClass->desc;?></td>
                <td><?php if($bookmarkClass->status == 1){echo '已上线';}else {echo '已下线';};?></td>
                <td><button type="button" class="mod_btn mod_btn_primary mod_btn_sm bookmark_class_edit J_BookmarkClassEdit" data-class_id="<?php echo $bookmarkClass->id;?>">编辑</button></td>
            </tr>

            <?php foreach($bookmarkArr as $bookmark){?>
                <?php if($bookmark->bookmark_class_id == $bookmarkClass->id){?>
                    <tr>
                        <td></td>
                        <td><?php echo $bookmark->id;?></td>
                        <td><?php echo $bookmark->name;?></td>
                        <td><?php echo $bookmark->desc;?></td>
                        <td><?php echo $bookmark->link;?></td>
                        <td><?php echo $bookmark->icon_link;?></td>
                        <td><?php if($bookmark->status == 1){echo '已上线';}else {echo '已下线';};?></td>
                        <td><button type="button" class="mod_btn mod_btn_primary mod_btn_sm bookmark_class_edit J_BookmarkEdit" data-id="<?php echo $bookmark->id;?>">编辑</button></td>
                    </tr>
                <?php }?>
            <?php }?>
        <?php }?>

            </tbody>
        </table>

        <button class="mod_btn mod_btn_primary mod_btn_md new_blog_btn" id="J_ShowAlert">增加书签</button>
        <button class="mod_btn mod_btn_primary mod_btn_md new_blog_btn" id="J_ShowClassAlert">增加书签分类</button>
    </section>
</section>

<section class="bookmark_cover hide" id="J_BookmarkCover"></section>
<section class="bookmark_alert hide" id="J_BookmarkAlert">
    <i class="icon_global icon_delete J_IconDelete">x</i>
    <form class="mod_form">
        <div class="mod_row mod_row_center">
            添加、编辑书签
        </div>
        <input type="hidden" id="J_Id" name="J_Id" value=""/>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_BookmarkClassId">
                    <span class="label_word">分类:</span>
                </label>
                <select id="J_BookmarkClassId" name="J_BookmarkClassId">
                    <?php $bookmarkClassIndex = 0;?>
                    <?php foreach($bookmarkClassArr as $bookmarkClass){?>
                        <option value="<?php echo $bookmarkClass->id;?>" <?php if($bookmarkClassIndex == 0){echo 'selected="selected"';}?>><?php echo $bookmarkClass->name;?></option>
                        <?php $bookmarkClassIndex++;?>
                    <?php }?>

                </select>
            </div>
            <div class="mod_msg">
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="name">
                    <span class="label_word">名字:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_Name" name="J_Name" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="J_NameMsg"></span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_Link">
                    <span class="label_word">链接:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_Link" name="J_Link" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="J_LinkMsg"></span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_IconLink">
                    <span class="label_word">icon链接:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_IconLink" name="J_IconLink" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="J_IconLinkMsg"></span>
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
                <span class="msg_word" id="J_DescMsg"></span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_Status">
                    <span class="label_word">状态:</span>
                </label>
                <select id="J_Status" name="J_Status">
                    <option value="1" selected="selected">上线</option>
                    <option value="0">下线</option>
                </select>
            </div>
            <div class="mod_msg">
            </div>
        </div>
        <div class="mod_row mod_row_center">
            <button type="button" class="mod_btn mod_btn_primary mod_btn_sm" id="J_SaveBookmark">保存</button>
        </div>
    </form>
</section>

<section class="bookmark_alert hide" id="J_BookmarkClassAlert">
    <i class="icon_global icon_delete J_IconDelete">x</i>
    <form class="mod_form">
        <div class="mod_row mod_row_center">
            添加、编辑书签分类
        </div>
        <input type="hidden" id="J_ClassId" name="J_ClassId" value=""/>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_ClassName">
                    <span class="label_word">分类名字:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_ClassName" name="J_ClassName" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="J_ClassNameMsg"></span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_ClassDesc">
                    <span class="label_word">描述:</span>
                </label>
                <input class="mod_form_item" type="text" id="J_ClassDesc" name="J_ClassDesc" placeholder="名字">
            </div>
            <div class="mod_msg">
                <span class="msg_word" id="J_ClassDescMsg"></span>
            </div>
        </div>
        <div class="mod_row">
            <div class="mod_content">
                <label class="mod_label" for="J_ClassStatus">
                    <span class="label_word">状态:</span>
                </label>
                <select id="J_ClassStatus" name="J_ClassStatus">
                    <option value="1" selected="selected">上线</option>
                    <option value="0">下线</option>
                </select>
            </div>
            <div class="mod_msg">
            </div>
        </div>
        <div class="mod_row mod_row_center">
            <button type="button" class="mod_btn mod_btn_primary mod_btn_sm" id="J_SaveBookmarkClass">保存</button>
        </div>
    </form>
</section>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/admin/bookmark/bookmark.js"
        src="//www.boatsky.com/static/module/require/require.js"></script>