<?php
// +----------------------------------------------------------------------
// |登录
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-04-15
// +----------------------------------------------------------------------
class EnrollController extends BaseController{
    // 注册
    public function enrollAction(){
    	if($this -> request ->isGet()){
        	$this->pages->init('注册');
        } else {
	    	$model = new EnrollService();
	  		$data = $model->enroll();

                if ($data['code'] == 104) {

                    $res = $model -> loginForm($data['login_info']);

                }

            // 信息传入cookies
            // $res = $model -> loginForm($data['login_info']);
	  		if(!empty($data)){
	          return $this -> success('',$data);
	        }else{
	          return $this -> failure('参数有误',400);
	        }
       }
    }
    //短信
    public function  messagesAction(){
        // $this->pages->init('发送短信');
        $phone = $_POST['mobile'];
        $sms = new Sms();
        $res = $sms->send_msg($phone,'register');
      	return $this -> success('',$res);
    }
    //检查注册次数
    public function err_numsAction(){
        $model = new EnrollService();
        $data = $model->err_nums();
        return $this -> success('',$data);
   }

    //注册协议
    public function protocolAction(){
        $this->pages->init('注册协议');

    }

    // 注册送礼
    public function ljseedAction(){
        $url = '/v2/member/registersource';
        // $curl = $this -> curl;
        $res = array();
        if($this->curl->get_request($url,'api') == 200){
            $res = $this->curl->getArrayData();
        }
        // print_r($res);
        // exit;
        // $this ->assign('seed',$res);
        return $this -> success('success',$res);
    }
}

?>