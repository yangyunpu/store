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
class ForgetsController extends BaseController{
    // 忘记密码
    public function forgetAction(){
       $this->pages->init('忘记密码');
	   // $model = new forgetService();
	   // $data = $model->forget();

	     
    }
    //短信
    public function  messagesAction(){
        // $this->pages->init('发送短信');
        $phone = $_POST['mobile'];
		$sms = new Sms();
		$res = $sms->send_msg($phone,'forgot');
      	return $this -> success('',$res);
    }
    //验证短信
    public function  verifyAction(){
    	$model = new forgetService();
        $data = $model->forget();
        return $this -> success('',$data);
    }
    //忘记修改新密码
    public function  revampAction(){
    	$model = new forgetService();
        $data = $model->revamp();
        if ($data['code'] == 104) { 
            $res = $model -> loginForm($data['login_info']);
        }
        return $this -> success('',$data);
    }
}
?>