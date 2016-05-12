<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/12
 * Time: 22:01
 * Desc: movie admin
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //电影列表
    public function movie_list(){
        $movieQuery = $this->db->query('select * from t_movie order by id desc');
        $this->load->view('admin/movie/movie_list',array(
            'movieQuery'    => $movieQuery,
        ));
    }

    //新增电影
    public function movie_new(){
        $this->load->view('admin/movie/movie_new',array(
        ));
    }

    //用ajax添加电影
    public function movie_add(){
        $admin_default_code = "11";
        $admin_code = $_POST["admin_code"];
        $strMovieName = $_POST["movie_name"];
        $ret = array(
            "errcode" => 0,
            "errmsg" => '电影《'.$strMovieName.'》添加成功',
        );
        if($admin_code != $admin_default_code){
            $ret = array(
                "errcode" => 403,
                "errmsg" => "你还不是管理员哦",
            );
        }
        else {
            $strMovieComment = $_POST["movie_comment"];
            $movieFindNameQuery = $this->db->query('select * from t_movie where name = "'.$strMovieName.'"');
            if($movieFindNameQuery->num_rows() > 0){
                $ret = array(
                    "errcode" => 402,
                    "errmsg" => "电影《".$strMovieName."》已经存在",
                );
            }
            else {
                date_default_timezone_set('PRC');
                $dateTime = date("Y-m-d H:i:s");
                //$insertSql = 'insert into t_movie (name,movie_point,create_time,user_id,pv) values(?,?,?,?,?)';
                //$this->db->insert($insertSql,array($strMovieName,$strMovieComment,now(),1,1));
                $insertData = array(
                    'name' => $strMovieName,
                    'movie_point' => $strMovieComment,
                    'create_time' => $dateTime,
                    'user_id' => 1,
                    'pv' => 1);
                $insertBool = $this->db->insert('t_movie', $insertData);
                if(!$insertBool){
                    $ret = array(
                        "errcode" => 500,
                        "errmsg" => "系统错误，插入失败！",
                    );
                }
            }
        }
        echo json_encode($ret);
    }

}