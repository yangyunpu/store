<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  huzhichao  Controller.php
// |
// | Author: 
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class RegiftController extends BaseController
{
	public function regiftAction(){ 
    	$this->pages->init('注册送礼');
	} 
	// 请求短信
	public function registerSmsAction() {

		$phone = $_GET['phone'];
		$url = "/v2/sms/register/" . $phone; 
		$data = array(); 
		if($this->curl->get_request($url,'api')){
			$data = $this->curl->getArrayData();
		}
		$this->success("success",$data);
	}
	// 注册
	public function registerAjaxAction(){
		$formdata = [
    		'mobile' =>	 $_POST['mobile'],
			'password' => $_POST['password'],
			'vcode' => $_POST['vcode'],
			'source' => $_POST['source'],
			'referrer' => $_POST['referrer'],
			'unique' => $_POST['unique']
        ];
		$url = "/v2/account/register";

		$data = array(); 
		if($this->curl->post_request($url,$formdata,'api')==200){
			$data = $this->curl->getArrayData();
			$this->user -> reg_member(
                            $data['login_info']['member_id'],
                            $data['login_info']['login_id'],
                            $data['login_info']['nickName'],
                            $data['login_info']['token']
                          );

		}
		$this->success("success",$data);
	}
}
?>