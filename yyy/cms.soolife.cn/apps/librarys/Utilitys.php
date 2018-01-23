<?php
// +----------------------------------------------------------------------
// | 常用操作类
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Utilitys.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-08-10
// +----------------------------------------------------------------------
namespace Soolife\Cms\Librarys;
use Phalcon\Mvc\User\Component;
	
class Utilitys extends Component {
	
	/**
	 * Base64编码加密，可用于地址栏中传递
	 * @param $data string 需要加密的字符串
	 */
	function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}
	
	/**
	 * Base64编码解密，可用于地址栏中传递
	 * @param $data string 需要解密的字符串
	 */
	function base64url_decode($data) {
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}
	
	/**
	 * 获取产品图片
	 * @param $id 图片标识
	 * @param $w 图片宽度
	 * @param $h 图片高度
	 * @return string 图片地址
	 */
	function get_goods_picture($id,$w=0,$h=0)
	{
		if(empty($id)){
			return $this -> config -> application -> default_picture;
		}
		if(strlen($id)!== 32){
			return "http://img.soolife.cn/{$id}";
		}
		$w = intval($w);
		$h = intval($h);
		$imgs = $this-> config -> images -> toArray();
		$index = array_rand($imgs);
		$img = $imgs[$index];
		if ($w>0 && $h>0)
			$url = "{$img}/images/{$w}x{$h}/{$id}.jpg";
		else 
			$url = "{$img}/images/{$id}.jpg";
		return $url;
	}
	
	// 广告相关函数 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 获取广告图片
	 * @param $id 图片标识
	 * @return string 图片地址
	 */
	function get_advert_picture($id)
	{
		if(empty($id)){
			return $this -> config -> application -> default_picture;
		}
		$imgs = $this-> config -> images -> toArray();
		$index = array_rand($imgs);
		$img = $imgs[$index];
		return "{$img}/img/{$id}.jpg";
	}
	
	/**
	 * 随机获取当前的广告
	 */
	function get_advert_current($key,$data){
		if (isset($data) && !empty($data) && !empty($key))
		{
			if (array_key_exists($key, $data))
			{
				$item = current($data[$key]);
				$item['picture'] = $this->get_advert_picture($item['picture']);
				return $item;
			}
		}
		return array();
	}
	
	function get_advert_html($key,$data,$is_array=true){
		$empty_image = $this->config->application->empty_image;
		if ($is_array)
			$item = $this->get_advert_current($key, $data);
		else {
			$item = $data;
		}
		if (isset($item) && !empty($item))
		{
			if ($is_array)
			{
				$r = "<a id=\"{$key}\" href=\"{$item['pc_link']}\" target=\"_blank\" title=\"{$item['title']}\">"
				 ."<img class=\"lazy\" src=\"{$empty_image}\" data-original=\"{$item['picture']}\" title=\"{$item['title']}\" alt=\"{$item['title']}\" /></a>";
			}
			else {
				$r = "<a id=\"{$key}\" href=\"{$item['pc_link']}\" target=\"_blank\" title=\"{$item['title']}\">"
				 ."<img  src=\"{$item['picture']}\" title=\"{$item['title']}\" alt=\"{$item['title']}\" /></a>";
			}
		}
		else {
			$r = "<img src=\"{$empty_image}\" />";
		}
		return $r;
	}
	
	function get_advert_direct($key,$data){
		$empty_image = $this->config->application->empty_image;
		$item = $this->get_advert_current($key, $data);
		if (isset($item) && !empty($item))
		{
			$r = "<a id=\"{$key}\" href=\"{$item['pc_link']}\" target=\"_blank\" title=\"{$item['title']}\">"
				 ."<img  src=\"{$item['picture']}\" title=\"{$item['title']}\" alt=\"{$item['title']}\" /></a>";
		}
		else {
			$r = "<img src=\"{$empty_image}\" />";
		}
		return $r;
	}
	
	function conver_banner($i,$data,$util) {
		$r = array();
		if ($i<count($data))
		{
			$item = $data[$i];
			$r = array(
				"picture"=>$util->get_advert_picture($item['picture']),
				"pc_link"=>$item['pc_link'],
				"title"=>$item['title'],
				"id"=>$item['id']
			);
		}
		return $r;
	}
}