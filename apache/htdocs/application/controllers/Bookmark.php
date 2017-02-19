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
            'head_title'            => $this->config->item('seo_bookmark')['head_title'],
            'head_description'      => $this->config->item('seo_bookmark')['head_description'],
            'head_keywords'         => $this->config->item('seo_bookmark')['head_keywords'],
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