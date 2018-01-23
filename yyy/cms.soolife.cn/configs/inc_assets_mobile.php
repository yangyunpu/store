
<?php
$assets = array();
//全局资源
$assets["global"] = array(
    "title" =>"全局资源",                // 标题
    "css"   => array(
    	array('path' => 'public/ext/bootstrap/css/bootstrap.min.css'),
        array('path' => 'public/ext/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'),
     	array('path' => 'public/ext/font-awesome/css/font-awesome.min.css'),
        array('path' => 'public/ext/ace/css/ace.min.css'),
        array('path' => 'public/ext/ace/css/ace-skins.min.css'),
        array('path' => 'public/ext/ace/css/ace-rtl.min.css'),
        array('path' => 'public/ext/css/swiper.css'),
    ),
    "js"    => array(
        array("path" => "public/ext/jquery/jquery-1.11.3.min.js"),
        array("path" => "public/ext/jquery/jquery.base64.js"),
        array("path" => "public/ext/jquery/jquery.validate.min.js"),
        array('path' => 'public/ext/bootstrap/js/bootstrap.min.js'),
        array('path' => 'public/ext/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'),
        array('path' => 'public/ext/ace/js/ace-elements.min.js'),
        array('path' => 'public/ext/ace/js/ace.min.js'),
        array('path' => 'public/ext/ace/js/ace-extra.min.js'),
        array('path' => 'public/ext/js/swiper.min.js'),
    )
);
// 公共样式
$assets["common"] = array();
return $assets;