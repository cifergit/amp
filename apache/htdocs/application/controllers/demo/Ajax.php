<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/5/7
 * Time: 9:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->load->view('errors/html/ajax');
    }

    function get(){
        $name = $this->input->get('name');
        $age = $this->input->get('age');
        $t = time();
        if(!empty($name) && !empty($age)){
            $resp = array(
                'code'  => 0,
                'msg'   => '请求成功',
                'data'  => array(
                    'type'  => 'get_interface',
                    'name'  => $name,
                    'age'   => $age,
                    't'     => $t
                )
            );
        }
        else {
            $resp = array(
                'code'  => 404,
                'msg'   => '无法获取name或age值'
            );
        }
        echo json_encode($resp);
    }

    function post(){
        $name = $this->input->post('name');
        $age = $this->input->post('age');
        $t = time();
        if(!empty($name) && !empty($age)){
            $resp = array(
                'code'  => 0,
                'msg'   => '请求成功',
                'data'  => array(
                    'type'  => 'post_interface',
                    'name'  => $name,
                    'age'   => $age,
                    't'     => $t
                )
            );
        }
        else {
            $resp = array(
                'code'  => 404,
                'msg'   => '无法获取name或age值'
            );
        }
        echo json_encode($resp);
    }

function jsonp(){
    $callback = $_GET['callback'];
    $name = $this->input->get('name');
    $age = $this->input->get('age');
    $t = time();
    if(!empty($name) && !empty($age)){
        $resp = array(
            'code'  => 0,
            'msg'   => '请求成功',
            'data'  => array(
                'type'  => 'jsonp_interface',
                'name'  => $name,
                'age'   => $age,
                't'     => $t
            )
        );
    }
    else {
        $resp = array(
            'code'  => 404,
            'msg'   => '无法获取name或age值'
        );
    }
    echo $callback.'('.json_encode($resp).')';
}

    function jsonpin(){
        $callback = $_GET['callback'];
        echo $callback.'(alert("你是SB"))';
    }

function cors(){
    //容许跨域的结合
    $allowOrigin = array(
        'http://www.boatsky.com' => '/^http(s?):\/\/www\.boatsky\.com(\/|$)/',
        'http://www.ez-robot.cn' => '/^http(s?):\/\/www\.ez\-robot\.cn(\/|$)/',
        'http://www.yrczone.com' => '/^http(s?):\/\/www\.yrczone.com(\/|$)/',
    );
    $referer = $_SERVER['HTTP_REFERER'];
    $originFlag = false;
    $thisHost = $_SERVER['HTTP_HOST'];
    foreach($allowOrigin as $key => $origin){
        if(preg_match($origin,$referer)){
            $originFlag = true;
            $thisHost = $key;
            break;
        }
    }
    //如果匹配以上，才容许cors
    if($originFlag){
        header('Access-Control-Allow-Origin: '.$thisHost);
    }
    $name = $this->input->get('name');
    if(empty($name)){
        $name = $this->input->post('name');
    }
    $age = $this->input->get('age');
    if(empty($age)){
        $age = $this->input->post('age');
    }
    $t = time();
    if(!empty($name) && !empty($age)){
        $resp = array(
            'code'  => 0,
            'msg'   => '请求成功',
            'data'  => array(
                'type'  => 'cors_interface',
                'name'  => $name,
                'age'   => $age,
                'host'  => $_SERVER['HTTP_HOST'],
                'referer' => $referer,
                't'     => $t
            )
        );
    }
    else {
        $resp = array(
            'code'  => 404,
            'msg'   => '无法获取name或age值'
        );
    }
    echo json_encode($resp);
}
}