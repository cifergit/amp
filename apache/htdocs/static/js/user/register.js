/**
 * Created by cifer on 2016/5/18.
 */
require.config({
    baseUrl: '//www.boatsky.com/static',
    paths: {
        jquery: 'module/jquery/jquery',
        global: 'js/common/global'
    }
});


requirejs(['jquery','global'], function ($,global) {
    global.init();
    console.log("register");
    $('#registerBtn').on('click',function(){
       alert('邀请码不正确，敬请关注邀请码释放');
    });
    //changeGoodsTab();
});

