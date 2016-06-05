<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/16
 * Time: 23:08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->model('user/Model_user');
    }

    //首页
    public function index()
    {
        $reqData = array(
            'name' => '1',
            'email'     => '123@qq.com',
            'password' => '1',
            'invite_code' => 'xxx',
            'error_number'  => 0,
            'score'     => 0,
            'status'    => 0,
        );
        $this->load->view('user/register');
        return;
        $userBoolean = $this->Model_user->addUser($reqData);
        echo json_encode($userBoolean);
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