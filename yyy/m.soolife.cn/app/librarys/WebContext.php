<?php
// +----------------------------------------------------------------------
// | 页面类
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Pages.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
use Phalcon\Mvc\User\Component;

class WebContext extends Component {
	/**
	 * 获取POST请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤，如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	function get_post($name, $filters = null, $defaultValue = null) {
		return $this -> request -> getPost($name, $filters, $defaultValue);
	}

	/**
	 * 获取GET请求数据
	 * @param $name 参数名称
	 * @param $filters 规则过滤 如：string,int,float,email 等等，也可以自定义 Phalcon\Filter;
	 * @param $defaultValue 默认值
	 */
	function get_query($name, $filters = null, $defaultValue = null) {
		return $this -> request -> getQuery($name, $filters, $defaultValue);
	}

	/**
	 * 获取客户端IP地址
	 * @return string 如：192.168.1.245
	 */
	function get_client_address() {
		if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			$ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
		}elseif(isset($_SERVER["HTTP_REMOTEIP"]))
		{
			$ip=$_SERVER["HTTP_REMOTEIP"];
		}else
		{
			$ip = $this -> request -> getClientAddress();
		}
		return $ip;
	}
	/**
	 * 获取用户代理信息
	 */
	function get_user_agent() {
		return $this -> request -> getUserAgent();
	}

	//压缩图片
	function get_image_url($config, $id, $w, $h) {
		if (strpos($_SERVER['HTTP_HOST'], 'soolife.cn', 0) > 0)
			return "/v1/file/images/{$id}?c=2&w={$w}&h={$h}";
		else
			return "{$config->application->url_images}/images/" . date('Ymd') . "/{$w}x{$h}/{$id}.jpg";
	}

}
