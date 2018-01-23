<?php
// +----------------------------------------------------------------------
// | 会员登录控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   LoginController.php
// |
// | Author:    Elliot
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Librarys\Common;
use Soolife\Member\Librarys\Verify;
use Soolife\Member\Librarys\Sms;
use Soolife\Member\Services\SopService;
use Soolife\Member\Services\ThirdLoginService;

class LoginController extends BaseController
{
	private $index = 'cn.soolife.intranet.sop';

	/**
	 * [会员登录]
	 * @author Elliot Shi
	 * @CreatDate 2017-06-26
	 * @link  '/sop/login.html'
	 * @return    [type]     [description]
	 */
	public function loginAction() {
		$return_url = $this->request->get('return_url');
		if (empty($return_url))
		{
			$return_url = Common::base64url_encode($this -> config -> application -> default_index);
		}
		$this->assign('return_url',$return_url);

		# 表单提交
		if ($this->request->isPost()) {
			$login = new SopService();
			$res = $login->Login();
			if ($res->success) {
				$return_url = Common::base64url_decode($return_url);
				return $this->success('登录成功',$return_url);
			} else {
				if($res->code == '103') //错误次数超过三次
				{
					return $this->failure($res->msg,200,103);
				} else {
					// return $this->failure($resentry,200,103);
					return $this->failure($res->entry->msg,200,$res->code);
				}
			}
			// return $this->failure('用户名或密码错误!',200,$return_url);
		}

		# 查看用户错误登录次数
		$ip = Common::get_client_address();
		$this->logger->info($ip);
		$account = new SopService();
		$error_log_num = $account->error_log_num($ip);
		$this->assign('error_num',$error_log_num);

		# 记住用户名
		$user_name = $this->cookies->get('user_name');
		$this->assign('user_name',$coo_username);

    	$this -> page->setContentTitle('');
		$this -> page -> init('会员登录', $this->index);
		$this->display('sop/login');
	}

	/**
	* 创建登录二维码
	* @param telephone code
	* @author elliot
	* @date 2017-05-25 15:35:09
	*/
	public function scanloginAction(){

		 $url = "/v2/qrlogin/createcode";
		 $code = $this->curl->post_request($url,'','php_api');
		 $data = $this->curl->getArrayData();

		 return json_encode($data);

	}

	# 实时验证二维码*elliot2017-05-25
	public function nowLoginAction(){
	 	$qrcode = $_POST['qrcode'];
	 	$type = $_POST['type'];
 		$url = "/v2/qrlogin/verifycode/{$qrcode}";
 		$num = 0;
	 	while(true){
	 		$num++;
	 		if($this ->curl ->post_request($url,'','php_api') == 200){
		 	 	$data = $this->curl->getArrayData();
		 	}
	 		if($data['status'] != 1){
	 			if ($data['status'] == 2) {
		 			$service = new SopService();
		 			$service -> loginForm($data['login_info']);
		 		}
	 			return json_encode($data);
	 		}
	 		if ($num == 25 && $type==1) {
	 			return json_encode($data);
	 		}
	 		if ($num == 3 && $type!=1) {
	 			return json_encode($data);
	 		}
	 		sleep(1);
	 	}
	}

	public function registerAction()
	{
		if ($this->request->isPost()) {
			$act = $this->request->getPost('act');
			$tele = $this->request->getPost('phone');

			if(!$this->match_phone($tele))
			{
				return $this->failure('请输入正确的手机号码！',200);
			}
			//发送短信验证码
			if($act == 1){
				$image_vcode = $this->request->getPost('image_vcode');
				$vcode_key = $this->request->getPost('vcode_key');

				$verify = new Verify((array)$this->config);

				if(!$verify->check(strtolower($image_vcode),$vcode_key))
				{
					$this->failure('验证码错误,请重新输入');
				}

				$sms = new Sms();
				$res = $sms->send_msg($tele,'register');

				if($res['success'])
				{
					return $this->success('发送成功');
				}else{
					return $this->failure($res['msg'],200,null,$res['id']);
				}
			}else{
				$vcode = $this->request->getPost('vcode');
				$password = $this->request->getPost('password');
				if(!isset($vcode{5}))
				{
					return $this->failure('请输入正确的验证码！',200);
				}
				if(!isset($password) || strlen($password) <2 || strlen($password) > 16)
				{
					return $this-> failure('密码格式不符合规范！',200);
				}
				$account = new SopService();
				$res = $account -> Register($this->history_id);
				if($res->code == 104)
				{
					return $this->success('注册成功！');
				}else{
					return $this->failure($res->entry->msg,200);
				}
			}
		}
		$source   = $this->context->get_query('source','string','');
		$referrer = $this->context->get_query('referrer','string','');
		$unique   = $this->context->get_query('unique','string','');
		$this->assign('unique',$unique);
		$this->assign('source',$source);
		$this->assign('referrer',$referrer);


		$this -> page->setContentTitle('');
		$this->page -> init('会员注册', $this->index);
		$this->display('sop/register');
	}

	/**
	 * [第三方登录]
	 * @author Elliot Shi
	 * @param
	 * @CreatDate 2017-06-26
	 * @link
	 * @param   $type [第三方登录类型]
	 */
	public function thirdLoginAction($type){

		$oauthService = new ThirdLoginService();
		if($this->request->isGet()){
			$oauthService->$type();
		}
	}
	//执行 回调，并执行登录操作，未绑定时，返回400，状态ID 101
	public function dothirdAction($type_name){
		$oauthService = new ThirdLoginService();
		$auth = $oauthService -> get_user_auth($type_name);   //用户access_token 和 openid
		if($auth){
			$res = $oauthService->login($type_name);  //登录操作 -- 接口登录信息

			if(isset($res['success']))
			{
				if($res['success'])
				{
					$return_url = $this->context->get_query('return_url');
					if (empty($return_url))
					{
						$return_url = Common::base64url_encode($this -> config -> application -> default_index);
					}
					$return_url = Common::base64url_decode($return_url);
					header("location:{$return_url}");
				}else{
					//未绑定 跳转到绑定页面
					if($res['id'] == 101)
					{
						$userInfo = $oauthService->get_user_info($type_name);
						//登录方式编码：2-微信 3-QQ 4-微博 5-支付宝
						switch(strtolower($type_name)){
							case 'qq':
								$type = 3;
								$this->assign('nickname',$userInfo['nickname']);
							break;
							case 'wechat':
								$type = 2;
								$this->assign('nickname',$userInfo['nickname']);
							break;
							case 'weibo':
								$type = 4;
							break;
							case 'alipy':
								$type = 5;
							break;
						}
						$this->assign('type',$type);
						$this->assign('user_auth',$auth);

						$this->assign('type_name',$type_name);
						$this->page -> init('合作账号登录');
						$this->page -> layout('layout_mini');
					}
				}
			}
		}else{   //获取信息失败 或者用户刷新页面，返回上一步授权页面
			$oauthService->$type_name();
		}
	}


	/**
	 * 产生验证码
	 * @access public
	 * @return image/jpg
	 */
	function validcodeAction()
	{
        $config = array(
            'font_path' => ROOT_PATH.'/public/verify/',
            'fontSize' => 30, // 验证码字体大小
            'length' => 4
        );
        $rand_key = $this->request -> get('key');
        $type = $this->request -> get('type');
        $Verify = new Verify($config);
        if($type == 1){
            $Verify -> useNumeric = true;
            $Verify -> useCurve = false;
        }
        $Verify->entry($rand_key);
	}

	# 注册协议页
	public function agreementAction()
	{
		$this -> page->setContentTitle('');
		$this -> page -> init('会员登录', $this->index);
		$this->display('sop/agreement');
	}

	/**
	 * 注销登录
	 * @access public
	 * @author elliot
	 * **/
	public function logoutAction()
	{
		$return_url = $this->context->get_query('return_url');

		if (empty($return_url)) {
			$return_url = '/index.html';
		}
		else {
			$return_url = Common::base64url_decode($return_url);
		}
		$token =  $this->user->getToken();
		$this  -> redis->remove_token($token);

		$domain=$this->user->domain();
		setcookie("m_token","",time()-3600,"/",$domain);
		$this-> cookies->set('member_identifier','',time()-3600,"/",FALSE,$domain);

		$val = strtolower(str_replace(array('{','}','-'), "", $this->com_create_guid())) ;
		$expire = time()+(365*86400);
		$this-> cookies->set('history_id', $val, $expire,"/",FALSE,$domain);

		return $this -> response -> redirect($return_url);
	}
	//解决  com_create_guid  函数兼容问题
	private function com_create_guid() {
		$microTime = microtime();
		list($a_dec, $a_sec) = explode(" ", $microTime);
		$dec_hex = dechex($a_dec * 1000000);
		$sec_hex = dechex($a_sec);
		$this -> ensure_length($dec_hex, 5);
		$this -> ensure_length($sec_hex, 6);
		$guid = "";
		$guid .= $dec_hex;
		$guid .= $this -> create_guid_section(3);
		$guid .= '-';
		$guid .= $this -> create_guid_section(4);
		$guid .= '-';
		$guid .= $this -> create_guid_section(4);
		$guid .= '-';
		$guid .= $this -> create_guid_section(4);
		$guid .= '-';
		$guid .= $sec_hex;
		$guid .= $this -> create_guid_section(6);
		return $guid;
	}

	private function create_guid_section($characters) {
		$return = "";
		for ($i = 0; $i < $characters; $i++) {
			$return .= dechex(mt_rand(0, 15));
		}
		return $return;
	}

	private function ensure_length(&$string, $length) {
		$strlen = strlen($string);
		if ($strlen < $length) {
			$string = str_pad($string, $length, "0");
		} else if ($strlen > $length) {
			$string = substr($string, 0, $length);
		}
	}

}
