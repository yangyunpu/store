<?php
// +----------------------------------------------------------------------
// | 商品操作的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   GoodsController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-09-14
// +----------------------------------------------------------------------
class GoodsController extends BaseController {
	
	/**
	 * 添加商品
	 * @author tony wang 2016-09-14
	 * @return view
	 * @link /goods/add.html
	 */
	public function addAction() {
		
		$this -> page -> init('添加商品');
	}
	public function editAction() {
		
		$this -> page -> init('编辑');
	}
	public function removeAction() {
		
		$this -> page -> init('删除');
	}
	public function sortAction() {
		
		$this -> page -> init('排序');
	}
	public function moneydetailAction() {
		
		$this -> page -> init('排序');
	}
	public function listsAction() {
		
		$this -> page -> init('浏览页');
	}
}
