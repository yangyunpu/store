<?php
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
header('X-Powered-By: CSF-WEB001');
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH',__DIR__);
}
try {
	include ROOT_PATH . "/configs/bootstrap.php";

	$bootstrap = new Bootstrap();
	$content = $bootstrap->run(array());
	//echo compress_html($content);  //压缩输出
	echo $content;  //无压缩输出

} catch (\Phalcon\Exception $e) {
	echo $e -> getMessage();
	// header('location:https://static.soolife.cn/40x.html');
} catch (PDOException $e) {
	echo $e -> getMessage();
	// header('location:https://static.soolife.cn/40x.html');
}


function compress_html($string) {
	return ltrim(rtrim(preg_replace(array("/> *([^ ]*) *</", "/<!--[^!]*-->/", "'/\*[^*]*\*/'", "/\r\n/", "/\n/", "/\t/", '/>[ ]+</'), array(">\\1<", '', '', '', '', '', '><'), $string)));
}
?>
