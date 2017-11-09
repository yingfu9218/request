request

install :

```
composer require "yingfu9218/request"

```

example:

```php
<?php
/**
 * Created by PhpStorm.
 * User: yingfu
 * Date: 2017/11/9
 * Time: 下午11:05
 */
use yfchen\Request;
$url='http://baidu.com';
$params=array();
$method = 'GET';
$data= Request::http($url,$params,$method);
var_dump($data);

```