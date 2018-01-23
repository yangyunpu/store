<?php
// +----------------------------------------------------------------------
// | 意向消息首页控制器
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
class ReportController extends BaseController
{
	public $report = 'cn.soolife.intranet.report';
	public $url = 'report/brandActivity.html';//dynamic/dynamic.html
	public function brandActivityAction() {

		$this -> page -> setContentTitle('品牌报道', '品牌活动',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	public function mediaInterviewsAction() {

		$this -> page -> setContentTitle('品牌报道', '媒体专访',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	public function videoCoverageAction() {

		$this -> page -> setContentTitle('品牌报道', '视频报道',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	public function newsAction() {

		$this -> page -> setContentTitle('品牌报道', '内容报道',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	public function newsspinAction() {

		$this -> page -> setContentTitle('品牌报道', '内容报道',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	public function newscarAction() {

		$this -> page -> setContentTitle('品牌报道', '内容报道',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	public function newsfirstAction() {

		$this -> page -> setContentTitle('品牌报道', '内容报道',$this->url);
		$this -> page -> init('品牌报道', $this->report);
	}
	
	


	public function newsthailandAction() {

		$this -> page -> setContentTitle('公司动态', '内容报道','dynamic/dynamic.html');
		$this -> page -> init('内容报道', 'cn.soolife.intranet.dynamic');
	}
	public function newsvisitAction() {

		$this -> page -> setContentTitle('公司动态', '内容报道','dynamic/dynamic.html');
		$this -> page -> init('内容报道', 'cn.soolife.intranet.dynamic');
	}
	
	public function newsIeatherAction() {

		$this -> page -> setContentTitle('公司动态', '内容报道','dynamic/dynamic.html');
		$this -> page -> init('内容报道', 'cn.soolife.intranet.dynamic');
	}
	public function newsCommerceAction() {

		$this -> page -> setContentTitle('公司动态', '内容报道','dynamic/dynamic.html');
		$this -> page -> init('内容报道', 'cn.soolife.intranet.dynamic');
	}
	public function newsGloryAction() {

		$this -> page -> setContentTitle('公司动态', '内容报道','dynamic/dynamic.html');
		$this -> page -> init('内容报道', 'cn.soolife.intranet.dynamic');
	}
	public function leadervisitAction() {

		$this -> page -> setContentTitle('公司动态', '内容报道','dynamic/dynamic.html');
		$this -> page -> init('内容报道', 'cn.soolife.intranet.dynamic');
	}
}