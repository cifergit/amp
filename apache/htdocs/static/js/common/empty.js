
/**
 * Created by cifer on 2016/6/11.
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

});
