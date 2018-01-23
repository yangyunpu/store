<?php
$assets = array();
// 全局样式
$assets["global"] = array(
    "name"      =>"global",             // 名称，也可以做集合名称来使用
    "title"     =>"全局",                // 标题
    "version"   =>"1.0.0",              // 版本
    "prefix"    =>"",                   // 前缀,移服务器方便
    "target"    =>"global",             // 如果压缩后，产生的文件新名称
    "css" => array(
     	array("path" => "public/ext/bootstrap/css/bootstrap.min.css"),
     	array("path" => "public/ext/font-awesome/css/font-awesome.min.css"),
        array("path" => "public/pc/css/common.css"),
        array("path" => "public/pc/css/button.css"),
        array("path" => "public/pc/css/sidebar.css"),
        array("path" => "public/pc/css/tipetbar.css"),
        array("path" => "public/pc/css/pc_globals.css")


    ),
    "js" => array(
    	//array("path" => "public/ext/jquery/jquery-1.11.3.min.js"),
    //	array("path" => "public/ext/bootstrap/js/bootstrap.min.js"),
        array("path" => "public/pc/js/common.js"),
    //    array("path" => "public/pc/js/global.js"),
     //   array("path" => "public/pc/js/modcatalog.js"),
     //   array("path" => "public/pc/js/pc_index.js")
	)
);
// 公共样式
$assets["common"] = array();
return $assets;
