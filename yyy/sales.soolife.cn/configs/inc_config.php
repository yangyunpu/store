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
$config = array(
    'application' => array(
        'run_cache'         => ROOT_PATH . '/runtime/cache/',
        'run_volt'          => ROOT_PATH . '/runtime/volt/',
        'base_uri'          => '/',
        'default_notfound'  =>'notFound',
        'default_login'     =>'http://i.test.soolife.cn/login.html',
        'default_index'     =>'http://i.test.soolife.cn/index.html',
        'default_logo'      =>'/public/icon/apple-touch-icon-57-precomposed.png',
        'default_m_login'   => 'http://i.test.soolife.cn/m/login.html',
        'default_m_index'   =>'http://i.test.soolife.cn/m/index.html',
        'default_m_index1'  =>'http://i.test.soolife.cn/m/index.html',

        'keywords'          => '',
        'description'       => '',
        'orgid'             => 1001,
        'domain'            => 'soolife.cn',
        'suffix'            => '会员中心',
        'debug'             => '1',                         // 是否是 Debug 模式
        'layout'            => 'layout_main',                   // 布局文件名
    ),
    'url'=>array(
        'url_static'          => 'http://static.soolife.cn',                 // 静态站点地址
        'url_member'          => 'http://i.test.soolife.cn',                 // 会员中心地址
        'url_website'         => 'http://www.test.soolife.cn',               // 网站地址
        'url_goods'           => 'http://item.test.soolife.cn',              // 商品展示地址
        'url_sales'           => 'http://sales.test.soolife.cn',              // 活动
        'url_shop'            => 'http://store.test.soolife.cn',             // 店铺展示地址
        'url_sop'             => 'http://sop.test.soolife.cn',               // 商家入驻地址
        'url_help'            => 'http://help.test.soolife.cn',              // 帮助中心地址
        'url_order'           => 'http://orders.test.soolife.cn',             // 订单中心地址
        'url_search'          => 'http://search.test.soolife.cn',                // 搜索中心地址
        'url_m'               => 'http://m.test.soolife.cn',                // 个人中心
    ),
    'images'=>array(
        'd1_images'        => 'http://d.test.soolife.cn',
        'd2_images'        => 'http://d.test.soolife.cn',
        'd3_images'        => 'http://d.test.soolife.cn',
    ),
    'redis' => array(
        'host'          => '127.0.0.1',
        'port'          => '6379',
        'auth_password' => 'ilovesoolife',
        'lifttime'      => 8600
    ),

    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'rdsqaizl3u8lac7i5ymqkpublic.mysql.rds.aliyuncs.com', // 线上测试库
        'username' => 'soolife_dev',
        'password' => 'soolife_dev123456',
        'dbname' => 'data_soolife_cn_dev'
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
    'api'=>array(
        'url' => 'http://api.soolife.cn',
        'app_id' => '50010001',
        'app_key' => 'QTI2RDlGQTY4RjgzREFCMEIzNEYxNTUyODQ3NzhCRTc='
    ),
    'php_api'=>array(
        'url' =>'http://shopping.api.test.soolife.cn',
      'app_id'=>'60100001',
      'app_key'=>'RUYyNzJFRDBGODk4RkU2MTBDOTI5MzFFQUUwNTY3Njg='
    ),
    'v2_api'=>array(
        'url' => 'http://apiv2.soolife.net/',
        'app_id' => '50010001',
        'app_key'=>'QTI2RDlGQTY4RjgzREFCMEIzNEYxNTUyODQ3NzhCRTc='
    ),
    'headers' => array(
        'Developer'     => 'Tony Wang',
        'X_Powered_By'  => 'Multi Concise Framework 0.5',
        'Server'        => 'Leopard Server 10 ',
        'Content_Type'  => 'application/json;charset=utf-8',
        'Status_Code'   => 'Tony say okey!'
    )
);

return $config;
