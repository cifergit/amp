<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/16
 * Time: 23:08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {


    function __construct() {
        parent::__construct();
        date_default_timezone_set('PRC');
        $this->load->model('user/Model_user');
    }

    //首页
    public function index()
    {
        $this->render('user/register',array());
    }

    //注册
    public function add_user(){
        $name = get_post_value('name');
        $email = get_post_value('email');
        $invite_code = get_post_value('invite_code');
        $password = get_post_value('password');
        $password_confirm = get_post_value('password_confirm');
        $dateTime = date("Y-m-d H:i:s");
        $reqData = array(
            'name' => $name,
            'email'     => $email,
            'invite_code' => $invite_code,
            'password' => md5($password),
            'create_time'   => $dateTime,
            'error_number'  => 0,
            'score'     => 0,
            'status'    => 0,
        );

        $ret = array(
            'errcode'   => 0,
            'errmsg'    => '注册成功',
            'data'      => $reqData,
        );
        /*$reqData = array(
            'name' => '1',
            'email'     => '123@qq.com',
            'password' => '1',
            'invite_code' => 'xxx',
            'error_number'  => 0,
            'score'     => 0,
            'status'    => 0,
        );*/
        //return;
        $userId = $this->Model_user->addUser($reqData);
        if(!empty($userId)){
            $reqInvite = new stdClass();
            $reqInvite->used_user_id = $userId;
            $reqInvite->invite_code = $invite_code;
            $this->Model_user->updateInvite($reqInvite);
            $ret = array(
                'errcode'   => 0,
                'errmsg'    => '注册成功',
                'user'  => $userId,
                'data'      => $reqData,
            );
        }
        echo json_encode($ret);
    }

    //判断邮箱唯一,true唯一，false不唯一
    public function check_email(){
        $email = get_post_value('email');
        $query = $this->Model_user->findUserByEmail($email);
        if($query->row()){
            $ret = array(
                'errcode'   => -1,
                'errmsg'   => '邮箱已被注册',
                'data'  => $query->row(),
            );
        }
        else {
            $ret = array(
                'errcode'   => 0,
                'errmsg'   => '邮箱可使用',
            );
        }
        echo json_encode($ret);
    }

    //判断昵称唯一,true唯一，false不唯一
    public function check_name(){
        $name = get_post_value('name');
        if(strlen($name) > 21){
            $ret = array(
                'errcode'   => 400,
                'errmsg'    => '用户名太长',
            );
        }
        else {
            $query = $this->Model_user->findUserByName($name);
            if($query->row()){
                $ret = array(
                    'errcode'   => -1,
                    'errmsg'   => '昵称已被注册',
                    'data'  => $query->row(),
                );
            }
            else {
                $ret = array(
                    'errcode'   => 0,
                    'errmsg'   => '昵称可使用',
                );
            }
        }
        echo json_encode($ret);
    }

    //判断邀请码是否存在且是否未被使用,0可用，其他不可用
    public function check_invite_code(){
        $invite_code = get_post_value('invite_code');
        $query = $this->Model_user->findInviteCodeByCodeAndStatus($invite_code,0);
        if($query->row()){
            $ret = array(
                'errcode'   => 0,
                'errmsg'   => '邀请码可用',
                'data'  => $query->row(),
            );
        }
        else {
            $ret = array(
                'errcode'   => -1,
                'errmsg'   => '邀请码不可用',
            );
        }
        echo json_encode($ret);
    }
}