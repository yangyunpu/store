<?php
// +----------------------------------------------------------------------
// | 单入口引导页面
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   index.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-05-04
// +----------------------------------------------------------------------
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
header('X-Powered-By: CSF');
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', dirname(__DIR__));
}

try {
	include ROOT_PATH . "/configs/Bootstrap.php";
	$apps = new Bootstrap();
	echo $apps -> main();

} catch (\Phalcon\Exception $e) {
	echo $e -> getMessage();
} catch (PDOException $e) {
	echo $e -> getMessage();
}
