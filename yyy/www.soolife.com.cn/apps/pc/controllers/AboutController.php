<?php
// +----------------------------------------------------------------------
// | 关于我们控制器
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

class AboutController extends BaseController
{
	public $about = 'cn.soolife.intranet.about';
	public $url = 'about/companyProfile.html';
	public function coreTeamAction() {

		$this -> page -> setContentTitle('关于我们', '核心团队',$this->url);
		$this -> page -> init('关于我们', $this->about);
	}
	public function enterpriseHonorAction() {

		$this -> page -> setContentTitle('关于我们', '企业荣誉',$this->url);
		$this -> page -> init('关于我们', $this->about);
	}
	public function futureTendencyAction() {

		$this -> page -> setContentTitle('关于我们', '未来展望',$this->url);
		$this -> page -> init('关于我们', $this->about);
	}
	public function cultureAction() {

		$this -> page -> setContentTitle('关于我们', '文化理念',$this->url);
		$this -> page -> init('关于我们', $this->about);
	}

	public function companyProfileAction() {

		$this -> page->setContentTitle('关于我们', "公司简介",$this->url);
		$this -> page -> init('关于我们', $this->about);
	}
	public function developmentHistoryAction() {

		$this -> page->setContentTitle('关于我们', "发展历程",$this->url);
		$this -> page -> init('关于我们', $this->about);
	}
	public function makeSpeechAction() {

		$this -> page->setContentTitle('关于我们', "董事长致辞",$this->url);
		$this -> page -> init('关于我们', $this->about);
	}

}
