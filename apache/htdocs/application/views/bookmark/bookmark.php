<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/7/10
 * Time: 23:04
 */ ?>
<link rel="stylesheet" href="//www.boatsky.com/static/css/bookmark/bookmark.css">
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <section class="mod_inner">

        <table class="bookmark_class_table">
            <tbody>
            <?php foreach($bookmarkClassArr as $bookmarkClass){?>
                <tr class="bookmark_class_tr">
                    <td><?php echo $bookmarkClass->name;?></td>
                </tr>

                <?php foreach($bookmarkArr as $bookmark){?>
                    <?php if($bookmark->bookmark_class_id == $bookmarkClass->id){?>
                        <tr>
                            <td></td>
                            <td><a class="bookmark_a J_BookmarkA" data-id="<?php echo $bookmark->id;?>" href="<?php echo $bookmark->link;?>" target="_blank"><img class="site_icon" src="<?php if($bookmark->icon_link){echo $bookmark->icon_link;}else {echo 'http://www.boatsky.com/favicon.ico';};?>"/><span class="bookmark_name"><?php echo $bookmark->name;?></span><span class="bookmark_link"><?php echo $bookmark->link;?></span></a></td>
                        </tr>
                    <?php }?>
                <?php }?>
            <?php }?>
            </tbody>
        </table>

    </section>
</section>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/bookmark/bookmark.js"
        src="//www.boatsky.com/static/module/require/require.js"></script>