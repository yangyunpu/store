<?php
$assets = array();
//全局资源
$assets["global"] = array(
    "title"	=>"全局资源",                // 标题
    "css" 	=> array(
     	array("path" => "public/ext/bootstrap/css/bootstrap.min.css"),
     	array("path" => "public/ext/font-awesome/css/font-awesome.min.css"),
     	array("path" => "public/v3.0.1/css/pc.globals.css"),
    ),
    "js" 	=> array(
		array("path" => "public/ext/jquery-1.9.1.min.js"),
		array("path" => "public/ext/bootstrap/js/bootstrap.min.js"),
		array("path" => "public/ext/jquery.lazyload.min.js"),
		array("path" => "public/v3.0.1/js/pc.globals.js"),
        array("path" => "public/ext/jquery.base64.js")
	)
);
// 公共样式
$assets["common"] = array();
return $assets;