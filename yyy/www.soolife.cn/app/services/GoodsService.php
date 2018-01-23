<?php
// +----------------------------------------------------------------------
// | 分类数据
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   CategoryService.php
// |
// | Author: Tony Wang
// | Created:   2016-05-25
// +----------------------------------------------------------------------

class GoodsService extends BaseService {
	
	/**
	 * 最热商品
	 * @author tony wang
	 * @param $size int 
	 * @return array
	 */
	public function Hot($args,$token) {
//		$key = "goods:rank:hot:{$size}";
//		$data = $this->redis->read($key, 'goods');
//		if (!isset($data))
//		{
//			$url = "/goods/hotgoods/$size";
//			if ($this -> curl -> get_request($url) == 200) {
//				$data = $this -> curl -> getArrayData();
//			}
//		}
//		//echo "<pre>";print_r($data);die;
//		return $data;

		$url = "/v3/goods/guesslike";
		$result =array() ;
		$this->curl->set_token($token);
		if ($this -> curl -> post_request($url,$args,"java_api") == 200) {
			$result = $this -> curl ->getArrayData();
		}
		return $result['guess_list'];
	}
	
	/**
	 * 星币商品
	 * @author tony wang 
	 * @param $size 最多返回多少条商品
	 * @return array
	 */
	public function Coin($size){
		$key = "promo:sku:coin:{$size}";  // 星币活动列表
		$data = $this->redis->read($key, 'goods');
		if (!isset($data))
		{
			$url = "/goods/coin/{$size}";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}
	
	public function Category($cats,$page=1,$size=20){
		$key = "promo:sku:coin:{$size}";  // 星币活动列表
		$data = $this->redis->read($key, 'goods');
		if (!isset($data))
		{
			$post = array("category"=>$cats,"page"=>$page,"size"=>$size);
			$url = "/goods/coin/{$size}";
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
		
		
		
	}
}
