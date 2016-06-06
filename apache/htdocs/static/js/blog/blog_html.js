/**
 * Created by cifer on 2016/6/7.
 */
/**
 * Created by cifer on 2016/5/7.
 */
require.config({
    baseUrl: baseUrl,
    paths: {
        jquery: 'module/jquery/jquery',
        global: 'js/common/global'
    }
});


requirejs(['jquery','global'], function ($,global) {
    global.init();
    console.log("blog html");
});

