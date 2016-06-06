<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/6/5
 * Time: 22:29
 */
?>
<!DOCTYPE html>
<html>
<head lang="zh-cmn-Hans">
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="<?php echo $head_title;?>">
    <title><?php echo $head_title;?></title>
    <meta name="description" content="<?php echo $head_description;?>" />
    <meta name="keywords" content="<?php echo $head_keywords;?>" />
    <meta name="author" content="cifer" />
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <script>
        var globalMess = {};
        SERVER_ROOT = '<?php echo SERVER_ROOT;?>';
        if(typeof(SERVER_ROOT) != 'undefined' && SERVER_ROOT){
        }
        else {
            SERVER_ROOT ='//www.boatsky.com';
        }

        baseUrl = '<?php echo SERVER_ROOT;?>/static';
        if(typeof(baseUrl) != 'undefined' && baseUrl){
        }
        else {
            baseUrl ='//www.boatsky.com/static';
        }
    </script>