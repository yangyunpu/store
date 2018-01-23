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
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\User\Component;

class Common extends Component{
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
	 * 动态获取图片完整地址
	 * @param $conifg 框架配置
	 * @param $id 标识符
	 * @param $w 宽
	 * @param $h 高
	 * @return string image path
	 */
	static function get_image_url($id, $w = 0, $h = 0,$type='images') {
		$c = new Common();
		$config = $c->config;
		$path = $config -> application -> default_logo;
		if (empty($id))
			return $path;
		if (strlen($id) !== 32) {
			$path = "http://img.soolife.cn/{$id}";
		} else {
			$ims = $config -> images -> toArray();
			$d = array_rand($ims);
			$url_images = $ims[$d];
			if ($w > 0 && $h > 0) {
				$path =  "{$url_images}/{$type}/{$w}x{$h}/{$id}.jpg";
			} else {
				$path = "{$url_images}/{$type}/{$id}.jpg";
			}
		}
		return $path;
	}
}
?>