<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/6
 * Time: 23:42
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //首页
    public function index()
    {
        $this->movie();
        //$this->blog_list();
    }

    public function movie(){

        $today = date("j");
        $todayId = $this->getMovieId($today);
        $movieQuery = $this->db->query('select * from t_movie where id = '.$todayId);
        $this->load->view('common/index',array(
            'movieQuery'    => $movieQuery,
        ));
    }

    //用日期的天得到电影ID
    private function getMovieId($day){
        $min_movie_index = 1;
        $max_movie_index = 30;
        if($max_movie_index <= 31){
            $today_movie_index = $day%$max_movie_index+1;
        }
        else {
            $today_movie_index = $max_movie_index%$day+1;
        }
        return $today_movie_index;
    }

    public function blog_list(){
        $this->load->view('blog/blog_list');
    }
}