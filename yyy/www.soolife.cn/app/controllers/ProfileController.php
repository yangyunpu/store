<?php
// +----------------------------------------------------------------------
// | 上传头像和修改信息的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   GoodsController.php
// |
// | Author: cunyang liu 
// | Created:   2016-09-14
// +----------------------------------------------------------------------
class ProfileController extends BaseController {
	

	public function profileAction() {
		
		$this -> page -> init('修改信息');
	}
	public function avatarAction() {
		
		$this -> page -> init('上传头像');
	}
	public function infoAction() {
		
		$this -> page -> init('修改信息');
	}
}
