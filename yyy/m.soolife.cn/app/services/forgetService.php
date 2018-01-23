<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class forgetService extends BaseService {
	public function forget(){
		// $mobile = $_POST['mobile'];
		// $code = $_POST['vcode'];
		$infos = $_POST;
		$data = array();
		$url = "/v2/account/forgot/vcode";
   		$curl = $this -> curl;
   		$info = [
   			'phone' => $infos['mobile'],
   			'vcode' => $infos['vcode']
    		];
   		$responseCode = $curl-> post_request($url,$info,'api');
	   	// $data = $curl -> getResponseText();
	   	// echo "<pre>";
     //     print_r($data);
   		if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
   		 // echo "<pre>";
      //    print_r($data);
      //    exit;
	   	return $data;
	}
	public function revamp(){
		$infos = $_POST;
		$data = array();
		$url = "/v2/account/forgot";
		$curl = $this -> curl;
		$info = [
   			'phone' => $infos['mobile'],
   			'password' => $infos['password']
    	];
    	$responseCode = $curl-> post_request($url,$info,'api');
    	if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
	   	return $data;
	}

	  //将登录信息写入cookie
   public function loginForm($data)
   {
      $info = $this->user -> reg_member(
                     $data['member_id'],
                     $data['login_id'],
                     $data['nickName'],
                     $data['token']
                  );
      return $info;
   }
}
