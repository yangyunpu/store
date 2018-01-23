<?php
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
header('X-Powered-By: CSF');
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__);
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
	// header('location:http://static.soolife.cn/40x.html');
} catch (PDOException $e) {
	echo $e -> getMessage();
	// header('location:http://static.soolife.cn/40x.html');
}
/**
 * 压缩输出
 * @param $input 输入字符串
 */
function compress_html($input) {
	return ltrim(rtrim(preg_replace(array("/> *([^ ]*) *</", "/<!--[^!]*-->/", "'/\*[^*]*\*/'", "/\r\n/", "/\n/", "/\t/", '/>[ ]+</'), array(">\\1<", '', '', '', '', '', '><'), $input)));
}
?>
