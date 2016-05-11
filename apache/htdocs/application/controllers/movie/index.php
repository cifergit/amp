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
    }

    //博客
    public function index()
    {
        $this->blog_list();
    }

    //博客列表页
    public function blog_list(){
        $this->load->view('blog/blog_list');
    }
}