<?php
/**
 * desc: invite model
 * User: cifer
 * Date: 2016/6/10
 * Time: 11:09
 */
class Model_invite extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getInviteList(){
        $resQuery = $this->db->query('select * from t_invite_code');
        return $resQuery;
    }

    public function addInvite($insertData){
        $insertBool = $this->db->insert('t_invite_code', $insertData);
        return $this->db->insert_id();
    }

}