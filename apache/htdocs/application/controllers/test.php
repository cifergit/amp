<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/7
 * Time: 9:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //博客
    public function index()
    {
        $data = "";
        $query = $this->db->query('select * from t_movie');
        /*if ($this->db->query('select * from t_movie'))
        {
            $data =  "Success!";
        }
        else
        {
            $data =  "Query failed!";
        }*/

        $this->load->view('common/test',array(
            'query'  => $query
        ));
    }

}