<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class EnrollService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
   public function enroll(){
   		$infos = $_POST;
      //echo"<pre>";print_r($infos);die;
      //$this -> resquest ->getPost('mobile','string','');
   		$data = array();
   		$url = "/v2/account/register";
   		$curl = $this -> curl;
         $info = [
            'mobile' => $infos['mobile'],
            "password" => $infos['password'],
            "vcode" =>$infos['vcode'],
            "xcode" => $infos['xcode'],
            "xcode_key" =>  $infos['xcode_key'],
            "referrer" =>'',
            "source" =>'',
            "nickname" =>''
         ];
         $responseCode = $curl-> post_request($url,$info,'new_api');
         //$data = (array)$data;
         if($responseCode == 200){
            $data = $curl -> getArrayData();
         } 
   	     // echo "<pre>";
         // print_r($data);
         // exit;
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

   //短信
   public function  messages(){
   	 	$mobile = $_POST['mobile'];
	   	$data = array();
	   	$url = "/v2/sms/register/$mobile";
	   	$curl = $this -> curl;
	   	$responseCode = $curl-> post_request($url,'new_api');
/*	   	echo $responseCode;die;
	   	$data = $curl -> getResponseText();
	   	 echo "<pre>";
         print_r(json_decode($data));
         exit;*/
	   	if($responseCode == 200){
	   		$data = $curl -> getArrayData();
	   	}
	   	 // echo "<pre>";
      //    print_r($data);
      //    exit;
	   	return $data;
   }
   //检查注册次数
   public function err_nums(){
      //$infos = $_POST;
      //echo"<pre>";print_r($info);die;
      //$this -> resquest ->getPost('mobile','string','');
         $data = array();
         $url = "/v2/account/error/registererr";
         $curl = $this -> curl;
         // $info = [
         //    "ip" => ''
         // ];
         $responseCode = $curl-> post_request($url,'new_api');
         //$data = (array)$data;
          //   $data = $curl -> getResponseText();
          // echo "<pre>";print_r(json_decode($data));die;
         if($responseCode == 200){
            $data = $curl -> getArrayData();
         }
         // echo "<pre>";
         // print_r($data);
         // exit;
      return $data;

   }
}