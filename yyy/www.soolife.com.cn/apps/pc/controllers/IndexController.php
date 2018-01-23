<?php
// +----------------------------------------------------------------------
// | 企业网首页控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author:    Elliot
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;

class IndexController extends BaseController
{
	public $index = 'cn.soolife.intranet.index';
	public $basc_time = '';
	public function indexAction() {
		$this->referInComing($this->basc_time);
    	$this -> page->setContentTitle('');
		$this -> page -> init('如此生活加盟_如此生活加盟费多少_如此生活加盟怎么样_鸿惠上海信息技术服务有限公司', $this->index);
	}
}
