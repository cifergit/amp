/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/12
 * Time: 22:37
 */
require.config({
    baseUrl: SERVER_ROOT,
    paths: {
        jquery: 'static/module/jquery/jquery',
        global: 'static/js/common/global'
    }
});

requirejs(['jquery','global'], function ($,global) {
    global.init();
    console.log("admin.movie.add");
    //changeGoodsTab();
    init();

    function init(){
        $('#submitBtn').on("click",function(){
            var movie_name = $.trim($("#movie_name").val());
            var movie_comment = $.trim($("#movie_comment").val());
            var admin_code = $.trim($("#admin_code").val());
            if(!movie_name){
                alert("电影名不能为空");
            }
            /*else if(!recommend_time){
             alert("推荐日期不能为空")
             }*/
            else if(!admin_code){
                alert("管理员暗号不能为空")
            }
            else {
                var requestData = {
                    "movie_name" : movie_name,
                    "movie_comment" : movie_comment,
                    "admin_code" : admin_code
                };
                $.ajax({
                    type : "POST",
                    url : SERVER_ROOT + "/admin/movie/movie_add",
                    dataType: "json",
                    data : requestData,
                    success : function(response){
                        if(response.errcode == 0){
                            alert(response.errmsg);
                            location.href = SERVER_ROOT + "/admin/movie/movie_list";
                        }
                        else {
                            alert(response.errmsg);
                        }
                    },
                    error : function(response){
                        alert("请求添加失败");
                    }
                })
            }

        });
    }
});
