<?php
// +----------------------------------------------------------------------
// | 三方登录
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// | Author: Jinlong_Xie <soosim@qq.com>
// | Created: 2016-08-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;

class ThirdLoginService extends BaseService{
	//用户access_token
	private $access_token;

	//用户openID
	private $openid;

	//用户unionid
	private $unionid;

	// [PHP] POST 执行三方登录 {openid:"",acctss_token:""} （检测用户绑定状态） 如果尚未绑定，返状态码400，id:101
	private $api_login = '/login/thirdlogin';

	//[PHP]  POST /login/thirdbinding/{bind}   bind 参数： 1 有账号，直接绑定  2 无帐号(注册+绑定)
	private $api_bind = '/login/thirdbinding/';

	//PC 端QQ跳转登录页面
	public function qq(){
		$qq_appid     = $this->config->oauth->qq->appid;
		$qq_code_url  = 'https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=%s&state=%s&redirect_uri=%s&scope=%s';
		$state        = 'get_user_info';
		$redirect_uri = urlencode($this->config->url->url_intranet.'/login/dothird/qq');
		$scope        = 'get_user_info';
		$url          = sprintf($qq_code_url,$qq_appid,$state,$redirect_uri,$scope);
		header("location:{$url}");
		return $url;
	}

	//PC 端WeChat登录跳转
	public function wechat(){
		$we_appid = $this->config->oauth->wechat->appid;
		$redirect_uri = urlencode($this->config->url->url_intranet.'/login/dothird/wechat');
		$code = 'snsapi_login';
		$url = "https://open.weixin.qq.com/connect/qrconnect?appid={$we_appid}&redirect_uri={$redirect_uri}&response_type={$code}&scope=snsapi_login#wechat_redirect";
		header("location:{$url}");
	}

	//WeChat浏览器中跳转
	public function we_broswer(){
		$we_appid = $this->config->oauth->wechat->appid;
		$redirect_uri = urlencode($this->config->url->url_member.'/m/account/dothird.html');
		$code = 'snsapi_login';
		$url  = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$we_appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_login#wechat_redirect";
		header("location:{$url}");
	}

	/**
	* 获取用户信息 access_token,openID,unionid
	* @return array
	* @param 三方登录类型
	* @author Jinlong_Xie <soosim@qq.com>
	*/
	public function get_user_auth($type)
	{
		switch($type){
			case 'qq':
				$code = $this->get_code($type);
				if($code)
				{
					$this->access_token = $this-> get_token($type,$code);
					if($this->access_token)
					{
						$this->openid = $this->get_openid($type,$this->access_token);
						if($this->openid)
						{
							return array(
								'access_token'=>$this->access_token,
								'openid' => $this->openid
							);
						}
					}
				}
			break;

			case 'wechat':
				$code = $this->get_code($type);
				if($code)
				{
					$res = $this-> get_token($type,$code);
					if(isset($res['access_token']) && isset($res['openid'])){
						$this -> access_token = $res['access_token'];
						$this -> openid = $res['openid'];
						$this -> unionid = $res['unionid'];
						return array(
							'access_token'=>$this->access_token,
							'openid' => $this->openid,
							'unionid'=> $this -> unionid
						);
					}
				}
				return false;
			break;

			//微信浏览器
			case 'wechatweb':
				$code = $this -> get_code($type);
				if($code)
				{
					$res = $this -> get_token('wechat',$code);
					if(isset($res['access_token']) && isset($res['openid'])){
						$this -> access_token = $res['access_token'];
						$this -> openid = $res['openid'];
						$this -> unionid = $res['unionid'];
						return array(
							'access_token' => $this -> access_token,
							'openid' => $this -> openid,
							'unionid'=> $this -> unionid
						);
					}
				}
			break;
		}
	}

	/**
	* 登录操作，如果用户未绑定帐号，接口返回400 id:101
	* @author Jinlong_Xie <soosim@qq.com>
	*/
	public function login(){
		$data = array(
			'openid'=>$this->openid,
			'unionid' => $this -> unionid,
			'access_token'=>$this->access_token,
			'ip' => $this->context->get_client_address()
		);

		$status = $this->curl->post_request($this->api_login,$data,'php_api');
		$res = $this->curl->getArrayData();

		if(isset($res['success']) && $res['success']){
			$this->user -> reg_member(
							$res['msg']['member_id'],
							$res['msg']['login_id'],
							$res['msg']['nickName'],
							$res['msg']['token']
						);
		}
		return $res;
	}

	//绑定操作
	/*
	* act ： 1:已有帐号   |2:无帐号
	* type :  2-微信 3-QQ 4-微博 5-支付宝
	*/
	public function dobind($unique){
		$act 	  = $this->request->getPost('act');
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$token    = $this->request->getPost('token');
		$openid   = $this->request->getPost('openid');
		$unionid  = $this->request->getPost('unionid');
		$type     = $this->request->getPost('type');
		$ip       = $this->context->get_client_address();
		if($act == 1)
		{
			//php接口 -> 登录 POST
			$data = array(
				'username' => $username,
				'password' => $password,
				'token'    => $token,
				'openid'   => $openid,
				'unionid'  => $unionid,
				'type'     => $type,
				'ip'       => $ip
			);

		//无帐号时的 绑定操作
		}elseif($act == 2){
			$vcode = $this->request->getPost('vcode');
			$data = array(
				'mobile' => $username,
				'vcode' => $vcode,
				'ip'    => $ip,
				'password' => $password,
				'unique'   => $unique,
				'token'    => $token,
				'openid'   => $openid,
				'unionid'  => $unionid,
				'type'     => $type
			);
		}
		$url = $this->api_bind.$act;
		$responseCode = $this->curl->post_request($url,$data,'php_api');
		$m = $this-> curl->getJsonData();
		if($m && $m->success)
		{
			$this->user -> reg_member(
						$m -> msg -> member_id,
						$m -> msg -> login_id,
						$m -> msg -> nickName,
						$m -> msg -> token
					);
		}
		return $m;
	}


	//获取code 目前，QQ与wechat可用
	public function get_code($type){
		$code = $this->request->get('code');
		return $code ? $code : false;
	}

	//获取access token
	public function get_token($type,$code){
		$appid = $this->config->oauth->$type->appid;
		$appkey = $this->config->oauth->$type->appkey;
		$redirect_uri = urlencode($this->config->url->url_member."/account/dothird/{$type}");
		switch($type){
			case 'qq':
				$url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id={$appid}&redirect_uri={$redirect_uri}&client_secret={$appkey}&code={$code}";
				$res = $this->get_url_contents($url);
				parse_str($res,$res_arr);
				return isset($res_arr['access_token']) ? $res_arr['access_token'] : false;
			break;

			case 'wechat':
				$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appkey}&code={$code}&grant_type=authorization_code";
				$res = $this->get_url_contents($url);
				$we_arr = json_decode($res,true);
				return $we_arr;
			break;
		}
	}

	/*
	*获取用户信息
	*目前 qq使用。
	*微信不需调用。
	*/
	private function get_openid($type,$access_token){
		switch($type){
			case 'qq':
				$url = 'https://graph.qq.com/oauth2.0/me?access_token='.$access_token;
			break;
		}

		$str = $this->get_url_contents($url);

		if (strpos($str, "callback") !== false){
            //将字符串修改为可以json解码的格式
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $json  = substr($str, $lpos + 1, $rpos - $lpos -1);
            //转化json
            $result = json_decode($json,true);
            return $result['openid'];
        }else{
            return false;
        }
	}

	/**
	*获取用户详细信息
	*/
	public function get_user_info($type){
		switch($type){
			case 'qq':
				$url = "https://graph.qq.com/user/get_user_info?access_token={$this->access_token}&oauth_consumer_key={$this->config->oauth->qq->appid}&openid={$this->openid}";
				$res = $this->get_url_contents($url);
				return json_decode($res,true);
			break;

			case 'wechat' :
				$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$this->access_token}&openid={$this->openid}";
				$res = $this->get_url_contents($url);
				$res_arr = json_decode($res,true);
				return $res_arr;
			break;
		}
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
?>