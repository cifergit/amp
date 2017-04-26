<?php
/**
 * desc: 
 * User: cifer
 * Date: 2017/2/9
 * Time: 23:49
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    //关于我
    public function index()
    {
        $this->render('common/author',array(
            'head_title'            => $this->config->item('seo_author')['head_title'],
            'head_description'      => $this->config->item('seo_author')['head_description'],
            'head_keywords'         => $this->config->item('seo_author')['head_keywords'],
        ));
    }

    //友链
    public function friends(){
        $this->render('common/friends',array(
            'head_title'            => $this->config->item('seo_friends')['head_title'],
            'head_description'      => $this->config->item('seo_friends')['head_description'],
            'head_keywords'         => $this->config->item('seo_friends')['head_keywords'],
        ));
    }

}