/**
 * @desc 产品首页
 * @author cifer
 * @date 2016-05-03
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global',
        mod_product: 'robot/js/product/mod_product'
    }
});


requirejs(['jquery','global','mod_product'], function ($,global,mod_product) {
    global.init();
    mod_product.init();
});
