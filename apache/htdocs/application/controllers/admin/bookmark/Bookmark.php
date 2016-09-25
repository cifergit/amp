<?php
/**
 * desc: public bookmark
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
            $query = $this->Model_bookmark->findAllBookmark();
            $queryClass = $this->Model_bookmark->findAllBookmarkClass();
            $this->render('admin/bookmark/bookmark',array(
                'bookmarkArr'       => $query->result(),
                'bookmarkClassArr'      => $queryClass->result(),
                'head_title'            => "太空船书签",
                'head_description'      => "太空船书签",
                'head_keywords'         => "太空船书签",
            ));
        }
        else {
            $this->render('user/login');
        }
    }

    public function save_bookmark(){
        if($this->checkLogin()){
            $id = get_post_valueI('id');
            $name = get_post_value('name');
            $link = get_post_value('link');
            $iconLink = get_post_value('icon_link');
            $desc = get_post_value('desc');
            $bookmarkClassId = get_post_valueI('bookmark_class_id');
            $status = get_post_valueI('status');
            $dateTime = date("Y-m-d H:i:s");
            $reqData = array(
                'name'              => $name,
                'link'              => $link,
                'icon_link'         => $iconLink,
                'desc'              => $desc,
                'user_id'           => $this->uid,
                'bookmark_class_id' => $bookmarkClassId,
                'status'            => $status,
                'update_time'       => $dateTime,
                'create_time'       => $dateTime,
                'pv'                => 0,
            );
            //存在则更新
            if($id){
                $query = $this->Model_bookmark->updateBookmark($id, $reqData);
            }
            else {
                $query = $this->Model_bookmark->insertBookmark($reqData);
            }
            if($query){
                $ret = array(
                    'code'   => 0,
                    'msg'    => '保存标签成功！',
                    'data'      => $query,
                );
            }
            else {
                $ret = array(
                    'code'   => -1,
                    'msg'    => '保存标签失败！',
                    'data'   => $query,
                );
            }
            echo json_encode($ret);
        }
        else {
            $this->render('user/login');
        }
    }

    public function save_bookmark_class(){
        if($this->checkLogin()){
            $id = get_post_valueI('id');
            $name = get_post_value('name');
            $desc = get_post_value('desc');
            $status = get_post_valueI('status');
            $dateTime = date("Y-m-d H:i:s");
            $reqData = array(
                'name'      => $name,
                'desc'      => $desc,
                'user_id'   => $this->uid,
                'status'    => $status,
                'update_time'  => $dateTime,
                'create_time'  => $dateTime,
                'pv'        => 0,
            );
            //存在则更新
            if($id){
                $query = $this->Model_bookmark->updateBookmarkClass($id, $reqData);
            }
            else {
                $query = $this->Model_bookmark->insertBookmarkClass($reqData);
            }
            if($query){
                $ret = array(
                    'code'   => 0,
                    'msg'    => '保存标签分类成功！',
                    'data'      => $query,
                );
            }
            else {
                $ret = array(
                    'code'   => -1,
                    'msg'    => '保存标签分类失败！',
                    'data'   => $query,
                );
            }
            echo json_encode($ret);
        }
        else {
            $this->render('user/login');
        }
    }

    //获取单个标签分类
    public function get_bookmark_class(){
        if($this->checkLogin()){
            $id = get_post_value('id');
            //存在则更新
            if($id){
                $query = $this->Model_bookmark->getBookmarkClassById($id);
            }

            if($query->num_rows() == 1){
                $ret = array(
                    'code'   => 0,
                    'msg'    => '获取标签分类成功！',
                    'data'      => $query->row_array(),
                );
            }
            else {
                $ret = array(
                    'code'   => -1,
                    'msg'    => '获取标签分类失败！',
                    'data'   => $query,
                );
            }
            echo json_encode($ret);
        }
        else {
            $this->render('user/login');
        }
    }

    //获取单个标签
    public function get_bookmark(){
        if($this->checkLogin()){
            $id = get_post_value('id');
            //存在则更新
            if($id){
                $query = $this->Model_bookmark->getBookmarkById($id);
            }

            if($query->num_rows() == 1){
                $ret = array(
                    'code'   => 0,
                    'msg'    => '获取标签分类成功！',
                    'data'      => $query->row_array(),
                );
            }
            else {
                $ret = array(
                    'code'   => -1,
                    'msg'    => '获取标签分类失败！',
                    'data'   => $query,
                );
            }
            echo json_encode($ret);
        }
        else {
            $this->render('user/login');
        }
    }
}