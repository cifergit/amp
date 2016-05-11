/**
 * Created by cifer on 2016/5/7.
 */
require.config({
    baseUrl: '//www.boatsky.com',
    paths: {
        jquery: 'module/jquery/jquery',
        global: 'js/common/global'
    }
});


requirejs(['jquery','global'], function ($,global) {
    global.init();
    console.log("blog list");
    //changeGoodsTab();

    function changeGoodsTab() {
        $(".goods_li").on("click",function(){
            $(this).addClass("active").siblings().removeClass("active");
            var wrap = $(this).data("wrap");
            console.log(wrap);
            if(wrap){
                $(wrap).removeClass("hide").siblings().addClass("hide");
            }
        });
    }

    //baseFormValidate();
    function baseFormValidate(){
        $("#goodsName").on("blur",function(){
            if(!$(this).val()){
                $(this).parents(".form-group").addClass("has-error");
            }
            else {
                $(this).parents(".form-group").removeClass("has-error");
            }
        });
        $("#goodsDesc").on("blur",function(){
            if(!$(this).val()){
                $(this).parents(".form-group").addClass("has-error");
            }
            else {
                $(this).parents(".form-group").removeClass("has-error");
            }
        });
        $("#goodsSalesPrice").on("blur",function(){
            if(!$(this).val()){
                $(this).parents(".form-group").addClass("has-error");
            }
            else {
                $(this).parents(".form-group").removeClass("has-error");
            }
        });
        $("#goodsMarketPrice").on("blur",function(){
            if(!$(this).val()){
                $(this).parents(".form-group").addClass("has-error");
            }
            else {
                $(this).parents(".form-group").removeClass("has-error");
            }
        });
    }
});
