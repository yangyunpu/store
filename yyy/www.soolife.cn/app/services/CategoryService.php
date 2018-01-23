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

class CategoryService extends BaseService {

	/**
	 * 核心分类
	 */
	public function Core($code) {

	}

	/**
	 * 映射分类详细资料
	 */
	public function Details($id) {

	}

	/**
	 * 网站分类
	 * @author tony wang
	 */
	public function Website() {
		$key = "category:menus:pc:all";
		return $this->Menus($key);
	}

	/**
	 * 手机网站分类
	 * @author tony wang
	 */
	public function Mobile() {
		$key = "category:menus:mobile:all";
		return $this->Menus($key);
	}

	/**
	 * 海外精品分类
	 * @author tony wang
	 */
	public function Overseas() {
		$key = "category:menus:overseas:all";
		return $this->Menus($key);
	}

	/**
	 * 虚拟商品分类
	 * @author tony wang
	 * @return array
	 */
	public function Virtual() {
		$key = "category:menus:virtual:all";
		return $this->Menus($key);
	}

	/**
	 * 映射分类 
	 * @author tony wang 2016-08-10
	 * @return array
	 */
	private function Menus($key) {
		$data = $this->redis->read($key, 'settings');
		if (!isset($data))
		{
			$url = "/category/website";
			switch ($key) {
				case 'category:menus:pc:all' :
					$url = "/category/website";
					break;
				case 'category:menus:mobile:all' :
					$url = "/category/website";
					break;
				case 'category:menus:overseas:all' :
					$url = "/category/website";
					break;
				case 'category:menus:virtual:all' :
					$url = "/category/website";
					break;
			}
			if ($this -> curl -> get_request($url) == 200) {
				$data = $this -> curl -> getArrayData();
			}
		}
		return $data;
	}

}
