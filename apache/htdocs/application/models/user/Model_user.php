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

    public function  getUser($userId){
        $userQuery = $this->db->query('select * from t_user where id = '.$userId);
        return $userQuery;
    }

    public function addUser($insertData){
        $insertBool = $this->db->insert('t_user', $insertData);
        return $insertBool;
    }

}