<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/7
 * Time: 9:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {


    function __construct() {
        parent::__construct();
        $this->load->model('blog/Model_blog');
    }

    //博客
    public function index($id = 0)
    {
        if(empty($id)){
            $this->blog_list();
        }
        else {
            $query = $this->Model_blog->findBlogById($id);
            $this->render('blog/detail',array(
                'blog' => $query->row(),
            ));
        }
    }

    //博客列表页
    public function blog_list(){
        $query = $this->Model_blog->findBlogAll();
        $this->render('blog/blog_home',array(
            'query' => $query
        ));
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

    //新建博客
    public function blog_new() {
        $this->render('blog/blog_new');
    }

    //打开博客编辑页
    public function edit($id = 0) {
        $query = $this->Model_blog->findBlogById($id);
        $this->render('blog/blog_edit',array(
            'blog' => $query->row(),
        ));
    }

    //编辑博客
    public function blog_edit(){
        $id = get_post_value('id');
        $title = get_post_value('title');
        $desc = get_post_value('desc');
        $content = get_post_value_nofilter('content');
        $html_desc = get_post_value('html_desc');
        $html_key = get_post_value('html_key');
        $dateTime = date("Y-m-d H:i:s");
        $reqData = array(
            'title' => $title,
            'desc'     => $desc,
            'content' => $content,
            'html_desc' => $html_desc,
            'html_key'   => $html_key,
            'update_time'  => $dateTime,
        );
        $ret = array(
            'errcode'   => -1,
            'errmsg'    => '修改失败',
        );
        if($id){
            $query = $this->Model_blog->updateBlog($id,$reqData);
            if($query){
                $ret = array(
                    'errcode'   => 0,
                    'errmsg'    => '修改成功',
                    'data'      => $query,
                );
            }
        }
        echo json_encode($ret);
    }

    function changeHtml($content){
        $content = str_replace(' &nbsp;','@@@#@@',$content);

        $content = str_replace('&nbsp;',' ',$content);

        $content = str_replace('@@@#@@',' &nbsp;',$content);
        return $content;
    }

    function kindhtml($html,$jc='j'){
        if($jc=='j'){
            $html = str_replace('&nbsp;', '&amp;nbsp;', $html);
            $html = str_replace('&gt;', '&amp;gt;', $html);
            $html = str_replace('&lt;', '&amp;lt;', $html);
        }
        //仅用在非kindeditor文本编辑器页面使用，因为kindeditor文本编辑器会自动执行下面这类转换
        if($jc=='c'){
            $html = str_replace('&nbsp;', '&amp;nbsp;', $html);
            $html = str_replace('&gt;', '&amp;gt;', $html);
            $html = str_replace('&lt;', '&amp;lt;', $html);
        }
    }

    public function blog_add() {
        $title = get_post_value('title');
        $desc = get_post_value('desc');
        $content = get_post_value('content');
        $html_desc = get_post_value('html_desc');
        $html_key = get_post_value('html_key');
        $dateTime = date("Y-m-d H:i:s");
        $reqData = array(
            'title' => $title,
            'desc'     => $desc,
            'content' => $content,
            'html_desc' => $html_desc,
            'html_key'   => $html_key,
            'update_time'  => $dateTime,
            'create_time'  => $dateTime,
            'pv'     => 0,
        );
        $blogId = $this->Model_blog->insertBlog($reqData);
        if(!empty($blogId)){
            $ret = array(
                'errcode'   => 0,
                'errmsg'    => '提交成功',
                'data'      => $blogId,
            );
        }
        else {
            $ret = array(
                'errcode'   => -1,
                'errmsg'    => '提交失败',
            );
        }
        echo json_encode($ret);
    }
}