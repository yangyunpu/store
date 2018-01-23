<?php
// +----------------------------------------------------------------------
// | 三方登录
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// | Author: L.Q 
// | Created: 2016-09-19
// +----------------------------------------------------------------------


class ThirdLoginService extends BaseService{
	//用户access_token
	private $access_token;
	//用户openID
	private $openID;
	// [PHP] POST 执行三方登录 {openid:"",acctss_token:""} （检测用户绑定状态） 如果尚未绑定，返状态码400，id:101
	private $instant_item_type;



			
	//WeChat获取access_token
	public function wechat($ordersid,$sid,$pay){
		$we_appid = $this->config->oauth->appid;
		$redirect_uri = urlencode($this->config->url->url_money.'/pay/payway.html?orderid='.$ordersid.'&sid='.$sid.'&pay='.$pay);
		$url = "https://orders.soolife.cn/get-weixin-code.html?appid={$we_appid}&scope=snsapi_base&redirect_uri={$redirect_uri}";
		header("location:{$url}");
		exit;
		// $redirect_uri = urlencode('https://orders.soolife.cn/m/order/orderpay.html?order_id='.$ordersid.'&sid=1000562');
		$response_type = 'code';
		$scope = 'snsapi_base';	
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$we_appid}&redirect_uri={$redirect_uri}&response_type={$response_type}&scope={$scope}#wechat_redirect";
		header("location:{$url}");
	}	
	
	public function get_user_auth(){
	
		$code = $this->get_code();
		if($code)
			{
			$res = $this-> get_token($code);
			if(isset($res['access_token']) && isset($res['openid'])){
				$this->access_token = $res['access_token'];
				$this->openid = $res['openid'];
				return array(
					'access_token'=>$this->access_token,
					'openid' => $this->openid
					);
				}
			}
			return false;
		}
	
	//获取code 目前
	public function get_code(){
		$code = $this->request->get('code');
		return $code ? $code : false;
	}
	
	//获取access token
	public function get_token($code){
		$appid = $this->config->oauth->appid;;
		$secret = $this->config->oauth->appkey; 
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
		$res = $this->get_url_contents($url);
		$we_arr = json_decode($res,true);   //获取基本的用户信息
		//var_dump($we_arr);exit;
		return $we_arr;
		}
	
	
	function get_url_contents($url)
	{
	    if (ini_get('allow_url_fopen') == '1')
	        return file_get_contents($url);

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    $result =  curl_exec($ch);
	    curl_close($ch);
		if(empty($result)) exit("need 'curl' OR 'allow_url_fopen'");
	    return $result;
	}
		
			
		
}
	