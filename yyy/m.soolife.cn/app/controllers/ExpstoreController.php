<?php
// +----------------------------------------------------------------------
// | 到店签到
// +----------------------------------------------------------------------
// | Copyright (c) 2016Äê Èç´ËÉú»î. All rights reserved.
// +----------------------------------------------------------------------
// | File:  liucunyang  Controller.php
// |
// | Author:
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class ExpstoreController extends BaseController
{
    public function expstoreAction()
    {   
        $url="/v2/qrcoin/createcode"; 
        $data = array(); 
        if($this->curl->post_request($url,'','api') == 200){
            $data = $this->curl->getArrayData(); 
        } 
        $this->assign('erdata',$data['img_src']);
        $this->pages->init('到店签到');
    }
    public function expstoreajaxAction()
    {   
        $url="/v2/qrcoin/createcode"; 
        $data = array(); 
        if($this->curl->post_request($url,'','api') == 200){
            $data = $this->curl->getArrayData(); 
        }  
        return $this->success($data);
    }

    public function expresultAction()
    { 
        //$guesslike_url="/goods/rank/guesslike";
        $guesslike_url="/v3/goods/guesslike";
        $data=array(
        		"index"=>0,
        		"size"=>12
        	);
        $token = $this->user->getToken();
        $history_id = $this -> cookies -> get('history_id');
        $data['session_id'] = md5($history_id);
        $guesslike = array();
        // if($this->curl->post_request($guesslike_url,$data,'php_api') == 200){
        $this->curl->set_token($token);
         if($this->curl->post_request($guesslike_url,$data,'java_api') == 200){
            $guesslike = $this->curl->getArrayData();
            foreach ($guesslike['guess_list'] as $key => &$value) {
                $value['logo'] = Common::get_image_url($this -> config, $value['logo'], '', '', 'others'); 
            }
        } 
    	$this->assign('guesslike',$guesslike['guess_list']);
        $this->pages->init('签到结果'); 
    }

}