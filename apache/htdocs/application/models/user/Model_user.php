<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/16
 * Time: 23:14
 */

class Model_user extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //id查用户
    public function  getUser($userId){
        $userQuery = $this->db->query('select * from t_user where id = '.$userId);
        return $userQuery;
    }

    //增加用户
    public function addUser($insertData){
        $insertBool = $this->db->insert('t_user', $insertData);
        return $this->db->insert_id();
    }

    //邮箱查找用户
    public function findUserByEmail($email){
        $sql = "SELECT * FROM t_user WHERE email = ?";
        $respQuery = $this->db->query($sql, array($email));
        return $respQuery;
    }

    //昵称查用户
    public function findUserByName($name){
        $sql = "SELECT * FROM t_user WHERE name = ?";
        $respQuery = $this->db->query($sql, array($name));
        return $respQuery;
    }

    //登录判断
    public function findUserByNameAndPssword($reqData){
        $sql = "select * from t_user where (name = ? or email = ?) and password = ?";
        $query = $this->db->query($sql,array($reqData['name'],$reqData['name'],$reqData['password']));
        return $query;
    }

    //登录成功后更新一下key
    public function updateUserKey($id, $key){
        $this->db->where('id', $id);
        $query = $this->db->update('t_user', array(
            'ukey'   => $key,
        ));
    }

    //登录后验证是否已登录
    public function checkLogin($id, $ukey){
        $sql = "select * from t_user where id = ? and ukey = ?";
        $query = $this->db->query($sql,array($id,$ukey));
        return $query;
    }

    //邀请码查询
    public function findInviteCodeByCodeAndStatus($inviteCode, $status){
        $sql = "select * from t_invite_code where invite_code = ? and status = ?";
        $query = $this->db->query($sql,array($inviteCode,$status));
        return $query;
    }

    //注册成功后更新邀请码
    public function updateInvite($reqData){
        $dateTime = date("Y-m-d H:i:s");
        $data = array(
            'used_user_id' => $reqData->used_user_id,
            'update_time' => $dateTime,
            'status'    => 1,
        );

        $this->db->where('invite_code', $reqData->invite_code);
        $query = $this->db->update('t_invite_code', $data);
    }
}