
<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:    Controller.php
// |
// | Author:   wentao_huang
// | Created:   2016-08-23
// +----------------------------------------------------------------------
class MeController extends BaseController
{

	/**
	 * 现金主页页面
	 * @author 
	 * @param
	 * @return 
	 */
	public function cashAction()
	{
		$futurestar_url = "/member/futurestar";
		$login_data = array();
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/cash.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}

		$member = $this->member();
		if (empty($member)) {
			$member['cash'] = 0;
		}

		//现金余额
		$cash_url = '/member/member_assets';
		$cash_res = array();
		if($this->curl->get_request($cash_url,'api') == 200){
		    $cash_res = $this->curl->getArrayData();
		}
		if (empty($cash_res) || empty($cash_res['cash'])) {
			$cash_res['cash'] = 0;
		}
		$cash_one = $cash_res['cash'] - $cash_res['frozen_cash'];
		$cash = sprintf("%.2f",$cash_one);

		//提现次数余额和账单记录
		$times_url = '/enchashment/index';
		$times = array();
		if($this->curl->get_request($times_url,'money_api') == 200){
		    $times = $this->curl->getArrayData();
		}
		if (empty($times)) {
			$times['fix_money'] = 50;
			$times['times'] = 0;
			$times['time'] = '';
			$times['money'] = '';
		}else{
			$times['time'] = date('Y-m-d',$times['time']);
		}

		//现金提现开关
		$setting_url = '/enchashment/getsetting';
		if($this->curl->get_request($setting_url,'money_api') == 200){
		    $setting = $this->curl->getArrayData();
		}

		//现金提现剩余次数与金额
		$moneytimes_url = '/enchashment/getmoneytimes';
		if($this->curl->get_request($moneytimes_url,'money_api') == 200){
		    $moneytimes = $this->curl->getArrayData();
		}
		//绑定银行卡
		$bank_url = '/member/bank';
		$bank = array();
		if($this->curl->post_request($bank_url,'api') == 200){
		    $bank = $this->curl->getArrayData();
		}

		if (empty($bank)) {
			$bank['is_bank'] = false;
		}

		//支付密码
		$pay_url = '/v2/account/check/payment_code';
		$pay = array();
		if($this->curl->get_request($pay_url,'api') == 200){
		    $pay = $this->curl->getArrayData();
		}
		if (!empty($pay['code']) || $pay['code'] == 1) {
			$pay['code'] = 1;
		}else{
			$pay['code'] = 2;
		}

		$this -> assign("setting",$setting);//现金提现开关
		$this -> assign("moneytimes",$moneytimes);//现金提现剩余次数与金额
		$this -> assign("cash",$cash);
		$this -> assign("member",$member);
		$this -> assign("times",$times);
		$this -> assign("bank",$bank);
		$this -> assign("code",$pay['code']);

		$this->pages->init('我的现金');
	}

	/**
	 * 现金提现页面
	 * @author 
	 * @param
	 * @return 
	 */
	public function withdrawalsAction()
	{
		//判断是否登录
		$futurestar_url = "/member/futurestar";
		$login_data = array();
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/withdrawals.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}
		//现金余额
		$cash_url = '/member/member_assets';
		$cash_res = array();
		if($this->curl->get_request($cash_url,'api') == 200){
		    $cash_res = $this->curl->getArrayData();
		}
		if (empty($cash_res) || empty($cash_res['cash'])) {
			$cash_res['cash'] = 0;
			$member_id = 0;
		}else{
			$member_id = $cash_res['member_id'];
		}
		$cash_one = $cash_res['cash'] - $cash_res['frozen_cash'];
		$cash = sprintf("%.2f",$cash_one);


		//银行卡信息
		$url = '/member/bank';
		$res = array();
		if($this->curl->post_request($url,'api') == 200){
		    $res = $this->curl->getArrayData();
		}
		if (empty($res)) {
			$res = array();
		}

		//现金提现开关
		$setting_url = '/enchashment/getsetting';
		if($this->curl->get_request($setting_url,'money_api') == 200){
		    $setting = $this->curl->getArrayData();
		}

		//现金提现剩余次数与金额
		$moneytimes_url = '/enchashment/getmoneytimes';
		if($this->curl->get_request($moneytimes_url,'money_api') == 200){
		    $moneytimes = $this->curl->getArrayData();
		}
		
		// echo "<pre>";
		// print_r($setting);exit;
		$this->assign('setting',$setting);
		$this->assign('moneytimes',$moneytimes);
		$this->assign('cash',$cash);
		$this->assign('res',$res);
		$this->assign('member_id',$member_id);

		$this->pages->init('提现');
	}

	/**
	 * 现金提现ajax
	 * @author 
	 * @param
	 * @return 
	 */
	public function withDrawAjaxAction(){
		//判断是否登录
		$futurestar_url = "/member/futurestar";
		$data = array();
		// echo "<pre>";
		// print_r($_COOKIE);exit;
		$login_data = array();
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/withdrawals.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}
		try {
			//参数验证
			if (empty($_POST)) {
				throw new Exception("无参数!");
			}

			if (empty($_POST['cash']) || empty($_POST['bankno']) || empty($_POST['bank']) || empty($_POST['name']) || empty($_POST['password']) || empty($_POST['member_id'])) {
				throw new Exception("参数缺少");
			}

			$data['cash'] = $_POST['cash'];
			$data['bankno'] = $_POST['bankno'];
			$data['bank'] = $_POST['bank'];
			$data['name'] = $_POST['name'];
			$data['mobile'] = $_POST['mobile'];
			$data['password'] = md5($_POST['password'].$_POST['member_id']);

			// $tele_pattern = '/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/';
			// if(preg_match($tele_pattern,$_POST['mobile']))
			// {
			// 	$url_m = '/enchashment/getsms';
			// 	$res = array();
			// 	$mobile = array('mobile'=>$_POST['mobile']);
			// 	if($this->curl->post_request($url_m,$mobile,'money_api') == 200){
			// 	    $res = $this->curl->getArrayData();
			// 	}
			// }

			//现金提現
			$url = '/enchashment/getmoney';
			$res = array();
			if($this->curl->post_request($url,$data,'money_api') == 200){
			    $res = $this->curl->getArrayData();
			}
			return json_encode($res);
		} catch (Exception $e) {
			return $this->failure("提现失败",400); //提现失败
			
		}
	}

	/**
	 * 账单页
	 * @author 
	 * @param
	 * @return 
	 */
	public function billAction()
	{
		//判断是否登录
		$futurestar_url = "/member/futurestar";
		$login_data = array();
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/bill.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}
		//账单
		$url = '/enchashment/getlist';
		$res = array();
		$data['limit'] = 15;
		$data['page'] = 1;
		if($this->curl->post_request($url,$data,'money_api') == 200){
		    $res = $this->curl->getArrayData();
		}

		if (empty($res)) {
			$res = '';
		}else{
			foreach ($res as $key => $val) {
				if (!empty($val['time'])) {
					$res[$key]['time'] = date('Y-m-d H:i',$val['time']);
				}
				if (!empty($val['settime'])) {
					$res[$key]['updatetime'] = date('Y-m-d H:i',$val['updatetime']);
				}
				if (!empty($val['updatetime'])) {
					$res[$key]['updatetime'] = date('Y-m-d H:i',$val['updatetime']);
				}
			}
		}

		$this->assign('res',$res);
		$this->pages->init('我的账单');
	}

	/**
	 * 账单页AJAX
	 * @author 
	 * @param
	 * @return 
	 */
	public function billAjaxAction()
	{
		try{
			//判断用户是否登录
			$futurestar_url = "/member/futurestar";
			$login_data = array();
			if($this->curl->get_request($futurestar_url,'api') == 200){
			    $login_data = $this->curl->getArrayData();
			}
			if ($login_data['is_login'] != 1) {
				$url = $this->config->url;
				$base_url = $url['url_m'].'/me/bill.html';
				header("Location:/logins/login.html?return_url=".base64_encode($base_url));
			}
			//账单
			$url = '/enchashment/getlist';
			$data = $_POST;
			if (empty($data['limit'])) {
				$data['limit'] = 10;
			}
			if (empty($data['page'])) {
				throw new Exception("3");
			}
			$res = array();
			if($this->curl->post_request($url,$data,'money_api') == 200){
			    $res = $this->curl->getArrayData();
			}

			if (empty($res)) {
				$res = '';
			}else{
				foreach ($res as $key => $val) {
					if (!empty($val['time'])) {
						$res[$key]['time'] = date('Y-m-d H:i',$val['time']);
					}
					if (!empty($val['settime'])) {
						$res[$key]['updatetime'] = date('Y-m-d H:i',$val['updatetime']);
					}
					if (!empty($val['updatetime'])) {
						$res[$key]['updatetime'] = date('Y-m-d H:i',$val['updatetime']);
					}
				}
			}
			$this->success("成功",$res); //成功
		} catch (Exception $e) {
			$this->failure($e->getMessage(),200); //失败
			
		}
		
	}
	public function billdetailsAction()
	{
		//判断用户是否登录
		$login_data = array();
		$futurestar_url = "/member/futurestar";
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/billdetails.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}

		$res = $this->getList();
		$this->assign('data',$res);
		$this->pages->init('账单详情');
	}

	public function billrechargeAction()
	{
		//判断用户是否登录
		$login_data = array();
		$futurestar_url = "/member/futurestar";
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/billrecharge.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}

		$res = $this->getList();
		$this->assign('data',$res);
		$this->pages->init('账单充值详情');
	}

	public function withdrawalsdetailsAction()
	{
		//判断用户是否登录
		$login_data = array();
		$futurestar_url = "/member/futurestar";
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/me/withdrawalsdetails.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}

		$res = $this->getList();
		$this->assign('data',$res);
		$this->pages->init('提现详情');
	}

	/**
	 * 账单详情接口调用
	 * @author 
	 * @param
	 * @return 
	 */
	public function getList(){
		$data = $_GET;
		if (empty($data['type']) || empty($data['type'])) {
			return $res = '';
		}
		//账单
		$url = '/enchashment/getinfo';
		$res = array();
		if($this->curl->post_request($url,$data,'money_api') == 200){
		    $res = $this->curl->getArrayData();
		}

		if (empty($res)) {
			$res = '';
		}else{
			$res['time'] = date('Y-m-d H:i',$res['time']);
			if (!empty($res['settime'])) {
				$res['settime'] = date('Y-m-d H:i',$res['settime']);
			}
			if (!empty($res['updatetime'])) {
				$res['updatetime'] = date('Y-m-d H:i',$res['updatetime']);
			}
			if (!empty($res['f_id'])) {
				$res['fid'] = $res['f_id'];
			}
			if (!empty($res['pic'])) {
				foreach ($res['pic'] as $k => $v) {
					if (!empty($v)) {
						$res['pic'][$k] = Common::get_image_url($this->config,$v);
					}
				}
			}
		}

		return $res;
	}



	public function customerserviceAction()
	{
		$this->pages->init('申请售后');
	}

	public function confirmorderAction()
	{
		$this->pages->init('确认订单');
	}

	public function member()
	{
	    $member_url = '/member';
	    $member = array();
	    if($this->curl->get_request($member_url,'api') == 200){
	        $member = $this->curl->getArrayData();
	        $member['avatar'] = Common::get_image_url($this -> config,$member['avatar'], '80', '80', 'avatar');
	    }
	    return $member;
	    
	}
}