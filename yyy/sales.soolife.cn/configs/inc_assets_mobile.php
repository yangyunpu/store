
<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   inc_assets_moblie.php
// |
// | Author: Gao Qi 
// | Created:   2016-07-13
// +----------------------------------------------------------------------
$assets = array();
// 全局样式
$assets["global"] = array(
    "name"      =>"global",             // 名称，也可以做集合名称来使用
    "title"     =>"全局",                // 标题
    "version"   =>"1.0.0",              // 版本 
    "prefix"    =>"",                   // 前缀,移服务器方便
    "target"    =>"global",             // 如果压缩后，产生的文件新名称
/*    "css" => array(
     	array("path" => "public/ext/bootstrap/css/bootstrap.min.css"),
     	array("path" => "public/ext/font-awesome/css/font-awesome.min.css"),
     	array("path" => "public/mobile/css/common.css")
     	
    ),*/
    /*"js" => array(
    	 array("path" => "public/ext/jquery/jquery-1.11.3.min.js"),
		 array("path" => "public/ext/bootstrap/js/bootstrap.min.js"),
		 array("path" => "public/mobile/js/common.js")
	)*/
);
// 公共样式
$assets["common"] = array();
return $assets;