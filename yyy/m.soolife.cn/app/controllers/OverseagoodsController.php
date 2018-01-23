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
header("Content-Type: text/html; charset=utf-8");

class OverseagoodsController extends BaseController
{
	//海外精品
	public function overseagoodsAction(){
		$server = new  OverseagoodsService();
		$overseaindex = $server->overseaindex();
    	$this->assign('overseaindex',$overseaindex);
    	//全球热卖
    	$param = array(
			  "size"=>"10",
			  "index"=>"1"
    	);
		$hot = $server->hot($param);

    	$this->assign('hot',$hot);
		$adv = $server->adv();
    	$this->assign('adv',$adv);
		$this->pages->init('海外精品');
	}
	// 海外精品下拉加载
	public function  overSeaAjaxAction()
	{
		$index = $this->request->getPost("index");
		if(!isset($index)){
		    $params = [
		        'index' => 0,
		        'size' => 10
		    ];
		}else{
		    $index = $index + 1;
		    $params = [
		        'index' => $index,
		        'size' => 10
		    ];
		}
		$server = new  OverseagoodsService();
		$data = $server->more($params);

    	$this->success('yes',$data);
	}
	//今天 明天 下拉加载
	public function indexmoreAction(){

		$params = $this->request->getPost("params");
		$server = new  OverseagoodsService();
		$data = $server->hot($params);
    	$this->success('yes',$data);
	}

	//今天
	public function todayAction(){
		$type = $this->request->get('type');
		$params = array(
		    "type"=>$type,
		    "size"=>"10",
		    "index"=>"1"
		);
		$server = new  OverseagoodsService();
		$todaydata = $server->day($params);
    	$this->assign('todaydata',$todaydata);

		$this->pages->init('限时折扣');
	}
	//明天
	public function tomorrowAction(){
		$type = $this->request->get('type');
		$params = array(
		    "type"=>$type,
		    "size"=>"10",
		    "index"=>"1"
		);
		$server = new  OverseagoodsService();
		$tomorrow = $server->day($params);
    	$this->assign('tomorrow',$tomorrow);
		$this->pages->init('限时折扣');
	}

	//今天 明天 下拉加载
	public function moreajaxAction(){

		$index = $this->request->getPost("index");
		$type = $this->request->getPost("type");

		if(!isset($type)){
			$type = 1;
		}
		if(!isset($index)){
		    $params = [
		        'index' => 0,
		        'type' => $type,
		        'size' => 10
		    ];
		}else{
		    $index = $index + 1;
		    $params = [
		        'index' => $index,
		        'type' => $type,
		        'size' => 10
		    ];
		}
		$server = new  OverseagoodsService();

		$data = $server->day($params);


    	$this->success('yes',$data);
	}
	// 加入购物车
	public function addcarAction(){
        $sessionId = md5($this->history_id);
        $skuId = $_POST['goodid'];
        $qty = array(
        	"qty"=> 1
        );
		$server = new SecondService();
		$nextdata = $server->addcar($sessionId,$skuId,$qty);
		if(empty($nextdata)){
			$this -> failure('加入购物车失败');
		}else{
			$this -> success('加入购物车成功！',$nextdata);
		}
	}

}
?>