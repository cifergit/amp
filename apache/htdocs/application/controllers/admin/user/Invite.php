<?php
/**
 * desc: 邀请码
 * User: cifer
 * Date: 2016/6/10
 * Time: 10:13
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/user/Model_invite');
    }

    public function index(){
        $inviteList = $this->Model_invite->getInviteList();
        $this->render('admin/user/invite',array(
            'inviteList'    => $inviteList,
        ));
    }

    //10位数，36^10 = 36560000亿种可能
    public function add_invite(){
        $strRand = $this->getRandChar(10);
        $reqData = array(
            'invite_code'   => $strRand,
            'create_user_id'    => 1,
            'create_time'   => date("Y-m-d H:i:s"),
            'status'        => 0,
        );
        $inviteCode = $this->Model_invite->addInvite($reqData);
        $ret = array(
            'errcode'   => 0,
            'errmsg'    => '',
            'data'      => $inviteCode,
        );
        echo json_encode($ret);
    }

    function getRandChar($length){
        $str = null;
        $strPol = "0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i = 0;$i < $length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }

}