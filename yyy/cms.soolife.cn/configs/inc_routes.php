<?php
// +----------------------------------------------------------------------
// | 配置文件 路由地址配置
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_config.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
$routers = new Phalcon\Mvc\Router();

/**********************************************************************/
// File:     CMS  PC端页面设计
// Author:   qingbo_li 
// Created:  2017-07
$routers -> add('/pc/index.html', array(
    'module' => 'pc',
    'controller' => 'pc',
    'action' => 'index'
));
// 测试页面
$routers -> add('/pc/scan.html', array(
    'module' => 'pc',
    'controller' => 'pc',
    'action' => 'scan'
));
// 验证sku
$routers -> add('/pc/checksku.html', array(
    'module' => 'pc',
    'controller' => 'pc',
    'action' => 'checksku'
));
// 整体数据存储
$routers -> add('/pc/save.html', array(
    'module' => 'pc',
    'controller' => 'pc',
    'action' => 'save'
));
//接口
$routers -> add('/pc/getgoods.html', array(
    'module' => 'pc',
    'controller' => 'pc',
    'action' => 'getgoods'
));

/**********************************************************************/
// File:     CMS  Mobile页面设计
// Author:   qingbo_li 
// Created:  2017-07
$routers -> add('/mobile/index.html', array(
    'module' => 'mobile',
    'controller' => 'mobile',
    'action' => 'index'
));
// 验证sku
$routers -> add('/mobile/checksku.html', array(
    'module' => 'mobile',
    'controller' => 'mobile',
    'action' => 'checksku'
));
// 整体数据存储
$routers -> add('/mobile/save.html', array(
    'module' => 'mobile',
    'controller' => 'mobile',
    'action' => 'save'
));
// 测试活动页
$routers -> add('/mobile/scan.html', array(
    'module' => 'mobile',
    'controller' => 'mobile',
    'action' => 'scan'
));
//接口
$routers -> add('/mobile/getgoods.html', array(
    'module' => 'mobile',
    'controller' => 'mobile',
    'action' => 'getgoods'
));





///////////////////////////////////////////////////////////////////////////

// 默认路由器
$routers -> setDefaults(array(
    'module' => 'pc',
    'controller' => 'pc',
    'action' => 'index'
));


return $routers;
