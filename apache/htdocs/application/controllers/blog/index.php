<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/7
 * Time: 9:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {


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

    //正则表达式
    public function regexp() {
        $this->load->view('blog/regexp');
    }

    //如何用正确的姿势写HTML
    public function html_write() {
        $this->render('blog/html_write',array(
            'head_title'    => '如何用正确的姿势写HTML',
            'head_description'  => '介绍HTML的正确写法',
            'head_keywords' => '怎么编写HTML，HTML该怎么写，正确的HTML写法',
        ));
    }
}