<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/7
 * Time: 9:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //电影
    public function index()
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
        $this->load->view('movie/index',array(
            'arrMovie'    => $arrMovie,
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

}