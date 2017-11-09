<?php
/**
 * Created by PhpStorm.
 * User: yingfu
 * Date: 2017/11/9
 * Time: 下午11:05
 */
include  './src/Request.php';
$url='apit.zcplan.cn';
$params=array();
$method = 'GET';
$data= \yinfu\Request::http($url,$params,$method);
var_dump($data);