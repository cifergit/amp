/**
 * @desc 新闻中心
 * @author cifer
 * @date 2016-05-30
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global'
    }
});

requirejs(['jquery','global'], function ($,global) {
    global.init();

    init();

    function init(){
        $('.js_top_pic_point').on('click',function(){
            var cur = $.trim($(this).data('cur'));
            if(cur){
                $('#newsHeadWrap').attr('class','head_wrap cur_top_'+cur);
            }
        });
        $('.js_top_news_item').hover(function(){
            var cur = $.trim($(this).data('cur'));
            if(cur){
                $('#newsHeadWrap').attr('class','head_wrap cur_top_'+cur);
            }
        });
    }
});

