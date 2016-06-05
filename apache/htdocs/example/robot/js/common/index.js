/**
 * @desc
 * @author cifer
 * @date 2016/5/03
 */
if(!(typeof(resourceUrl) != 'undefined' && resourceUrl)){
    resourceUrl = 'http://nres.ingdan.com/';
}
require.config({
    baseUrl: resourceUrl,
    paths: {
        jquery: 'robot/modules/jquery/jquery',
        global: 'robot/js/common/global',
        slider: 'robot/js/common/slider'
    }
});

requirejs(['jquery','global','slider'], function ($,global,slider) {
    global.init();

    // 整体轮播
    slider.init({
        auto:false,
        width:1190,
        className: "cur",
        prevId:"sliderPrvBtn",
        nextId:"sliderNextBtn",
        effect:"scrollx",
        titleId:"bannerTab",
        contentId:"sliderList",
        titleTag:"li",
        contentTag:"li"
    });

    //应用
    slider.init({
        auto:false,
        width:1190,
        className: "cur",
        prevId:"sliderPrvBtn2",
        nextId:"sliderNextBtn2",
        effect:"scrollx",
        titleId:"bannerTab2",
        contentId:"sliderList2",
        titleTag:"li",
        contentTag:"li"
    });

    //方案
    slider.init({
        auto:false,
        width:1190,
        className: "cur",
        prevId:"sliderPrvBtn3",
        nextId:"sliderNextBtn3",
        effect:"scrollx",
        titleId:"bannerTab3",
        contentId:"sliderList3",
        titleTag:"li",
        contentTag:"li"
    });

    //零件
    slider.init({
        auto:false,
        width:1190,
        className: "cur",
        prevId:"sliderPrvBtn4",
        nextId:"sliderNextBtn4",
        effect:"scrollx",
        titleId:"bannerTab4",
        contentId:"sliderList4",
        titleTag:"li",
        contentTag:"li"
    });

    //headScroll();
    //首页头部滚动事件
    /*function headScroll() {
        window.onscroll = function(){
            var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
            if(scrollTop > 0){
                $(".header").removeClass("index_header");
                $("body").removeClass("body_index_header");
            }
            else {
                $(".header").addClass("index_header");
                $("body").addClass("body_index_header");
            }
        }

    }*/
    changeTab();
    function changeTab(){
        $(".js_news_item").on("click",function(){
            var cur = $.trim($(this).data('cur'));
            if(cur){
                $(this).parents('.news_wrap').attr('class','news_wrap ' + cur)
            }
        });
        $(".js_product_item").on("click",function(){
            var cur = $.trim($(this).data('cur'));
            if(cur){
                $(this).parents('.product_wrap').attr('class','product_wrap ' + cur)
            }
        });
    }

});
