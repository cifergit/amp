/**
 * author: cifer
 * DateTime: 2015/3/24 0:15
 */
$(document).ready(function(){
    $('#headerNav > li').on("click",function(){
        $('.header_li').removeClass("active");
        if($(this).hasClass("header_li")){
            $(this).addClass("active");
        }
    });
});
