<?php
/**
 * desc: 
 * User: cifer 
 * DateTime: 2016/1/7 0:11
 */
$db_host = "127.0.0.1";
$db_name = "cifer";
$db_user = "cifer";
$db_password = "CFNf24hXFFz4XWUZ";
$environment = "dev";
if($environment == "dev"){
    $db_user = "root";
    $db_password = "mysql5";
}
$db_mysql_connect = "mysql:host=$db_host;dbname=$db_name";
?>