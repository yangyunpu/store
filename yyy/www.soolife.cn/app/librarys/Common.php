<?php
// +----------------------------------------------------------------------
// | 公共函数类库
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Pages.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
use Phalcon\Http\Request;

class Common {
	public static $_request = null;
	/**
	 * Base64编码加密，可用于地址栏中传递
	 * @param $data string 需要加密的字符串
	 */
	static function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	/**
	 * Base64编码解密，可用于地址栏中传递
	 * @param $data string 需要解密的字符串
	 */
	static function base64url_decode($data) {
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

	/**
	 * 判断字符串是否Base64编码
	 * @param $str 需要判断的字符串
	 */
	static function is_base64($str) {
		return ($str == Common::base64url_encode(Common::base64url_decode($str)));
	}


	/**
	 * 获取POST请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤，如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	static function get_post($name,$filters=null,$defaultValue=null)
	{
		if (self::$_request == null)
			self::$_request = new Request();

		return self::$_request->getPost($name,$filters,$defaultValue);
	}

	/**
	 * 获取GET请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤 如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	static function get_query($name,$filters=null,$defaultValue=null)
	{
		if (self::$_request==null)
			self::$_request = new Request();

		return self::$_request->getQuery($name,$filters,$defaultValue);
	}

	/**
	 * 获取客户端IP地址
	 * @return string 如：192.168.1.245
	 */
	static function get_client_address()
	{
		if (self::$_request==null)
			self::$_request = new Request();
		return self::$_request->getClientAddress();
	}

	/**
	 * 获取用户代理信息
	 */
	static function get_user_agent()
	{
		if (self::$_request==null)
			self::$_request = new Request();
		return self::$_request->getUserAgent();
	}

	static function get_real_image_url($config,$id)
	{
		if(empty($id)){
			return $config -> application -> default_picture;
		}
		$ims = $config -> images -> toArray();
		$d = array_rand($ims);
		$url_iamges = $ims[$d];
		return "{$url_iamges}/images/{$id}.jpg";
	}
	static function get_image_url($config,$id,$w,$h,$type='images')
	{
		if (empty($id))
			return $config->application->default_picture;
		if (strlen($id)!==32){
			return "http://img.soolife.cn/{$id}";
		}
		$ims = $config -> images -> toArray();
		$d = array_rand($ims);
		$url_images = $ims[$d];
		if ($w>0 && $h>0){
			return "{$url_images}/{$type}/{$w}x{$h}/{$id}.jpg";
		}else{
			return "{$url_images}/{$type}/{$id}.jpg";
		}
	}
}
?>