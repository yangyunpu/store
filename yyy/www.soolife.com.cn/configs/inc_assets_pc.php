<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_assets_PC.php
// |
// | Author:    Elloit Shi
// | Created:   2017-02-21
// +----------------------------------------------------------------------
$assets = array();
// 全局样式
$assets["global"] = array(
    "name"      =>"global",             // 名称，也可以做集合名称来使用
    "title"     =>"全局",                // 标题
    "version"   =>"1.0.0",              // 版本
    "prefix"    =>"",                   // 前缀,移服务器方便
    "target"    =>"global",             // 如果压缩后，产生的文件新名称
    "css" => array(
     	array("path" => "public/ext/bootstrap/bootstrap-3.3.5-dit/css/bootstrap.min.css"),
     	array("path" => "public/ext/font-awesome/css/font-awesome.min.css"),
        array("path" => "public/css/p/view.cms.common.css"),
    ),
    "js" => array(
		array("path" => "public/ext/jquery/jquery-2.1.0.min.js"),
        array("path" => "public/ext/bootstrap/bootstrap-3.3.5-dit/js/bootstrap.min.js"),
        array("path" => "public/ext/bootstrap.bootbox.js"),
        array("path" => "public/ext/common.js"),
	)
);
// 公共样式
$assets["common"] = array();
return $assets;