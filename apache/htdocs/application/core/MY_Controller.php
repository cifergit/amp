<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2016/06/05
 * Time: 22:47
 */

class MY_Controller extends CI_Controller
{
    private $_data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('user/Model_user');
    }

    /**
     *  PC端加载view页面
     * @param  string $page   [description]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    protected function render($page = 'index', $params = array()) {
        $this->_data = array_merge($this->_data, $params);
        $this->_data['head_title'] = isset($params['head_title']) ? $params['head_title'] : '太空船-电影推荐网';
        $this->_data['head_description'] = isset($params['head_description']) ? $params['head_description'] : '推荐最值的看的电影，太空船推荐，必属精品！';
        $this->_data['head_keywords'] = isset($params['head_keywords']) ? $params['head_keywords'] : '太空船，电影推荐网，电影排行榜，太空船网，太空船电影，太空船电影网，太空船电影推荐，电影推荐，电影评分，电影分享';
        $this->checkLogin();
        $this->_data['uid'] = get_cookie('uid');
        $this->_data['uname'] = urldecode(get_cookie('uname'));
        $this->_data['ukey'] = get_cookie('ukey');
        $this->load->view('common/head', $this->_data);
        $this->load->view($page, $this->_data);
        $this->load->view('common/foot', $this->_data);
    }

    protected function checkLogin(){
        $is_login = false;
        $uid = get_cookie('uid');
        $uname = urldecode(get_cookie('uname'));
        $ukey = get_cookie('ukey');
        if(!empty($uid) && !empty($uname) && !empty($ukey)){
            $query = $this->Model_user->checkLogin((int)$uid, $ukey);
            if($query->row()){
                $this->_data['user'] = $query->row();
                $is_login = true;
            }
            else {
                delete_cookie('uid');
                delete_cookie('uname');
                delete_cookie('ukey');
            }
        }
        else {
            delete_cookie('uid');
            delete_cookie('uname');
            delete_cookie('ukey');
        }
        return $is_login;
    }

    protected function checkOnline(){
        $is_login = false;
        $uid = get_cookie('uid');
        $uname = urldecode(get_cookie('uname'));
        $ukey = get_cookie('ukey');
        if(!empty($uid) && !empty($uname) && !empty($ukey)){
            $query = $this->Model_user->checkLogin((int)$uid, $ukey);
            if($query->row()){
                $this->_data['user'] = $query->row();
                $is_login = true;
            }
            else {
                delete_cookie('uid');
                delete_cookie('uname');
                delete_cookie('ukey');
                $this->render('user/login');
            }
        }
        else {
            delete_cookie('uid');
            delete_cookie('uname');
            delete_cookie('ukey');
            $this->render('user/login');
        }
        return $is_login;
    }

}