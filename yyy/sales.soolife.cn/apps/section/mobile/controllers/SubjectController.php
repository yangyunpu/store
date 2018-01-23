<?php
// +----------------------------------------------------------------------
// |招商如此生活控制类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   BusinessController.php
// | Author: Dandan_Sun
// | Created: 2016-11-04 13:38:32
// +----------------------------------------------------------------------
namespace Soolife\Sales\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Services\BusinessService;
class SubjectController extends BaseController{
	public function mobileactivityAction(){
		// var_dump(111111);exit; 
		$this -> page -> init('首页','','','mobile'); 
	}
	public function pc_activityAction(){
		$this -> page -> init('首页','','','mobile'); 
	}
}