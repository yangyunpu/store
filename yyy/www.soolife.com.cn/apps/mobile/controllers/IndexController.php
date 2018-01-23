<?php
// +----------------------------------------------------------------------
// | Models版 会员中心的控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Luo Qing
// | Created:   2016-05-23
// +----------------------------------------------------------------------
namespace Soolife\Member\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Librarys\Common;

class IndexController extends BaseController {

	public function indexAction() {
		$this -> page -> init('如此生活-我的生活','','', 'mobile', '', '', 'layout_main');
	}

}
