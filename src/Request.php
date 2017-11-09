<?php
/**
 * Created by PhpStorm.
 * User: yingfu
 * Date: 2017/11/9
 * Time: 下午10:59
 */

namespace yfchen;


class Request
{
    public static function http($url, $params, $method = 'GET', $header = array(),$cookies = array(), $multi = false,$referer=''){
        $headerArr = array();
        foreach( $header as $n => $v ) {
            $headerArr[] = $n .':' . $v;
        }
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $headerArr,
            CURLOPT_ENCODING=>'gzip',
        );
        if($referer){$opts[CURLOPT_REFERER]=$referer;}
        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url;// . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new \Exception('不支持的请求方式！');
        }
        $cookies_string = '';
        if (!empty($cookies)) {
            if(is_array($cookies)){
                foreach($cookies as $name=>$value){
                    $cookies_string .= $name.'='.$value.';';
                }
            }else{
                $cookies_string=$cookies;
            }
            $opts[CURLOPT_COOKIE] = $cookies_string;
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        //抛出错误,暂时屏蔽
        // if($error) throw new \Exception('请求发生错误：' . $error);
        return  $data;
    }
}