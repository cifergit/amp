/**
 * @desc
 * @author cifer
 * @date 2016/5/23
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global',
        mod_product: 'robot/js/product/mod_product',
        animateBackground_plugin : 'robot/js/common/animateBackground_plugin'
    }
});


requirejs(['jquery','global','mod_product','animateBackground_plugin'], function ($,global,mod_product,animateBackground_plugin) {
    global.init();
    animateBackground_plugin.init();
    mod_product.init();
    scrollNumInvest();
    scrollNumCredit();
    scrollNumInstallment();
    scrollNumLease();
    function scrollNumInvest(){
        var random = 0;
        for(var j = 550;j < 615;j = j + random){
            random = parseInt(20*Math.random()) + 1;
            if(j > 594){
                j = 615;
            }
            show_scroll_num(j,'.js_scroll_num_invest');
        }
    }
    function scrollNumCredit(){
        var random = parseInt(50*Math.random()) + 1;
        for(var j = 701;j < 821;j = j + random){
            random = parseInt(50*Math.random()) + 1;
            if(j > 770){
                j = 821;
            }
            show_scroll_num(j,'.js_scroll_num_credit');
        }
    }
    function scrollNumInstallment(){
        var random = parseInt(30*Math.random()) + 1;
        for(var j = 300;j < 346;j = j + random){
            random = parseInt(10*Math.random()) + 1;
            if(j > 335){
                j = 346;
            }
            show_scroll_num(j,'.js_scroll_num_installment');
        }
    }
    function scrollNumLease(){
        var random = parseInt(600*Math.random()) + 1;
        for(var j = 7500;j < 9952;j = j + random){
            random = parseInt(500*Math.random()) + 1;
            if(j > 9400){
                j = 9952;
            }
            show_scroll_num(j,'.js_scroll_num_lease');

        }
    }
    function show_scroll_num(n,dom){
        var it = $(dom+" i");
        var len = String(n).length;
        for(var i = 0;i < len;i++){
            if(it.length <= i){
                $(dom).append("<i></i>");
            }
            var num=String(n).charAt(i);
            var y = -parseInt(num)*30; //y轴位置
            var obj = $(dom+" i").eq(i);
            obj.animate({ //滚动动画
                    backgroundPosition :'(0 '+String(y)+'px)'
                }, 'slow','swing',function(){}
            );
        }
    }
});
