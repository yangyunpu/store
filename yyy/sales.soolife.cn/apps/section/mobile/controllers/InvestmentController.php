<?php
// +----------------------------------------------------------------------
// |招商页面
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   InvestmentController.php
// | Author: Dandan_Sun
// | Created: 2017-07-20 18:53:01
// +----------------------------------------------------------------------
namespace Soolife\Sales\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Services\InvestmentService;

class InvestmentController extends BaseController
{

	/**
	* 品牌招商页面
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function indexAction(){
		$service = new InvestmentService();
		$num = $service->index();
		$this->assign("num",$num);
		$this->display("investment/ads");
		$this -> page -> init('品牌招商','','','mobile');
	}


	/**
	* 品牌招商页面提交数据
	* @return 0 成功  1失败
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function addAction(){
		$name = $this->request->getPost('name');
		$iphone = $this->request->getPost('iphone');
		$compny = $this->request->getPost('compny');
		$types = $this->request->getPost('types');
                $tid = $this->request->getPost('tid');
		$key = 'investment:submit:'.$compny;
		$res = $this->redis->read($key,'other');
		if(!$res){
			$service = new InvestmentService();
			$data = $service->add($types,$name,$iphone,$compny,$tid);
			if($data == 1){
				$this->success("成功",$data);
			}else{
				$this->failure("网络异常,请检查网络");
			}
		} else {
			return $this->failure('不可重复提交信息');
		}
	}
   	/**
	* 品牌加盟，拿下属于你的势
	* @return num 填写招商数据的数量
	* @param
	* @author junjie_lei
	* @date 2017-09-19 18:52:45
	*/
	function trademarkAction(){
		$tid = $this->request->get("tid","int",0);
		// $tid = 10 ;
		$url = "/v2/homepage/feedback/".$tid."/1";
        $res = '';
        if ($this->curl->get_request($url,'php_api') == 200) {
            $res = $this->curl->getArrayData();
            // print_r($res);exit;
        }
        $type = 2;
		$service = new InvestmentService(); 
		$num = $service->getNum($type);
		// print_r($num);exit;
		$this->assign("num",$num);
		$this->assign("res",$res);
		$this->display("investment/trademark");
		$this -> page -> init('品牌招商','','','mobile');
	}
	   	/**
	* 体验店加盟，拿下属于你的名
	* @return num 填写招商数据的数量
	* @param
	* @author junjie_lei
	* @date 2017-09-19 10:52:45
	*/
	function feelshopAction(){
		$tid = $this->request->get("tid","int",0);
		// $tid = 10 ;
		$url = "/v2/homepage/feedback/".$tid."/1";
        $res = '';
        if ($this->curl->get_request($url,'php_api') == 200) {
            $res = $this->curl->getArrayData();
            // print_r($res);exit;
        }
        $type = 1;
		$service = new InvestmentService();
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->assign("res",$res);
		$this->display("investment/feelshop");
		$this -> page -> init('体验店加盟','','','mobile');
	}

	/**
	* 体验店加盟
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function brandAction(){
		$tid = $this->request->get("tid","int",0);
		 // $tid = 2 ;
		$url = "/v2/homepage/feedback/".$tid."/4";
        $res = '';
         // print_r($this->curl->get_request($url,'php_api'));exit;
        if ($this->curl->get_request($url,'php_api') == 200) {
            $res = $this->curl->getArrayData();
            // print_r($res);exit;
        }
		$service = new InvestmentService();
		$type = 1;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->assign("res",$res);
		$this->display("investment/brand");
		$this -> page -> init('邀请函','','','mobile');
	}

	/**
	* 品牌招商
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function leagueAction(){
		$service = new InvestmentService();
		$type = 2;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->display("investment/league");
		$this -> page -> init('品牌招商','','','mobile');
	}



	/**
	* 城市代理
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function agencyAction(){
		$service = new InvestmentService();
		$type = 3;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->display("investment/agency");
		$this -> page -> init('城市代理','','','mobile');
	}


	/**
	* 品牌招商
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-09-8 18:52:45
	*/
	function generalizeAction(){
		$service = new InvestmentService();
		$type = 4;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->display("investment/generalize");
		$this -> page -> init('加盟推广','','','mobile');
	}

	/**
	* 品牌招商
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-09-11 18:52:45
	*/
	function policyAction(){
		$service = new InvestmentService();
		$type = 5;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->display("investment/policy");
		$this -> page -> init('城市代理政策','','','mobile');
	}

	/**
	* 品牌招商
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-09-11 18:52:45
	*/
	function invitationAction(){
		$service = new InvestmentService();
		$type = 6;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->display("investment/invitation");
		$this -> page -> init('邀您共谋大事','','','mobile');
	}

	/**
	* 品牌招商页面提交数据
	* @return 0 成功  1失败
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function insertAction(){
		$type = $this->request->getPost('type');
		$name = $this->request->getPost('name');
		$iphone = $this->request->getPost('iphone');
		$company = $this->request->getPost('company');
		$inviter = $this->request->getPost('inviter');
		$key = 'investment:submit:'.$company;
		$res = $this->redis->read($key,'other');
		if(!$res){
			$service = new InvestmentService();
			$data = $service->insert($type,$name,$iphone,$company,$inviter);
			if($data == 1){
				$this->success("成功",$data);
			}else{
				$this->failure("网络异常,请检查网络");
			}
		} else {
			return $this->failure('不可重复提交信息');
		}
	}
		/**
	* 品牌招商
	* @return num 填写招商数据的数量
	* @param
	* @author Dandan_Sun
	* @date 2017-07-20 18:52:45
	*/
	function brandInvestmentAction(){
		/*$service = new InvestmentService();
		$type = 1;
		$num = $service->getNum($type);*/
		/*$this->assign("num",$num);*/
		$this->display("investment/brandInvestment");
		$this -> page -> init('品牌招商','','','mobile');
	}
    function promotionAction(){
		$service = new InvestmentService();
		$type = 1;
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->display("investment/promotion");
		$this -> page -> init('品牌招商','','','mobile');
	}
	//城市招商城市代理
	function cityagentAction(){
	
		$tid = $this->request->get("tid","int",0);
		// $tid = 10 ;
		$url = "/v2/homepage/feedback/".$tid."/1";
        $res = '';
        if ($this->curl->get_request($url,'php_api') == 200) {
            $res = $this->curl->getArrayData();
            // print_r($res);exit;
        }
        $type =3;
		$service = new InvestmentService(); 
		$num = $service->getNum($type);
		$this->assign("num",$num);
		$this->assign("res",$res);
		
		$this->display("investment/cityagent");
		$this -> page -> init('城代招商','','','mobile');
	}
}