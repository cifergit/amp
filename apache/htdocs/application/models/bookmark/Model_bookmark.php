<?php
/**
 * desc: 
 * User: cifer
 * Date: 2016/7/10
 * Time: 22:59
 */
class Model_bookmark extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //增加公共书签
    public function insertBookmark($insertData){
        $insertBool = $this->db->insert('t_bookmark', $insertData);
        return $this->db->insert_id();
    }

    //更新公共书签
    public function updateBookmark($id, $arrReq){
        $this->db->where('id', $id);
        $query = $this->db->update('t_bookmark', $arrReq);
        return $query;
    }

    //查找公共书签
    public function findAllBookmark(){
        $query = $this->db->query('select * from t_bookmark order by pv desc');
        return $query;
    }

    //查找公共线上书签
    public function findAllOnlineBookmark(){
        $query = $this->db->query('select * from t_bookmark where status = 1 order by pv desc');
        return $query;
    }

    //增加公共书签分类
    public function insertBookmarkClass($insertData){
        $insertBool = $this->db->insert('t_bookmark_class', $insertData);
        return $this->db->insert_id();
    }

    //更新公共书签
    public function updateBookmarkClass($id, $arrReq){
        $this->db->where('id', $id);
        $query = $this->db->update('t_bookmark_class', $arrReq);
        return $query;
    }

    //查找公共书签分类
    public function findAllBookmarkClass(){
        $query = $this->db->query('select * from t_bookmark_class order by pv desc');
        return $query;
    }

    //查找上线公共书签分类
    public function findAllOnlineBookmarkClass(){
        $query = $this->db->query('select * from t_bookmark_class where status = 1 order by pv desc');
        return $query;
    }

    //获取标签分类
    public function getBookmarkClassById($id){
        $query = $this->db->query('select * from t_bookmark_class where id='.$id);
        return $query;
    }

    //获取标签分类
    public function getBookmarkById($id){
        $query = $this->db->query('select * from t_bookmark where id='.$id);
        return $query;
    }

    public function addBookmarkPvById($id){
        $this->db->set('pv', 'pv+1', FALSE);
        $this->db->where('id', $id);
        $query = $this->db->update('t_bookmark');
        return $query;
    }








    //查找书签分类status 0已删除 1自己可见 2自己及公开
    public function findBookmarkClassByUserId($userId){
        $query = $this->db->query('select * from t_bookmark_class where user_id = '.$userId.'and status = 1');
        return $query;
    }


    public function findByUserId($userId){
        $query = $this->db->query('select * from t_bookmark where user_id = '.$userId);
        return $query;
    }

}