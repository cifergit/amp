<?php
/**
 * desc: 
 * User: cifer 
 * DateTime: 2016/1/7 23:25
 */
include "../../config/common/database.php";
$admin_default_code = "11";
$admin_code = $_POST["admin_code"];
$ret = array(
    "errcode" => 0,
    "errmsg" => "请求成功",
);
if($admin_code != $admin_default_code){
    $ret = array(
        "errcode" => 403,
        "errmsg" => "你还不是管理员哦",
    );
    echo json_encode($ret);
}
else {
    $strMovieName = $_POST["movie_name"];
    $strMovieName = "大";
    $strMovieComment = $_POST["movie_comment"];
    $timeRecommendTime = $_POST["recommend_time"];
    /*$ret["moiveMessage"] = array(
        "strMovieName"  => $strMovieName,
        "strMovieComment"   => $strMovieComment,
        "tRecommendTime"    => $timeRecommendTime,
    );*/

    //查找电影名字是否重复
    try {
        $dbh = new PDO($db_mysql_connect, $db_user, $db_password);
        $dbh->query("SET NAMES 'utf8'");
        $sql = "select * from t_movie_day_recommend where name = '$strMovieName'";
        $rs = $dbh->query($sql);
        $boolSameMovie = false;
        if(!empty($rs)){
            foreach($rs as $sameNameMovie){
                if(!empty($sameNameMovie)){
                    $boolSameMovie = true;

                }
            }
        }
        if(!$boolSameMovie){
            $ret = array(
                "errcode" => 401,
                "errmsg" => "电影不存在",
            );
        }
        else {
            $ret = array(
                "errcode" => 402,
                "errmsg" => "电影《".$strMovieName."》已经存在",
            );
        }
    }
    catch (PDOException $e){
        $ret = array(
            "errcode" => 404,
            "errmsg" => "数据库连接失败".$e->getMessage(),
        );
    }
    //查找日期是否重复
    echo json_encode($ret);
}
