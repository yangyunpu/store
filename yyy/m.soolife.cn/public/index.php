<?php
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
header('X-Powered-By: CSF');
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', dirname(__DIR__));
}
try {
	include ROOT_PATH . "/configs/bootstrap.php";
	$bootstrap = new Bootstrap();
	$content = $bootstrap -> run(array());
	//压缩输出
	//echo compress_html($content);  
	echo $content;
} catch (\Phalcon\Exception $e) {
	echo $e -> getMessage();
} catch (PDOException $e) {
	echo $e -> getMessage();
}
/**
 * 压缩输出
 * @param $input 输入字符串
 */
function compress_html($input) {
	return ltrim(rtrim(preg_replace(array("/> *([^ ]*) *</", "/<!--[^!]*-->/", "'/\*[^*]*\*/'", "/\r\n/", "/\n/", "/\t/", '/>[ ]+</'), array(">\\1<", '', '', '', '', '', '><'), $input)));
}
?>