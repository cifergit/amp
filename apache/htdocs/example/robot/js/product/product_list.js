/**
 * @desc 产品列表
 * @author cifer
 * @date 2016-05-21
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
    console.log("product_search");
    init();
    function init() {
        $('.js_icon_delete').on('click',function(){
            var type = $(this).data('type');
            var id = $(this).data('id');
            if(type && id){
                var thisHref = window.location.href;
                var strSearchItem = type + '-' + id + '/';
                if(type == 'fid' && $.trim($('#firstClassId').val())){
                    thisHref = thisHref.replace(strSearchItem,'fid-' +$.trim($('#firstClassId').val()) + '/');
                }
                else {
                    thisHref = thisHref.replace(strSearchItem,'');
                }
                window.location.href = thisHref;
            }
        });
    }
});
