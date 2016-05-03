$(document).ready(function(){
    pageInit();
    function pageInit() {
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
                    url : server_root+"admin/movie_add.php",
                    dataType: "json",
                    data : requestData,
                    success : function(response){
                        if(response.errcode == 0){
                            alert(response.errmsg);
                        }
                        else {
                            alert(response.errmsg);
                        }
                    },
                    error : function(response){
                       alert("添加失败");
                    }
                })
            }

        });
    }
});
