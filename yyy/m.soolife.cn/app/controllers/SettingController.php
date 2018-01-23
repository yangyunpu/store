<?php
// +----------------------------------------------------------------------
// | test
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-03-17
// +----------------------------------------------------------------------

//
header("Content-Type: text/html; charset=utf-8");
class SettingController extends BaseController{
	//安全设置
	public function  safesetAction(){

		$settings = new SettingsService();
		$resmsg = $settings -> person();
		$this -> assign("resmsg", $resmsg);

		$settings = new SettingsService();
		$result = $settings -> material();
		$this -> assign("result", $result);
		// echo "<pre>";	
		// print_r($result);
		// exit;
		$this->pages->init('安全设置');
	}
	/**
	 * 注销登录
	 * @access public
	 * @author Luo Qing 2016-05-23
	 * **/
	public function logoutAction() {
		$return_url = $this->context->get_query('return_url');
		if (empty($return_url)) {
			$return_url = $this -> config -> application -> default_login;
		}
		else {
			$return_url = Common::base64url_decode($return_url);
		}
		$return_url = $this -> config ->url->url_m.'/i/index/index.html';

		$token=$this->user->getToken();
		$this->redis->remove_token($token);

		$domain=$this->user->domain();
		setcookie('m_token','',time()-3600,'/',$domain);
		$this-> cookies->set('member_identifier','',time()-3600,'/',FALSE,$domain);
		$this-> cookies->set('history_id', '', $expire,'/',FALSE,$domain);
		$val = strtolower(str_replace(array('{','}','-'), '', $this->com_create_guid())) ;
		$expire = time()+(365*86400);
		$this-> cookies->set('history_id', $val, $expire,'/',FALSE,$domain);

		return $this -> response -> redirect($return_url);
	}
	//修改昵称
	public function  amendnameAction(){
		if ($this->request->isPost()) {

			$nickname = $this->request->getPost('nickname');
			$settings = new SettingsService();
			$result = $settings -> Edit($nickname, 1);
			if (isset($result)) {
				return $this -> success('修改成功', $result, "");
			} else {
				return $this -> failure('修改失败',"200",$result,"");
			}
		}
		$this->pages->init('修改昵称');
	}
	//绑定手机号
	public function  contextiphoneAction(){
		$settings = new SettingsService();
		$result = $settings -> material();

		$this -> assign("result", $result);
		$this->pages->init('绑定手机号');
	}
	    //验证短信
    public function  verifyAction(){
    	$model = new SettingsService();
        $data = $model->verify();
        if(!empty($data)){
			return $this -> success('',$data);
        }else {
        	return $this -> failure('验证码错误');
        }
        
    }
	//绑定手机号2
	public function bindiphoneAction(){
		$data = $_POST;
		$settings = new SettingsService();
		$result = $settings -> bind($data);
		return $this -> success('',$result);
        if(!empty($data)){
			return $this -> success('',$data);
        }else {
        	return $this -> failure('绑定失败');
        }
	}
	//个人信息
	public function  messageAction(){
		$settings = new SettingsService();
		$result = $settings -> person();
		//var_dump($result );exit;
		if($result['birthday'] == '19700101'){ $result['birthday'] = '';} 
		if($result['sex'] == -1){ $result['sex'] =1;} 
		//var_dump($result );exit;
		$this -> assign("result", $result);

		// echo "<pre>";
		// print_r($result);
		// exit;
		$this->pages->init('个人信息');
	}
	//设置个人信息
	public function personelAction(){
		$settings = new SettingsService();
		 $data = [
            'sex' => $_POST['sex'],
            'birthday' => intval(trim($_POST['birstry'])),
            'region' => $_POST['region']
        ];
		$result = $settings ->editperson($data);
		return $this -> success('',$result);
	}
	//修改密码
	public function  passwordAction(){
		$this->pages->init('修改密码');
	}
	//修改登录密码
	public function  loginpasswordAction(){
		$settings = new SettingsService();
		$result = $settings -> material();
		$this -> assign("result", $result);
		$this->pages->init('登录密码');
	}
	//修登录密码
    public function  revampAction(){
    	$model = new SettingsService();
        $data = $model->revamp();
        return $this -> success('',$data);
    }
	//修改支付密码
	public function  paypasswordAction(){
		if (empty($_GET['type'])) {
			$type = 0;
		}else{
			$type = 1;
		}
		$settings = new SettingsService();
		$result = $settings -> material();
		$this -> assign("result", $result);
		$this -> assign("type", $type);
		$this->pages->init('支付密码');
	}
	//修支付密码
	 public function  paypasswordsAction(){
    	$model = new SettingsService();
        $data = $model->pay_password();
        return $this -> success('',$data);
    }
  	//修支付密码
	 public function  paypasswords_codeAction(){
    	$model = new SettingsService();
        $data = $model->paypasswords_code();
        return $this -> success('',$data);
    }
	//现金账号绑定
	public function  cashAction(){

        $member_url = '/member';
        $member = array();
        if($this->curl->get_request($member_url,'api') == 200){
            $member = $this->curl->getArrayData();
            $member['avatar'] = Common::get_image_url($this -> config,$member['avatar'], '80', '80', 'avatar');
        }
        $phone = $member['phone'];
        
        $this -> assign("phone", $phone);


		$banklist_url = "/member/bank";
		$banklist = array();
		if($this->curl->post_request($banklist_url,'','api') == 200){
		    $banklist = $this->curl->getArrayData();
		}
		
		$this -> assign("banklist", $banklist);
		$this->pages->init('现金账号绑定');
	}
	// 银行卡绑定
	public function  bindbankAction(){
		//判断用户是否登录
		$type = $_GET['type'];
		if ($type != 1) {
			$type == 2;
		}
		$login_data = array();
		$futurestar_url = "/member/futurestar";
		if($this->curl->get_request($futurestar_url,'api') == 200){
		    $login_data = $this->curl->getArrayData();
		}
		if ($login_data['is_login'] != 1) {
			$url = $this->config->url;
			$base_url = $url['url_m'].'/setting/bindbank.html';
			header("Location:/logins/login.html?return_url=".base64_encode($base_url));
		}
		// 获取电话号码
		$member_url = '/member';
		$member = array();
		if($this->curl->get_request($member_url,'api') == 200){
		    $member = $this->curl->getArrayData();
		    $member['avatar'] = Common::get_image_url($this -> config,$member['avatar'], '80', '80', 'avatar');
		}
		$phone = $member['phone'];
		
        // 获取银行卡记录
		$banklist_url = "/member/bank";
		$banklist = array();
		if($this->curl->post_request($banklist_url,'','api') == 200){
		    $banklist = $this->curl->getArrayData();
		}

		$this -> assign("phone", $phone);
		$this -> assign("banklist", $banklist);
		$this -> assign("type", $type);

		$this->pages->init('绑定银行卡');
	}
	//银行卡绑定
	public function  cashAjaxAction(){

		$bank_name     = $this ->request ->getPost("bank_name");
		$bank_account  = $this ->request ->getPost("bank_account");
		$bank_no       = $this ->request ->getPost("bank_no");
		$mobile       = $this ->request ->getPost("mobile");
		$vcode         = $this ->request ->getPost("vcode");

		$bank_url = "/v2/account/bank/bind";
		$bank = array();
		$data = [
		    "bank_name" =>$bank_name,
		    "bank_account"  =>$bank_account,
		    "bank_no" =>$bank_no,
		    "vcode"  =>$vcode
		];

		if($this->curl->post_request($bank_url,$data,'api') == 200){
		    $bank = $this->curl->getArrayData();
		} else if($this->curl->post_request($bank_url,$data,'api') == 400){
	    	$bank = $this->curl->getJsonData();
	    }
		if(empty($bank)){
		    $this->failure('false');
		}else{
		    $this->success('success',$bank);
		}

		$this->pages->init('现金账号绑定');
	}
	//银行卡绑定发送验证码
	public function  vcodeAjaxAction(){

		$mobile       = $this ->request ->getPost("mobile");

		$bank_url = "/v2/account/bank/bind";
		$bank = array();
		$data = [
		    "mobile" =>$mobile
		];

		if($this->curl->get_request($bank_url,'api') == 200){
		    $bank = $this->curl->getArrayData();
		} else if($this->curl->post_request($bank_url,$data,'api') == 400){
	    	$bank = $this->curl->getJsonData();
	    }
		if(empty($bank)){
		    $this->failure('false');
		}else{
		    $this->success('success',$bank);
		}

		$this->pages->init('现金账号绑定');

	}
	//激活礼品卡
	public function  couponAction(){
		$member_url = '/member';
		$member = array();
		if($this->curl->get_request($member_url,'api') == 200){
		    $member = $this->curl->getArrayData();
		    $member['avatar'] = Common::get_image_url($this -> config,$member['avatar'], '80', '80', 'avatar');
		}
		$cash = $member['cash'];
        $this ->assign('cash',$cash);
		$this->pages->init('激活礼品卡');
	}
	//激活礼品卡
	public function  couponAjaxAction(){

	    $serial_no = $this ->request ->getPost("serial_no");
	    $password  = $this ->request ->getPost("password");

	    $gift_url = "/member/assets/gift";
	    $gift = array();
	    $data = [
	        "serial_no" =>$serial_no,
	        "password"  =>$password
	    ];
	    if($this->curl->post_request($gift_url,$data,'api') == 200){
	        $gift = $this->curl->getArrayData();
	    }else if($this->curl->post_request($gift_url,$data,'api') == 400){
	    	$gift = $this->curl->getJsonData();
	    }

	    if(empty($gift)){
	        $this->failure('false');
	    }else{
	        $this->success('success',$gift);
	    }
	}
	//充值钱包
	public function  stockpilewalletAction(){
		$this->pages->init('充值钱包');
	}
	//关于我们
	public function  aboutusAction(){
		$this->pages->init('关于我们');
	}
	//意见反馈
	public function  opinionAction(){
		if($this -> request -> isPost()){
				$id = $this -> user -> getId();
				$content = htmlentities($this -> request -> getPost("content"));
				$type = $this -> request -> getPost("type");
				$mobile = $this -> request -> getPost("mobile");
				$data = array("content" => $content,"type" => $type,"mobile" => $mobile);

				$feedback = new SettingsService();
				$result = $feedback -> Edit($data, 4);
				$this -> json($result);

			}
		$this->pages->init('意见反馈');


	}
	//收货地址
	public function  siteAction(){
		$model = new SettingsService();
        $data = $model->site();
        $this -> assign("result", $data);
		$this->pages->init('收货地址');

	}
	//默认收货地址
	public function  default_addressAction(){
		$data = array();
		$addressid = (int)$_POST['addressid'];
		$url = "/address/setdefault/".$addressid;
		$curl = $this -> curl;
		if ($curl -> put_request($url,'','api') == 200) {
			$data = $curl -> getArrayData();
		}
		if(empty($data)){
			$this->failure("失败！",$data);
		}else{
			$this -> success("成功！",$data);
		}
	}
	//删除收货地址
	public function delectAction(){
		$del_id = $this->request->getPost('id');
		$model = new SettingsService();
        $data = $model->delect($del_id);
        $this -> success($data);
	}
	//新增收货地址
	public function  speaddresAction(){

		$model = new SettingsService();
        $dataAdd = $model->site();
        $dataCount = count($dataAdd);
        $this -> assign("dataCount", $dataCount);
		$this->pages->init('新增收货地址');
	}
	 // 地址-三级联动-Ajax
    public function siteDataAjaxAction(){
        $regionid = $_GET['regionid'];
        $service = new SettingsService();
        $result = $service->siteDataAjax($regionid);
        $this->success("返回成功",$result);
    }
	// 地址-添加新地址
    public function newSiteAjaxAction(){

        $data = [
            'consignee' => $_GET['consignee'],
            'mobile' => $_GET['mobile'],
            'address' => $_GET['address'],
            'region_no' => $_GET['regionno'],
            'default_flag' => $_GET['setDefault']
        ];

        $service = new SettingsService();
        $result = $service->newSiteAjax($data);
        if($result['success']){
	        $this->success("返回成功",$result);
        }else{
        	$this->failure("返回失败",$result);
        }
    }
    //地址-提交修改收货地址
    public function revampaddressAction(){
    	$data = [
            'consignee' => $_GET['consignee'],
            'mobile' => $_GET['mobile'],
            'address' => $_GET['address'],
            'region_no' => $_GET['regionno'],
            'addressid' => $_GET['id'],
            'default_flag' => $_GET['setDefault']
        ];
        $service = new SettingsService();
        $result = $service->newrevampAjax($data);
        if(empty($result)){
	        $this->failure("返回失败");
        }else{
	        $this->success("返回成功",$result);
        }
    }
	//修改收货地址
	public function  remaddresAction($id){
		$model = new SettingsService();
		$data = $model -> amend($id);
		$this -> assign("result", $data);
		$this->pages->init('修改收货地址');
	}
	//提交修改收货地址
	public function editaddressAction(){
		$data = [
            'consignee' => $_GET['consignee'],
            'mobile' => $_GET['mobile'],
            'address' => $_GET['address'],
            'region_no' => $_GET['regionno'],
            'default_flag' => $_GET['setDefault']
        ];
		$model = new SettingsService();
		$data = $model -> editaddress();
		$this->pages->init('提交修改收货地址');
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
	private function ensure_length(&$string, $length) {
		$strlen = strlen($string);
		if ($strlen < $length) {
			$string = str_pad($string, $length, "0");
		} else if ($strlen > $length) {
			$string = substr($string, 0, $length);
		}
	}

	private function create_guid_section($characters) {
		$return = "";
		for ($i = 0; $i < $characters; $i++) {
			$return .= dechex(mt_rand(0, 15));
		}
		return $return;
	}

}