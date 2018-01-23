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
    'application' => array(
        'path_views'        	=> ROOT_PATH . '/app/views/',
        'path_public'       	=> ROOT_PATH . '/public/',
        'path_cache'        	=> ROOT_PATH . '/runtime/cache/',
        'path_volt'         	=> ROOT_PATH . '/runtime/volt/',
        'path_asset'        	=> ROOT_PATH . '/runtime/asset/',
        'base_uri'          	=> '/',
        'default_controller'	=> 'index',
        'default_action'    	=> 'index',
        'default_notfound'  	=> 'notFound',
        'default_login'     	=> 'http://i.test.soolife.cn/login.html',
        'default_picture'   	=> '/public/s.gif',
        'empty_image'   	=> '/public/v3.0.1/img/s.gif',
        'keywords'          	=> '',
        'description'		=> '',
        'js_css_version'    	=> ".".base64_encode('v2.1.1'),
        'domain'		=> 'test.soolife.cn',
        'suffix'		=> '如此生活官网 ',
        'debug' 		=> '0', 		// 是否是 Debug 模式
        'layout' 		=> 'layout_main',	// 布局文件名
    ),
    'autoload' => array(
	'path_controllers'  	=> ROOT_PATH . '/app/controllers/',
	'path_models'       	=> ROOT_PATH . '/app/models/',
	'path_library'      	=> ROOT_PATH . '/app/librarys/',
	'path_services'     	=> ROOT_PATH . '/app/services/',
	'path_plugins'      	=> ROOT_PATH . '/app/plugins/',
    ),
    'url' => array(
	    'url_static'          	=> 'http://static.soolife.cn', 	// 静态站点地址
    	'url_member'		=> 'http://i.test.soolife.cn',	// 会员中心地址
    	'url_website'		=> 'http://www.test.soolife.cn',	// 网站地址
    	'url_goods'		=> 'http://item.test.soolife.cn',	// 商品展示地址
    	'url_shop'		=> 'http://store.test.soolife.cn',	// 店铺展示地址
    	'url_sop'		=> 'http://sop.test.soolife.cn',	// 商家入驻地址
    	'url_help'		=> 'http://help.test.soolife.cn',	// 帮助中心地址
    	'url_orders'		=> 'http://orders.test.soolife.cn',	// 订单中心地址
    	'url_search'		=> 'http://search.test.soolife.cn',	// 搜索中心地址
    	'url_sales'		=> 'http://sales.test.soolife.cn',
    ),
    'images' => array(
	'd1_images'        	=> 'http://d.test.soolife.cn',
    	'd2_images'        	=> 'http://d.test.soolife.cn',
    	'd3_images'        	=> 'http://d.test.soolife.cn',
    ),
    // 'redis' => array(
    //     'adapter' => 'Mysql',
    //     'host' => 'rdsqaizl3u8lac7i5ymqkpublic.mysql.rds.aliyuncs.com', // 线上测试库
    //     'username' => 'soolife_dev',
    //     'password' => 'soolife_dev123456',
    //     'dbname' => 'data_soolife_cn_dev'
    // ),
    'redis' => array(
        'host'          => '127.0.0.1',
        'port'          => 6379,
        'auth_password'     => 'ilovesoolife',
        'lifttime'          => 8600
    ),

    'logger' => array(
        'path'     => ROOT_PATH . '/runtime/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D Y-m-d H:i:s',
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
    'api'=>array( //php
        'url' => 'http://shopping.api.test.soolife.cn',
    	'app_id' => '50010001',
    	'app_key' => 'QTI2RDlGQTY4RjgzREFCMEIzNEYxNTUyODQ3NzhCRTc='
    ),
    'v2_api'=>array( //C#
       'url' => 'http://apiv2.soolife.net',
       'app_id' => '50010001',
       'app_key'=>'QTI2RDlGQTY4RjgzREFCMEIzNEYxNTUyODQ3NzhCRTc='
    ),
    'headers' => array(
        'Developer' 	=> 'Tony Wang',
        'X_Powered_By' 	=> 'Concise Framework 0.5',
        'Server' 	=> 'Leopard Server 10 ',
        'Content_Type' 	=> 'text/plain;charset=utf-8',
        'Status_Code' 	=> 'Tony say okey!'
    ),
	'java_api'=>array(
		'url' =>'apiv3.test.soolife.cn',
		'app_id'=>'50010001',
		'app_key'=>'QTI2RDlGQTY4RjgzREFCMEIzNEYxNTUyODQ3NzhCRTc='
	),
);
