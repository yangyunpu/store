<?php
// +----------------------------------------------------------------------
// | 配置文件 参数配置
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Lrone 2017-02-10
// | Created:   2017-02-10
// +----------------------------------------------------------------------
use Phalcon\Logger;

$config = array(
    'application' => array(
        'run_cache'        	=> ROOT_PATH . '/runtime/cache/',
        'run_volt'         	=> ROOT_PATH . '/runtime/volt/',
        'base_uri'          => '/',
        'default_notfound'	=> 'notFound',
        'default_login'     => 'http://www.test.soolife.com.cn/sop/login.html',
        'default_index'     => 'http://www.test.soolife.com.cn/sop/index.html',
        'default_logo'     	=> '/public/icon/apple-touch-icon-57-precomposed.png',
        'default_m_login'  	=> 'http://i.test.soolife.cn/login.html',
        'default_m_index'   => 'http://i.test.soolife.cn/index.html',
        'default_m_index1'  => 'http://i.test.soolife.cn/index.html',
        'error_page'        =>'http://static.soolife.cn/40x.html',

        'keywords'          => '',
        'description'		=> '',
        'js_css_version'    => '1.10.3',
        'orgid' 		    => 1001,
        'domain'		    => 'test.soolife.com.cn',
        'suffix'		    => '如此生活',
        'debug' 		    => '0', 						    // 是否是 Debug 模式
        'layout' 		    => 'layout_main',					// 布局文件名
    ),
    'url'=>array(
    	   'url_static'     => 'http://static.test.soolife.cn', 			      // 静态站点地址
    	   'url_member'		=> 'http://i.test.soolife.cn',					      // 会员中心地址
    	   'url_website'	=> 'http://www.test.soolife.cn',				      // 网站地址
    	   'url_goods'		=> 'http://item.test.soolife.cn',				      // 商品展示地址
    	   'url_shop'		=> 'http://store.test.soolife.cn',				      // 店铺展示地址
    	   'url_sop'		=> 'http://sop.test.soolife.cn',				      // 商家入驻地址
    	   'url_help'		=> 'http://help.test.soolife.cn',				      // 帮助中心地址
    	   'url_order'		=> 'http://orders.test.soolife.cn',				      // 订单中心地址
    	   'url_search'		=> 'http://search.test.soolife.cn',				      // 搜索中心地址
    	   'url_envelope'   => 'http://www.test.soolife.cn/share/getRredPacket',  //分享红包注册
           'url_m'          => 'http://m.test.soolife.cn',
           'url_intranet'   => 'http://www.test.soolife.com.cn'            //本地
    ),
    'images'=>array(
    	   'd1_images'      => 'http://d.test.soolife.cn',				// 图片资源地址
    	   'd2_images'      => 'http://d.test.soolife.cn',				// 图片资源地址
    	   'd3_images'      => 'http://d.test.soolife.cn',				// 图片资源地址
    ),
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
   'redis' => array(
        'host'          => '127.0.0.1',
        'port'          => '6379',
        'auth_password' => 'ilovesoolife',
        'lifttime'      => 8600
    ),
   'write_redis' => array(
        'host'          => '127.0.0.1',
        'port'          => 6379,
        'auth_password' => 'ilovesoolife',
        'lifttime'      => 8600
    ),
    'logger' => array(
        'path'     => ROOT_PATH . '/runtime/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'apps-'.date('Y-m-d') .'.log',
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
    'oauth' =>array(
        'qq'=>array(
            'enable' => true,
            'appid'  => '101280866',
            'appkey' => '4d6ab66a40261338555f022d7c4c8249'
        ),
        'sina'=>array(
            'enable' => true,
            'appid'  => '703832578',
            'appkey' => '9e05df8606ff915fb3109e5e6bdfcd58'
        ),
        'wechat' => array(
            'enable' => true,
            'appid'  => 'wxe1788ab35bdbf471',
            'appkey' => 'cd4d20bd8657e87910c4deb7b033063c'
        ),
        'alipy' =>array(
            'enable' => true,
            'appid'  => '2015060500109196',
            'appkey' => 'vycma8660fbyeq8oyox2d2ehjuc7hde9'
        )
    ),
    'upload' => array(
        'prefix'        => 'web001',
        'mimes'         =>  array('image/png','image/jpeg','image/gif'), //允许上传的文件MiMe类型
        'maxSize'       =>  153600, //上传的文件大小限制 (0-不做限制 1048576:1M大小)
        'exts'          =>  array('png','gif','jpg','jpeg'), //允许上传的文件后缀
        'rootPath'      =>  '/public/uploads/' //保存根路径
    ),
    'headers' => array(
        'Developer' 	=> 'Lorne',
        'X_Powered_By' 	=> 'Multi Concise Framework 0.5',
        'Server' 		=> 'Leopard Server 10 ',
        'Content_Type' 	=> 'application/json;charset=utf-8',
        'Status_Code' 	=> 'Tony say okey!'
    )
);

return $config;
