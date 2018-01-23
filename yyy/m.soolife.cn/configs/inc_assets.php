<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_assets.php
// |
// | Author:    zhichao_hu
// | Created:   2017-03-21
// +----------------------------------------------------------------------
$assets = array();
$assets = array();
//全局资源
$assets["global"] = array(
    "title" =>"全局资源",                // 标题
    "css"   => array(
        // array("path" => "public/ext/css/soo.m.ui.css"),
        // array("path" => "public/ext/css/download.css")
    ),
    "js"    => array(
        // array("path" => "public/ext/js/rem.js"),
        // array("path" => "public/ext/js/jquery-1.8.3.min.js"),
        // array("path" => "public/ext/js/download.js"),
        // array("path" => "public/ext/js/soo.m.ui.js"),
        // array("path" => "public/ext/js/jquery.base64.js")    
    )
);
// 公共样式
$assets["common"] = array();
return $assets;