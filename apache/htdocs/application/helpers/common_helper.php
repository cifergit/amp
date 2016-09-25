<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/6/10
 * Time: 0:56
 */
//get或post请求的参数
function get_post_value($key, $df = '')
{
    $CI =& get_instance();
    $v = $CI->input->get_post($key);
    $val = $v ? $v : $df;
    if (is_string($val)) {
        $val = trim($val);
    }
    return filter_value($val);
}

function get_post_value_nofilter($key, $df = '')
{
    $CI =& get_instance();
    $v = $CI->input->get_post($key);
    $val = $v ? $v : $df;
    if (is_string($val)) {
        $val = $val;
    }
    return $val;
}

function filter_value($val)
{
    if ($val) {
        $val = str_replace("<", "＜", $val);
        $val = str_replace(">", "＞", $val);
    }
    return $val;
}

//get或post请求的参数 int
function get_post_valueI($key, $df = 0)
{
    $val = get_post_value($key, $df);
    if ($val !== NULL) {
        $val = (int)$val;
    }
    return $val;
}

//防止刷新，true为有效，false为无效
function RefreshHit($ip,$parameter,$allowTime){
    session_start();
    if(empty($allowTime)){
        $allowTime = 1800;
    }
    $allowT = md5($ip.$parameter);
    if(!isset($_SESSION[$allowT])){
        $refresh = true;
        $_SESSION[$allowT] = time();
    }elseif(time() - $_SESSION[$allowT] > $allowTime){
        $refresh = true;
        $_SESSION[$allowT] = time();
    }else{
        $refresh = false;
    }
    return $refresh;
}