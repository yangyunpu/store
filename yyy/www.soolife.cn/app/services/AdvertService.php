<?php
// +----------------------------------------------------------------------
// | 广告数据
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   AdvertService.php
// |
// | Author: Tony Wang
// | Created:   2016-08-10
// +----------------------------------------------------------------------

class AdvertService extends BaseService {
	
	/**
	 * 根据代码获取活跃的广告信息
	 */
	public function Lively($code) {
		$code = strtolower($code);
		$key = "location:lively:{$code}";
		$this->redis = new WebRedis();
		$data = $this->redis->read($key, 'ads');
		if (!isset($data))
		{
			$url = "/ads/lively/{$code}";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}
}