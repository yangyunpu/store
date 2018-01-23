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

class Common {
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
	 * 动态获取图片完整地址（原图）
	 * author Luo Qing
	 * @param $conifg 框架配置
	 * @param $id 标识符

	 * @return string image path
	 */
	//原图显示
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

	/**
	 * 动态获取图片完整地址
	 * @param $conifg 框架配置
	 * @param $id 标识符
	 * @param $w 宽
	 * @param $h 高
	 * @param $type 类型
	 * @return string image path
	 */
	static function get_image_url($config, $id, $w = 0, $h = 0,$type = 'images') {
		if (empty($id)){
			return $config->application->default_logo;
		}
		if (strlen($id)!==32){
			return "http://img.soolife.cn/{$id}";
		}
			$ims = $config -> images -> toArray();
			$d = array_rand($ims);
			$url_images = $ims[$d];
			if ($w>0 && $h>0){
				return "{$url_images}/$type/{$w}x{$h}/{$id}.jpg";
			}else{
				return "{$url_images}/$type/{$id}.jpg";
			}
	}
	/**
	* 判断路径是否存在，不存在，将循环创建目录，并且权限是0766，有读写无执行权限，Window中无效
	* @param $path string 路径
	*/
	static function create_file_dir($path) {
		if (!file_exists($path)) {
			Common::create_file_dir(dirname($path));
			mkdir($path);
			chmod($path, 0766);	// 正式使用这个
			//chmod($path, 0777);  // 测试用这个
		}
	}

	/**
	 * 获取客户端IP地址
	 * @return string 如：192.168.1.245
	 */
	static public function get_client_address() {
		if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
		}elseif(isset($_SERVER["HTTP_REMOTEIP"])){
			$ip=$_SERVER["HTTP_REMOTEIP"];
		}else{
			$ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '';
		}
		return $ip;
	}

}
?>