<?php
// +----------------------------------------------------------------------
// | 公司动态控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   dynamicController.php
// |
// |
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;

class DynamicController extends BaseController
{
	public $dynamic = 'cn.soolife.intranet.dynamic';
	public function dynamicAction() {

		$this -> page -> setContentTitle('公司动态','','dynamic/dynamic.html');
		$this -> page -> init('公司动态', $this->dynamic);
	}

}
