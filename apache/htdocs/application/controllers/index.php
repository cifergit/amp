<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/6
 * Time: 23:42
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('blog/Model_blog');
    }

    //首页
    public function index()
    {
        //$this->movie();
        //$this->muti_movie();
        $this->blog_list();
    }

    public function blog_list(){
        $query = $this->Model_blog->findBlogAll();
        $this->render('blog/blog_list',array(
            'query' => $query,
            'head_title'            => $this->config->item('seo_blog')['head_title'],
            'head_description'      => $this->config->item('seo_blog')['head_description'],
            'head_keywords'         => $this->config->item('seo_blog')['head_keywords'],
        ));
    }

    public function movie(){
        $today = date("j");
        $todayId = $this->getMovieId($today);
        $movieQuery = $this->db->query('select * from t_movie where id = '.$todayId);
        $this->render('common/index',array(
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

    /*public function blog_list(){
        $this->render('blog/blog_list');
    }*/

    public function muti_movie()
    {
        $today = date("j");
        $yesterday = date("j",strtotime("-1 day"));
        $beforeYesterday = date("j",strtotime("-2 day"));
        $todayId = $this->getMovieId($today);
        $yesterdayId = $this->getMovieId($yesterday);
        $beforeYesterdayId = $this->getMovieId($beforeYesterday);;
        $movieQuery = $this->db->query('select * from t_movie where id = '.$todayId.' or id = '.$yesterdayId.' or id = '.$beforeYesterdayId);
        $arrMovieTemp = array();
        $arrMovie = array();
        $arrDay = [$todayId,$yesterdayId,$beforeYesterdayId];
        foreach ($movieQuery->result() as $row){
            $arrMovieTemp[] = $row;
        }
        //排序
        for($i = 0;$i < count($arrDay);$i++){
            for($j = 0;$j < count($arrMovieTemp);$j++){
                if($arrDay[$i] == $arrMovieTemp[$j]->id){
                    $arrMovie[] = $arrMovieTemp[$j];
                }
            }
        }
        $this->render('movie/index',array(
            'arrMovie'    => $arrMovie,
        ));
    }
}