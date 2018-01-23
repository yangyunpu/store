<?php
// +----------------------------------------------------------------------
// | 账号设置类
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   SettingsService.php
// |
// | Author: jj 
// | Created:   2017-05-27
// +----------------------------------------------------------------------
class SettingsService extends BaseService
{
	/**
	 * 个人资料
	 * @param $member_id int 会员编号
	 * GET v1/member/{id}
	 */	
	function material(){
		$data = array();
		$curl = $this -> curl;
		$id = $this -> user -> getId();
		$member_url = "/member";
		// if ($curl -> get_request($url,'new_api') == 200) {
		// 	$data = $curl -> getJsonData();
		// 	if (!empty($data -> avatar)) {
		// 		$data -> avatar = Common::get_image_url($this -> config, $data -> avatar, 60, 60,'avatar'); 
		// 	}
		// }
		if($this->curl->get_request($member_url,'api') == 200){
		    $data = $this->curl->getArrayData();
		    $data['avatar'] = Common::get_image_url($this -> config,$data['avatar'], '80', '80', 'avatar');
		}
		return $data;
	}

	public  function Edit($value, $status)
	{
		switch ($status) {
			case '1':
				$nickname = array('nickname'=>$value);
			 	$id = $this -> user -> getId();
				$url = "/member/nickname";
				$curl = $this -> curl;
				if($curl -> put_request($url,$nickname,'new_api') == 200) {
					return $curl -> getJsonData();
				}
				return $curl -> null();
				break;
			case '2':
				//修改登录密码
				$url = "/account/safety/loginpasswd";
				$curl = $this -> curl; 
				if ($curl -> post_request($url, $data,'new_api') ==200 ){
					return null;
				 }
				return $curl -> getJsonData();

				break;
			case '3':
				
				break;
			case '4':
				$url = "/member/feedback";
				$curl = $this -> curl;
				$data = array("success"=>false,"msg"=>'提交失败！');
				if($curl -> post_request($url,$value,'new_api') == 200){
					$data = array("success"=>true,"msg"=>'提交成功！');
				}
				return $data;
				break;
		}
	}
	public function revamp(){
		$infos = $_POST;
		$data = array();
		$url = "/v2/account/forgot";
		$curl = $this -> curl;
		$info = [
   			'phone' => $infos['mobile'],
   			'password' => MD5($infos['password'])
    	];
    	$responseCode = $curl-> post_request($url,$info,'api');
    	if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
	   	return $data;
	}
	//提交支付密码
	public function pay_password(){
		$infos = $_POST;
		$data = array();
		$url = "/account/safety/paypasswd";
		$curl = $this -> curl;
		$info = [
   			'vcode' => $infos['vcode'],
   			'password' => base64_encode($infos['password']).rand(10,100)
    	];

    	$responseCode = $curl-> post_request($url,$info,'api');

    	if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
	   	return $data;
	}
	//支付密码短信
	public function paypasswords_code(){
		$url = "/account/safety/paypasswd";
		$curl = $this -> curl;

    	$responseCode = $curl-> get_request($url,'api');

    	if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
	   	return $data;
	}
	//收货地址
	public function site(){
		$data = array();
		$url = "/address/lists";
		$curl = $this -> curl;
		$responseCode = $curl-> get_request($url,'api');
		if($responseCode == 200){
			$data = $curl ->getArrayData();
		}
		return $data;
	}
	//删除收货地址
	public function delect($del_id){
		$data = array();
		$url ='/address/delete/'.$del_id;
		$curl = $this -> curl;
		$responseCode = $curl-> delete_request($url,'api');
		if($responseCode == 200){
			$data = $curl -> getArrayData();
		}
		return $responseCode;
	}
	//修改收货地址
	public function amend($del_id){
		$del_id = (int)$del_id;
		$data = array();
		$url ='/address/details/'.$del_id;
		$curl = $this -> curl;
		$responseCode = $curl-> get_request($url,'api');
		if($responseCode == 200){
			$data = $curl -> getArrayData();
		}	
		return $data;
	}
	//提交收货地址
	public function editaddress(){
		$data = array();
		$url ='/address/edit/'.$del_id;
		$curl = $this -> curl;
		$responseCode = $curl-> get_request($url,'api');
		if($responseCode == 200){
			$data = $curl -> getArrayData();
		}
		return $data;
	}
	//绑定新手机号
	public function bind($data){
		$info = [
			"phone" => $data['mobile'],
			"step"  => $data['step'],
			"vcode" => $data['vcode']
		];
		$data = array();
		$url ='/v2/account/bindphone';
		$curl = $this -> curl;
		$responseCode = $curl-> post_request($url,$info,'api');

		if($responseCode == 200){
			$data = $curl -> getArrayData();
		} elseif($responseCode == 400){
			$data = $curl -> getArrayData();
		}
		return $data;
	}
	public function verify(){
		$infos = $_POST;
		$data = array();
		$url = "/v2/sms/check";
   		$curl = $this -> curl;
   		$info = [
   			'phone' => $infos['mobile'],
   			'vcode' => $infos['vcode'],
   			'type'  => 'bindphone_step_one'
    		];
   		$responseCode = $curl-> post_request($url,$info,'api');
   		if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
	   	return $data;
	}
	// 地址-添加新地址-Ajax
	public function newSiteAjax($d) {
		$url = '/address/add';
		$data = array();
		if($this->curl->post_request($url,$d,'api')==200){
			$data = $this->curl->getArrayData();
		}else{
			$data = $this->curl->getArrayData();
		}
		return $data;
	} 
	// 地址-三级联动-Ajax
	public function siteDataAjax($regionid) {
		$url = '/member/address/' . $regionid;
		$data = array();

		if($this->curl->get_request($url,'api')==200){
			$data = $this->curl->getArrayData();
		}
		return $data;
	} 
	// 地址-提交修改新收货地址-Ajax
	public function newrevampAjax($data) {
		$url = "/address/edit/{$data['addressid']}";
		$result = array();
		if($this->curl->put_request($url,$data,'api')==200){
			$result = $this->curl->getArrayData();
		}
		return $result;
	}
	//获取个人信息 生日 性别 地区
	public function person(){
		$url ="/v2/member/getcompleteinfo";
		$result = array();

		if($this->curl->get_request($url,'api')==200){
			$result = $this->curl->getArrayData();
		}
		if(empty($result)){
			$result['sex']= 1;
			$result['birthday']= 0;
			$result['region']= "北京市东城区";
		}
		if($result['sex'] ==1){
			$result['wen']='男';
		}elseif($result['sex'] ==0){
			$result['wen']='女';
		}elseif ($result['sex'] == -1) {
			$result['wen']='未知';
		}
		$result['birthday'] = date("Ymd",$result['birthday']);
		return $result;
	}
	//设置个人信息
	public function editperson($data){
		$url ="/v2/member/complete";
		$result = array(); 
		if($this->curl->post_request($url,$data,'api')==200){
			$result = $this->curl->getArrayData();
		}
		return $result;
	}
}
