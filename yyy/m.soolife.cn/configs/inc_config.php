<?php
// +----------------------------------------------------------------------
// | é…ç½®æ–‡ä»¶ å‚æ•°é…ç½®
// +----------------------------------------------------------------------
// | Copyright (c) 2016å¹?å¦‚æ­¤ç”Ÿæ´». All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
use Phalcon\Logger;

return array(
    'application' => array(
        'path_views'        => ROOT_PATH . '/app/views/',
        'path_public'       => ROOT_PATH . '/public/',
        'path_cache'        => ROOT_PATH . '/runtime/cache/',
        'path_volt'         => ROOT_PATH . '/runtime/volt/',
        'path_asset'        => ROOT_PATH . '/runtime/asset/',
        'base_uri'          => '/',
        'default_controller'=>'index',
        'default_action'    =>'index',
        'default_picture'   =>'/public/s.gif',
        'default_notfound'  =>'notFound',
        'default_index'     => 'http://m.test.soolife.cn',
        'default_login'     =>'http://m.test.soolife.cn/logins/login.html',
        'keywords'          => '',
        'description'	    => '',
        'js_css_version'    => '',
        'domain'	    => 'test.soolife.cn',
        'suffix'	    => '首页',
        'debug' 	    => '0',
        'layout' 	    => 'layout_main',
    ),
    'autoload' => array(
	'path_controllers'  => ROOT_PATH . '/app/controllers/',
	'path_models'       => ROOT_PATH . '/app/models/',
	'path_library'      => ROOT_PATH . '/app/librarys/',
	'path_services'     => ROOT_PATH . '/app/services/',
	'path_plugins'      => ROOT_PATH . '/app/plugins/',
    ),
    'url' => array(
    	   'url_static'	=> 'http://static.test.soolife.cn/m',
    	   'url_member'	=> 'http://i.test.soolife.cn/m',
    	   'url.cnsite'	=> 'http://www.test.soolife.cn/m',
    	   'url_goods'	=> 'http://item.test.soolife.cn/m',
    	   'url_shop'	=> 'http://store.test.soolife.cn/m',
    	   'url_sop'	=> 'http://sop.test.soolife.cn/m',
    	   'url_help'	=> 'http://help.test.soolife.cn/m',
    	   'url_order'	=> 'http://orders.test.soolife.cn/m',
    	   'url_search'	=> 'http://search.test.soolife.cn/m',
           'url_m'      =>  'http://m.test.soolife.cn',
           'url_m2'     =>  'http://m.test.soolife.cn',
           'url_money'  => 'http://money.test.soolife.cn',
           'url_sales'  => 'http://sales.test.soolife.cn'
    ),
    // 'images'=>array(
    // 	   'd1_images'	=> 'http://api.soolife.net:9091',
    // 	   'd2_images'  => 'http://api.soolife.net:9091',
    // 	   'd3_images'  => 'http://api.soolife.net:9091',
    // ),
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'rdsqaizl3u8lac7i5ymqkpublic.mysql.rds.aliyuncs.com', // 线上测试库
        'username' => 'soolife_dev',
        'password' => 'soolife_dev123456',
        'dbname' => 'data_soolife_cn_dev'
    ),
    'db_imgs' => array(
        'adapter' => 'Mysql',
        'host' => 'rdsqaizl3u8lac7i5ymqkpublic.mysql.rds.aliyuncs.com',
        'username' => 'img_soolife_dev',
        'password' => 'img_soolife_dev123456',
        'dbname' => 'img_soolife_cn_dev'
    ),
    'new_images'=>array(
           'd1_images'  => 'http://d.test.soolife.cn',
           'd2_images'  => 'http://d.test.soolife.cn',
           'd3_images'  => 'http://d.test.soolife.cn',
    ),
    'images'=>array(
           'd1_images'  => 'http://d.test.soolife.cn',             // å›¾ç‰‡èµ„æºåœ°å€
           'd2_images'  => 'http://d.test.soolife.cn',             // å›¾ç‰‡èµ„æºåœ°å€
           'd3_images'  => 'http://d.test.soolife.cn',             // å›¾ç‰‡èµ„æºåœ°å€
    ),
    'avatar'=>array(
           'd1_images'     => 'http://d.test.soolife.cn/avatar',
           'd2_images'     => 'http://d.test.soolife.cn/avatar',
           'd3_images'     => 'http://d.test.soolife.cn/avatar',
    ),
    'fans'=>array(
           'd1_images'     => 'http://d.test.soolife.cn/fans',
           'd2_images'     => 'http://d.test.soolife.cn/fans',
           'd3_images'     => 'http://d.test.soolife.cn/fans',
    ),
    'redis' => array(
        'host'          => '127.0.0.1',
        'port'          => '6379',
        'auth_password' => 'ilovesoolife',
        'lifttime'      => 8600
    ),
    'logger' => array(
        'path'     => ROOT_PATH . '/runtime/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'app-'.date('Y-m-d') .'.log',
    ),
    'mail' => array(
        'fromName' => '如此生活',
        'fromEmail' => 'service@soolife.com.cn',
        'smtp' => array(
            'server' => 'mail.soolife.com.cn',
            'port' => 25,
            'username' => 'service@soolife.com.cn',
            'password' => '123456@a'
        )
    ),
    'old_api'=>array(
        'url' => 'http://api.soolife.cn',
        'app_id' => '60100001',
        'app_key' => 'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'life_api'=>array( 
        'url' => 'http://life.api.test.soolife.cn',
        'app_id' => '60100001',
        'app_key' => 'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'api'=>array( 
        'url' =>'http://shopping.api.test.soolife.cn',    
        'app_id'=>'60100001',
        'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'java_api'=>array(
        //'url' => 'http://106.14.6.220:80',
        'url' => 'apiv3.test.soolife.cn',
        'app_id'=>'60100001',
        'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'new_api'=>array( 
        'url' => 'http://shopping.api.test.soolife.cn',
        'app_id' => '60100001',
        'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'v2_api'=>array(
        'url'   => 'http://apiv2.soolife.net',
        'app_id'  => '60100001',
        'app_key'   => 'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'php_api'=>array(
        'url' =>'http://shopping.api.test.soolife.cn', 
        'app_id'=>'60100001',
        'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'money_api'=>array(
        'url' =>'http://money.api.test.soolife.cn',
        //'url' =>'http://api.test.soolife.net',
        'app_id'=>'60100001',
        'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'upload' => array(
        'mimes'         =>  array('image/png','image/jpeg','image/gif'), //å…è®¸ä¸Šä¼ çš„æ–‡ä»¶MiMeç±»åž‹
        'maxSize'       =>  1048576, //ä¸Šä¼ çš„æ–‡ä»¶å¤§å°é™åˆ?(0-ä¸åšé™åˆ¶ 1048576:1Må¤§å°)
        'exts'          =>  array('png','gif','jpg','jpeg'), //å…è®¸ä¸Šä¼ çš„æ–‡ä»¶åŽç¼€
        'rootPath'      =>  '/public/uploads/' //ä¿å­˜æ ¹è·¯å¾?
    ),
    'headers' => array(
        'Developer' 	=> 'Tony Wang',
        'X_Powered_By' 	=> 'Concise Framework 0.5',
        'Server' 	=> 'Leopard Server 10 ',
        'Content_Type' 	=> 'text/plain;charset=utf-8',
        'Status_Code' 	=> 'Tony say okey!'
    ),
   'pay'=>array(
       // 'url'=>'http://172.16.1.29:9089',
        'url'=>'http://pay.soolife.net'
    ),
    'oauth' =>array(
         'appid'  => 'wx6fe7550ec5625a23',
         'appkey' => '57bdd0bbe290a22b6844673509db0b61',
    ),
    );