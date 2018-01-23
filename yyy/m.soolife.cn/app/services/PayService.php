<?php
// +----------------------------------------------------------------------
// | 订单支付的服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   CartsService.php
// |
// | Author: Luo Qing
// | Created:   2016-08-01
// +----------------------------------------------------------------------

class PayService extends BaseService {
	/**
	 * 订单支付（支持多个订单合并支付）
	 * @author Luo Qing 2016-08-01
	 * @param $member_id int 会员编号
	 * POST v1/order/pay
	 */	
	function payment($ordersid){
		$menberid = $this -> user -> getId();
		$data = array("memberid" => $menberid,"orderid" => $ordersid);
		$url = "/v1/pay/orderamount";
		$curl = $this -> curl;
		if($curl -> post_request($url,$data,'pay') == 200){
			$data = $curl -> getJsonData();
			return $data;
		}
		//var_dump($curl->getResponseText());exit;
		return null;
	}
	
	/**
	 * 发送验证码
	 * @author Luo Qing 2016-08-17
	 * @param $member_id int 会员编号
	 * GET v1/sms/verify/{phone}
	 */	
	 function reg_result($phone) {
		$url = "/v1/sms/verify/{$phone}";
		$curl = $this -> curl;
		if ($curl -> get_request($url) == 200) {
			return null;
		}
		//var_dump($curl -> getResponseText());exit;
		return $curl -> getJsonData();
	}
	
	/**
	 * 提交，修改支付密码
	 * @author Luo Qing 2016-08-17
	 * @param $member_id int 会员编号
	 * PUT v1/member/safety/paypasswd
	 */	
	 function paymentcode($data){
	 	$url = "/v1/member/safety/paypasswd";
		$curl = $this -> curl;
		if($curl -> put_request($url,$data) == 200){
			return $curl -> getJsonData();
		}
		return null;
	 }
	
	/**
	 * wexinpay  微信支付
	 * @author miaolei 2017-4-26
	 * @param $member_id int 会员编号
	 * POST v1/pay/weixin/native
	 */	
	function weixinpay($orderid){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "www.soolife.cn";
		//$returnurl = "https://i.soolife.cn/orders/list/index.html";
		$returnurl = "http://m.test.soolife.net/lottery/win.html?m=".$orderid;
		$data = array("orderid"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/weixin/native";
		if($curl -> post_request($url,$data,"pay") == 200){
			return $curl -> getJsonData();
		}
		return null;
	}
	
	/**
	 * wexinpayweb  微信移动支付
	 * @author miaolei 2017-4-26
	 * @param $member_id int 会员编号
	 * POST v1/pay/weixin/native
	 */	
	function wexinpayweb($orderid,$openid,$ip,$url){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "www.soolife.cn";
		//$returnurl = "https://i.soolife.cn/orders/list/index.html";
		$returnurl = $url."/pay/paysuccess.html?m=".$orderid;
		$data = array("clientip"=>$ip,"openid"=>$openid,"mainOrderNo"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/weixin/jsapi";
/*		$code = $curl -> post_request($url,$data,'',"pay");
		$data = $curl -> getResponseText();
		var_dump($code);
		echo "<pre>";print_r($data);die;*/
		if($curl -> post_request($url,$data,"pay") == 200){
			// var_dump($curl->getResponseText());exit;
			return $curl -> getJsonData();
		}
		return null;
	}
		
		
	/**
	 * alipay
	 * @author miaolei 2017-4-26
	 * @param $member_id int 会员编号
	 * POST v1/pay/alipay/pc
	 */	
	function alipay($orderid){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "www.soolife.cn";
		//$returnurl = "https://i.soolife.cn/orders/list/index.html";
		$returnurl = "http://m.test.soolife.net/lottery/win.html?m=".$orderid;
		$data = array("mainOrderNo"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/alipay/pc";		
		if($curl -> post_request($url,$data,"pay") == 200){
			return $curl -> getJsonData();
		}
		return null;
	}
	
	/**
	 * alipayweb
	 * @author miaolei 2017-4-26
	 * @param $member_id int 会员编号
	 * POST v1/pay/alipay/wap
	 */	
	function alipayweb($orderid,$url){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "www.soolife.cn";
		//$returnurl = "https://i.soolife.cn/m/orders.html";
		$returnurl = $url."/i/money/wallet.html";
		$data = array("mainOrderNo"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/alipay/wap";
		// echo "<pre>";print_r($this->curl->post_request($url,$data,'',"pay"));
		// $data = $this->curl->getResponseText();
		// echo"<pre>";print_r($data);die;
		if($this->curl->post_request($url,$data,"pay") == 200){
			return $curl -> getJsonData();
		}
		return null;
	}
	
	/**
	 * walletpay(余额支付)
	 * @author Luo Qing 2016-08-02
	 * @param $member_id int 会员编号
	 * POST v1/pay/unionpay/pc
	 */	
	function walletpay($password,$orderid){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "www.soolife.cn";
		//$returnurl = "www.soolife.cn";
		$returnurl = "http://m.test.soolife.net/lottery/win.html?m=".$orderid;
		$password = MD5($password.$memberid);
		$data = array("password"=>$password,"orderid"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/wallet/pc";
		if($curl -> post_request($url,$data,"pay") == 200){
			return $curl -> getJsonData();
		}
		return $curl -> getJsonData();
	}
	
	
	/**
	 * 获取会员手机号码
	 * @author Luo Qing 2016-08-10
	 * @param $member_id int 会员编号
	 * GET v1/member/{id}
	 */	
	function phone(){
		$id = $this -> user -> getId();
		$url ="/v1/member/{$id}";
		$curl = $this -> curl;
		if($curl -> get_request($url) == 200){
			return $curl -> getJsonData();
		}
		return null;
	}
	
	/**
	 * yinlianpay
	 * @author Luo Qing 2016-08-02
	 * @param $member_id int 会员编号
	 * POST v1/pay/unionpay/pc
	 */	
	function yinlianpay($orderid){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "http://www.soolife.cn";
		//$returnurl = "https://i.soolife.cn/orders/list/index.html";
		$returnurl = "http://m.test.soolife.net/lottery/win.html?m=".$orderid;
		$data = array("orderid"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/unionpay/pc";
		if($curl -> post_request($url,$data,"pay") == 200){
			return ($curl->getResponseText());
		}
		return null;
	}
	
	/**
	 * yinlianpayweb
	 * @author Luo Qing 2016-08-02
	 * @param $member_id int 会员编号
	 * POST v1/pay/unionpay/wap
	 */	
	function yinlianpayweb($orderid){
		$memberid = $this -> user -> getId();
		$curl = $this ->curl;
		$type = "1";
		$showurl = "http://www.soolife.cn";
		//$returnurl = "https://i.soolife.cn/m/orders.html";
		$returnurl = "http://m.test.soolife.net/lottery/win.html?m=".$orderid;
		$data = array("orderid"=>$orderid,"type"=>$type,"memberid"=>$memberid,"showurl"=>$showurl,"returnurl"=>$returnurl);
		$url = "/v1/pay/unionpay/wap";
		//print_r($data);exit;
		if($curl -> post_request($url,$data,"pay") == 200){
			return ($curl->getResponseText());
		}
		return null;
	}
	
	
}
	