<?php
// +----------------------------------------------------------------------
// | 配置文件 参数配置
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
use Phalcon\Logger;

return array(
    'api'=>array(
      'url' => 'http://172.16.1.29:9090',
      'app_id' => '60100001',
      'app_key' => 'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
  ),
    'php_api'=>array(
        // 'url' =>'http://v1.api.soolife.web',
        'url' =>'http://api.test.soolife.net',
        'app_id'=>'60100001',
        'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'v2_api'=>array(
       'url' => 'http://172.16.1.29:9088',
       'app_id' => '60100001',
       'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
   )
);
