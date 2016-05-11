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
    }

    //首页
    public function index()
    {
        $this->movie();
        //$this->blog_list();
    }

    public function movie(){
        $this->load->view('common/index');
    }

    public function blog_list(){
        $this->load->view('blog/blog_list');
    }
}