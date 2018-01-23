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
class LoginsController extends BaseController{
    // 登录
    // public $url
    public function loginAction(){

      if($this -> request ->isGet()){
        $return_url =  $this->context->get_query('return_url');
        if (empty($return_url)) {
          $return_url = Common::base64url_encode($this -> config -> application -> default_index);
        }
        $this -> assign('return_url',  $return_url);
        $this->pages->init('登录');
      }else{
        $return_url = $this->request->getPost('url');
        if (empty($return_url)) {
          $return_url = Common::base64url_encode($this -> config -> application -> default_index);
        }
        $model = new LoginService();
        $data = $model->login();
        if(!empty($data)){

          $data['return_url'] = Common::base64url_decode($return_url);
          return $this->success('登录成功',$data);
        }else{
          return $this -> failure('参数有误',400);
        }
      }
    }
   public function entryAction(){
    //echo "11";die;
        $model = new LoginService();
        $data = $model->entry();
        return $this -> success('',$data);
   }
    public function err_numAction(){
      $ip = $this->request->getClientAddress();
      /*echo '<pre>';
          print_r($ip);exit;*/
      $model = new LoginService();
      $data = $model->err_num();
      /*echo '<pre>';
          print_r($data);exit;*/
      return $this -> success('',$data);
   }
}
?>