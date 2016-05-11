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
    }

    //博客
    public function index()
    {
        $this->load->view('movie/index');
    }

}