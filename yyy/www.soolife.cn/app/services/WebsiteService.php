<?php
// +----------------------------------------------------------------------
// | 网站数据
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   WebsiteService.php
// |
// | Author: Tony Wang
// | Created:   2016-08-10
// +----------------------------------------------------------------------

class WebsiteService extends BaseService {
	
	/**
	 * 获取友情连接数据
	 * @author tony wang  2016-09-06
	 * @return array
	 */
	public function Links() {
		$key   = "website:about:links";
		$data = $this->redis->read($key, 'settings');
		if (!isset($data))
		{
			$url = "/website/links";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}
	
	/**
	 * 获取关键词
	 * @author tony wang 2016-09-06
	 * @return array
	 */
	public function Keywords($code) {
		$code = strtolower($code);
		$key   = "website:channel:keywords:code:{$code}";
		$data = $this->redis->read($key, 'settings');
		if (!isset($data) || empty($data))
		{
			$url = "/website/keywords/channel/{$code}";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}
	/**
	 * 获取seo关键字与描述
	 * @author liangrong_shi 2017-01-05
	 * @return array
	 */
	public function ChannelSeo($code){
		$code = strtolower($code);
		$key   = "website:seo:{$code}";
		$data = $this->redis->read($key, 'settings');
		if (!isset($data) || empty($data))
		{
			$url = "/website/channel/seo/{$code}";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}
	/**
	 * 获取标签词
	 * @author tony wang 2016-09-16
	 * @param $size int 返回记录数，默认是20
	 * @return array
	 */
	public function Tags($size=20)
	{
		$size = intval($size);
		if ($size<=0) $size=20;
		$key   = "website:channel:tags:{$size}";
		$data = $this->redis->read($key, 'settings');
		if (!isset($data))
		{
			$url = "/website/tags/{$size}";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}
}