<?php
// +----------------------------------------------------------------------
// | 单入口引导页面
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   index.php
// |
// | Author:    Lorne
// | Created:   2017-02-10
// +----------------------------------------------------------------------
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');

header('X-Powered-By: CSF-WEB001');
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', dirname(__FILE__));
}

try {
	include ROOT_PATH . "/configs/Bootstrap.php";
	$apps = new Bootstrap();
	$apps -> main();
} catch (\Phalcon\Exception $e) {
	echo $e -> getMessage();
	// header('location:http://static.soolife.cn/40x.html');
} catch (PDOException $e) {
	echo $e -> getMessage();
	// header('location:http://static.soolife.cn/40x.html');
}
