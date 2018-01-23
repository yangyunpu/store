<?php
// +----------------------------------------------------------------------
// | 品牌合作首页控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   PartnerController.php
// |
// | Author:    liucunyang
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Services\PartnerService;

class PartnerController extends BaseController
{
	public $partner ='cn.soolife.intranet.partner';
	public $url = 'partner/newcityagent.html';
	public $basc_time = '';
	// public function cityagentAction() {
	// 	if($this->request->isPost()){
	// 		try{
	// 			$data = $this->request->getPost();
	// 			$service = new PartnerService();
	// 			$result = $service->Receive($data);
	// 			return $this->success('提交成功');
	// 		}catch(Exception $e){
	// 			return $this->failure("提交失败,原因：{$e->getMessage()}");
	// 		}
	// 	}else{
	// 		$this -> page->setContentTitle('品牌合作', "城市代理加盟合作",$this->url);
	// 		$this -> page -> init('品牌合作', $this->partner);
	// 	}
	// }
	// public function investAction() {
	// 	$this -> page->setContentTitle('品牌合作', "体验店投资加盟合作",$this->url);
	// 	$this -> page -> init('品牌合作', $this->partner);
	// }
	// public function tenantsAction() {
	// 	$this -> page->setContentTitle('品牌合作', "品牌商家入驻合作",$this->url);
	// 	$this -> page -> init('品牌合作', $this->partner);
	// }


	public function newcityagentAction() {
		if($this->request->isPost()){
			try{
				$data = $this->request->getPost();
				$service = new PartnerService();
				$result = $service->Receive($data);
				return $this->success('提交成功');
			}catch(Exception $e){
				return $this->failure("提交失败,原因：{$e->getMessage()}");
			}
		}else{
			// 咨询来电
			$this->referInComing($this->basc_time);
			// echo '<pre>';
			// print_r($arr);exit;
			$this -> page->setContentTitle('品牌合作', "城市代理加盟合作",$this->url);
			$this -> page -> init('品牌合作', $this->partner);
		}
	}
	public function brandinvestmentAction() {
		if($this->request->isPost()){
			try{
				$data = $this->request->getPost();
				$service = new PartnerService();
				$result = $service->Receive($data);
				return $this->success('提交成功');
			}catch(Exception $e){
				return $this->failure("提交失败,原因：{$e->getMessage()}");
			}
		}else{
			// 咨询来电
			$this->referInComing($this->basc_time);
			$this -> page->setContentTitle('品牌合作', "品牌招商代理",$this->url);
			$this -> page -> init('品牌合作', $this->partner);
		}
	}
	public function experienceAction() {
		if($this->request->isPost()){
			try{
				$data = $this->request->getPost();
				$service = new PartnerService();
				$result = $service->Receive($data);
				return $this->success('提交成功');
			}catch(Exception $e){
				return $this->failure("提交失败,原因：{$e->getMessage()}");
			}
		}else{
			// 咨询来电
			$this->referInComing($this->basc_time);
			$this -> page->setContentTitle('品牌合作', "体验店投资加盟合作",$this->url);
			$this -> page -> init('品牌合作', $this->partner);
		}
	}
}