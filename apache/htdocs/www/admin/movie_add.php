<?php
/**
 * desc:
 * User: cifer
 * DateTime: 2016/1/19
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
    $strMovieComment = $_POST["movie_comment"];
    /*$ret["moiveMessage"] = array(
        "strMovieName"  => $strMovieName,
        "strMovieComment"   => $strMovieComment,
        "tRecommendTime"    => $timeRecommendTime,
    );*/

    //查找电影名字是否重复
    try {
        $dbh = new PDO($db_mysql_connect, $db_user, $db_password);
        $dbh->query("SET NAMES 'utf8'");
        $sql = "select * from t_movie where name = '$strMovieName'";
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
            date_default_timezone_set('PRC');
            $str_today = date("Y-m-d H:i:s");
            $dbh->query("SET NAMES 'utf8'");
            $sqlInset = "insert into t_movie (name,movie_point,create_time,user_id,pv) values('$strMovieName','$strMovieComment',now(),1,1)";
            try {
                $row = $dbh->exec($sqlInset);

                $ret = array(
                    "errcode" => 0,
                    "errmsg" => $dbh->errorInfo(),
                );
            }
            catch(PDOException $sertE){
                $ret = array(
                    "errcode" => 403,
                    "errmsg" => $sertE->getMessage(),
                );
            }
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