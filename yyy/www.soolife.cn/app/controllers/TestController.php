<?php
// +----------------------------------------------------------------------
// | 主页面的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
class TestController extends BaseController {
	public function sheetAction() {
		$code = $this->request->get('code');
		$this->logger->info($code);
		echo $code;
	}

	public function notFoundAction() {
		echo "404";
	}
}
