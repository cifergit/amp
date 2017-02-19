<?php
/**
 * desc: login
 * User: cifer
 * Date: 2016/6/10
 * Time: 18:53
 */

class Login extends MY_Controller {


    function __construct() {
        parent::__construct();
        $this->load->model('user/Model_user');
    }

    //登录
    public function index()
    {
        $this->render('user/login',$this->config->item('seo_login'));
    }

    //登录
    public function login(){
        $name = get_post_value('name');
        $password = get_post_value('password');
        $reqData = array(
            'name' => $name,
            'password' => md5($password),
        );
        $query = $this->Model_user->findUserByNameAndPssword($reqData);
        if($query->row()){
            $ret = array(
                'errcode'   => 0,
                'errmsg'    => '登录成功',
                'data'      => $query->row(),
            );
            $key = $this->getRandChar(10);
            $this->Model_user->updateUserKey($query->row()->id,$key);
            set_cookie('uid',$query->row()->id,2592000);// 一个月 60*60*24*30
            set_cookie('uname',urlencode($query->row()->name),2592000);
            set_cookie('ukey',$key,2592000);
        }
        else {
            $ret = array(
                'errcode'   => -1,
                'errmsg'    => '用户名或密码错误',
            );
        }
        echo json_encode($ret);
    }

    private function getRandChar($length){
        $str = null;
        $strPol = "0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i = 0;$i < $length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }
}