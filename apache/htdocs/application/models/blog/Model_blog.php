<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/6/11
 * Time: 16:22
 */

class Model_blog extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function findBlogAll(){
        $query = $this->db->query('select * from t_blog');
        return $query;
    }

    //id查博客
    public function findBlogById($id){
        $query = $this->db->query('select * from t_blog where id = '.$id);
        return $query;
    }

    public function findBlogByUserId($userId){
        $query = $this->db->query('select * from t_blog where user_id = '.$userId);
        return $query;
    }

    //增加博客
    public function insertBlog($insertData){
        $insertBool = $this->db->insert('t_blog', $insertData);
        return $this->db->insert_id();
    }

    //更新博客
    public function updateBlog($id,$arrReq){
        $this->db->where('id', $id);
        $query = $this->db->update('t_blog', $arrReq);
        return $query;
    }
}