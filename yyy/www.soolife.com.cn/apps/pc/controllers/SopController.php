<?php
// +----------------------------------------------------------------------
// | 商家入驻控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   SopController.php
// |
// | Author:    Elliot
// | Created:   2017-06-26
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\AuthController;
use Soolife\Member\Librarys\WebCurl;
use Soolife\Member\Services\SopService;

class SopController extends AuthController
{
	private $index = 'cn.soolife.intranet.sop';
	# home
	public function indexAction() {
		$member = $this->member;
		if ($this->request->isPost()){
			$key = 'sop:submit:'.$member->member_id;
			$res = $this->redis->read($key,'other');
			if (!$res) {
				try{
					$data = $this->request->getPost();
					$last_data['online_type'] = $data['online_type'];
					$last_data['offline_item'] = $data['offline_item'];
					$last_data['service_cost'] = $data['service_cost'];
					$last_data['personal_data'] = $data['personal_data'];
					$last_data['signed'] = $data['signed'];
					$this->redis->write($key,$member->member_id,'other',3);
					$service = new SopService();
					$result = $service -> formDataSubmit($last_data, $member);
	                return $this->success('申请已提交，请耐心等待审核结果');
				}catch(\Exception $e){
					return $this->failure($e->getMessage(),400,'',$e->getCode());
				}
			} else {
				return $this->failure('不可重复提交信息',400,'');
			}
		}
		$service = new SopService();
		$result = $service -> auditResult($member);
		if ($result) {
			header("Location: /sop/shopstatus.html");
		}
    	$this -> page->setContentTitle('');
		$this -> page -> init('商家入驻', $this->index);
	}
	// 修改入驻提交资料
	public function dataEditAction() {
		$member = $this->member;
		$service = new SopService();

		if ($this->request->isPost()){
			$key = 'sop:submit:'.$member->member_id;
			$res = $this->redis->read($key,'other');
			if (!$res) {
				try{
					$data = $this->request->getPost();
					$last_data['apply_id'] = $data['apply_id'];
					$last_data['online_type'] = $data['online_type'];
					$last_data['offline_item'] = $data['offline_item'];
					$last_data['service_cost'] = $data['service_cost'];
					$last_data['personal_data'] = $data['personal_data'];
					$last_data['signed'] = $data['signed'];
					$this->redis->write($key,$member->member_id,'other',3);

					$result = $service -> formDataEdit($last_data, $member);
		            return $this->success('修改完成，请耐心等待审核结果');
				}catch(\Exception $e){
					return $this->failure($e->getMessage(),400,'',$e->getCode());
				}
			}else{
				return $this->failure('不可重复提交信息',400,'');
			}
		}

		$result = $service->getSignData($member->member_id);
		if (empty($result)){
			header("Location: /sop/index.html");
		}
		$result['servicecontent']['offline_item'] = $this->newData($result['servicecontent']['offline_item']);

		$this->assign('region',json_encode($result['region_arr']));
		$this->assign('result',$result);
		$this -> page->setContentTitle('');
		$this -> page -> init('资料修改', $this->index);
		$this->display('sop/edit');
	}
	// 协议页(线上渠道)
	public function protocolsAction() {
    	$this -> page->setContentTitle('');
		$this -> page -> init('商家协议', $this->index);
	}
        // 协议页(全渠道)
	public function protocolsallAction() {
    	$this -> page->setContentTitle('');
		$this -> page -> init('商家协议', $this->index);
	}
	// 审核状态
	public function shopstatusAction() {
		$member = $this->member;
		$service = new SopService();
		$result = $service -> auditResult($member);
		if (!in_array($result['status'],['0','1','2','9'])) {
			header("Location: /sop/index.html");
		}
		$this->assign('result',$result);
    	$this -> page->setContentTitle('');
		$this -> page -> init('审核状态', $this->index);
	}
	// 获取地区信息
	public function addressAction() {
		$pid = $this->request->getPost('pid');
		$url = '/member/address/'.$pid;
		$data = array();
		$curl = new WebCurl();
		$code = $curl->get_request($url,'php_api');
		$code == 200 && $data = $curl->getArrayData();
		return $this->json($data);
	}
	public function downloadAction()
	{
		$file = ROOT_PATH.'/public/onlineagreement.pdf';
		$arr = explode('/',$file);
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="电子商务平台服务(线上)合作协议.pdf"');
		readfile($file);
	}
	public function downloadAllAction()
	{
		$file = ROOT_PATH.'/public/alllineagreement.pdf';
		$arr = explode('/',$file);
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="电子商务平台服务(全渠道)合作协议.pdf"');
		readfile($file);
	}

	public function newData($data)
	{
		$new_arr = Array (
                "0" => Array("store_id" => 1, "type" => '', "num" => ''),
                "1" => Array("store_id" => 2, "type" => '', "num" => ''),
                "2" => Array("store_id" => 3, "type" => '', "num" => ''),
                "3" => Array("store_id" => 4, "type" => '', "num" => ''),
                "4" => Array("store_id" => 5, "type" => '', "num" => ''),
			);
        if ($data) {
        	foreach ($data as $k => $v) {
        		foreach ($new_arr as $key => &$value) {
        			if ($v['store_id'] == $value['store_id']) {
        				$value['type'] = $v['type'];
        				$value['num']  = $v['num'];
        			}
        		}
        	}
        }
        return $new_arr;
	}
}
