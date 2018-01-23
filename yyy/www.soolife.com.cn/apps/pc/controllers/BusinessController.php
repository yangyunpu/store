<?php
// +----------------------------------------------------------------------
// | 业务模式控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   AboutController.php
// |
// | Author:    Elliot
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;

class BusinessController extends BaseController
{
	public $business = 'cn.soolife.intranet.business';
	public $url = 'business/businessModel.html';
	public function businessModelAction() {
		$this -> page->setContentTitle('业务模式', "商业模式介绍",$this->url);
		$this -> page -> init('业务模式', $this->business);
	}
	public function experienceCenterAction() {
		$this -> page->setContentTitle('业务模式', "体验店介绍",$this->url);
		$this -> page -> init('业务模式', $this->business);
	}
	public function platformIntroductionAction() {
		$this -> page->setContentTitle('业务模式', "平台介绍",$this->url);
		$this -> page -> init('业务模式', $this->business);
	}
}