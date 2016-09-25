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
        $this->load->model('bookmark/Model_bookmark');
    }

    //书签
    public function index()
    {
        $query = $this->Model_bookmark->findAllOnlineBookmark();
        $queryClass = $this->Model_bookmark->findAllOnlineBookmarkClass();
        $this->render('bookmark/bookmark',array(
            'bookmarkArr'       => $query->result(),
            'bookmarkClassArr'      => $queryClass->result(),
            'head_title'            => "太空船书签",
            'head_description'      => "太空船书签",
            'head_keywords'         => "太空船书签,前端书签，前端框架大全，前端团队，常用工具，前端导航，网站导航",
        ));
    }

    //增加点击
    public function add_bookmark_pv(){
        $id = get_post_valueI('id');
        $query = $this->Model_bookmark->addBookmarkPvById($id);
        if($query){
            $ret = array(
                'code'   => 0,
                'msg'    => '增加点击成功！',
                'data'      => $query,
            );
        }
        else {
            $ret = array(
                'code'   => -1,
                'msg'    => '增加点击失败！',
                'data'   => $query,
            );
        }
        echo json_encode($ret);
    }
}