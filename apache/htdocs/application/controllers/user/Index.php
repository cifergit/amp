<?php
/**
 * desc: user index
 * User: cifer
 * Date: 2016/6/11
 * Time: 0:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends My_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //首页
    public function index()
    {
        //如果已经登录
        if($this->checkLogin()){
            $this->render('user/main');
        }
        else {
            $this->render('user/login');
        }
    }
}