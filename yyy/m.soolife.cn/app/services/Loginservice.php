<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class loginService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
   public function login(){
      $infos = $_POST;
      //echo"<pre>";print_r($infos);die;
      //$this -> resquest ->getPost('mobile','string','');
   		$data = array();
   		$url = "/v2/account/login";
   		$curl = $this -> curl;
         $info = [
            'username' => $infos['mobile'],
            "password" => $infos['password'],
            "xcode" => $infos['xcode'],
            "xcode_key" =>  $infos['xcode_key']
         ];
         $responseCode = $curl-> post_request($url,$info,'api');
         //$data = (array)$data;
         if($responseCode == 200){
            $data = $curl -> getArrayData();
            // echo "<pre>";
            // print_r($data);exit;
            $this->user -> reg_member(
                            $data['login_info']['member_id'],
                            $data['login_info']['login_id'],
                            $data['login_info']['nickName'],
                            $data['login_info']['token']
                          );
         }
      return $data;

   }

    public function entry(){
      $infos = $_POST;
      //echo"<pre>";print_r($info);die;
      //$this -> resquest ->getPost('mobile','string','');
         $data = array();
         $url = "/v2/tools/entry";
         $curl = $this -> curl;
         $info = [
            "key" => $infos['xcode_key']
         ];
         $responseCode = $curl-> post_request($url,$info,'api');
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


  public function err_num(){
      //$infos = $_POST;
      //echo"<pre>";print_r($info);die;
      //$this -> resquest ->getPost('mobile','string','');
         $data = array();
         $url = "/v2/account/error/loginerr";
         $curl = $this -> curl;
         // $info = [
         //    "ip" => ''
         // ];
         $responseCode = $curl-> post_request($url,'api');
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