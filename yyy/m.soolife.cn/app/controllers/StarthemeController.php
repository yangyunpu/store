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
class StarthemeController extends BaseController
{
	public function starthemeAction()
    {
    	$this->pages->init('星主题');
    	// echo "<pre>";
    	// print_r($c);
    	// exit;
    	$model = new StarthemeService();
    	$data = $model->starTheme();
    	// print_r($data);
    	// exit;
    	$this->assign("data",$data);
	}
	public function themechildAction($id)
    {
    	$this->pages->init('星主题子页');
    	$model = new StarthemeService();
    	$datas = (array)$model->themeChild($id);
    	if(empty($datas)) header('location:'.$this->config->url->url_m.'/index.html');
    	$this->assign('child',$datas);


    	//推荐
    		$data['index'] = 1;
	        $data['size'] = 6;
			$token = $this->user->getToken();
			$history_id = $this -> cookies -> get('history_id');
			$data['session_id'] = md5($history_id);
	        $service = new starThemeService();
	        $result = $service->GuessLike($data,$token);
	       // var_dump($result);exit;
	        foreach ($result['guess_list'] as &$value) {
	        	$value['url'] = $this->config->url->url_goods;
	        }
			$this->assign("datalike",$result['guess_list'] );
	}
	//推荐
	// public function guesslikeAction(){
 //      	if($this->request->isPOST()){
	//         $data['index'] = $this->request->getPost('index');
	//         $data['size'] = $this->request->getPost('size','int','6');
	//         $service = new starThemeService();
	//         $result = $service->GuessLike($data);

	// 	 // echo"<pre>";print_r(111);die;
	//         foreach ($result as &$value) {
	//         	$value['url'] = $this->config->url->url_goods;
	//         }
	//         return $this->success($result);
      		
 //      	}else{
 //      		$data['index'] = 1;
	//         $data['size'] = 6;
	//         $service = new starThemeService();
	//         $result = $service->GuessLike($data);
	//         var_dump($result);exit;
	//         foreach ($result as &$value) {
	//         	$value['url'] = $this->config->url->url_goods;
	//         }
	// 		$this->assign("datalike",$result );

 //      	}
       
    // } 	
}