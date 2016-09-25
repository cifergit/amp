<?php
/**
 * desc:
 * User: cifer
 * Date: 2016/7/10
 * Time: 22:56
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookmark extends MY_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('bookmark/Model_bookmark');
    }

    //博客
    public function index()
    {
        //如果已经登录
        if($this->checkLogin()){
            $query = $this->Model_bookmark->findByUserId($this->uid);
            $this->render('my/bookmark',array(
                'bookmarkList'      => $query->result(),

                'head_title'    => "太空船书签",
                'head_description'  => "太空船书签",
                'head_keywords' => "太空船书签",
            ));
        }
        else {
            $this->render('user/login');
        }
    }

    public function save_bookmark(){
        if($this->checkLogin()){

            $name = get_post_value('name');
            $desc = get_post_value('desc');
            $link = get_post_value_nofilter('link');
            $dateTime = date("Y-m-d H:i:s");
            $reqData = array(
                'name' => $name,
                'link' => $link,
                'desc'     => $desc,
                'user_id'   => $this->uid,
                'update_time'  => $dateTime,
                'create_time'  => $dateTime,
                'pv'        => 0,
                'pv_my'     => 0,
            );
            $query = $this->Model_bookmark->insertBookmark($reqData);
            $ret = array(
                'errcode'   => 0,
                'errmsg'    => '修改成功',
                'data'      => $query,
            );
            echo json_encode($ret);
        }
        else {
            $this->render('user/login');
        }
    }
}