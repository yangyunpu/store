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

class SecondController extends BaseController
{
	public function secondindexAction(){

		$server = new SecondService(); 
		$search = $server->search();
		$this -> assign('search',$search); 


		$firstcode =  $this->request->get('firstcode');
		$twocode =  $this->request->get('twocode');
		$urlcode['firstcode'] = $firstcode;
		$urlcode['twocode'] = $twocode;
		$server = new SecondService();

		$categoryresult = $server->categorydata();

		$categoryword = '';
		$timekey ='';
		foreach ($categoryresult as $key => $value) {
			if($value['id']==$firstcode){
			 	$categoryword = $key;
			 	switch ($categoryword) {
			 			case 'cloth':
			 				$timekey = 1;
							$adv = $server->adv('/ads/location/app.channel.drees');
			 				break;
			 			case 'foods':
			 				$timekey = 2;
							$adv = $server->adv('/ads/location/app.channel.food');
			 				break;
			 			case 'live':
			 				$timekey = 3;
							$adv = $server->adv('/ads/location/app.channel.live');
			 				break;
			 			case 'walk':
			 				$timekey = 4;
							$adv = $server->adv('/ads/location/app.channel.walk');
			 				break;
			 			case 'amusement':
			 				$timekey = 5;
							$adv = $server->adv('/ads/location/app.channel.happy');
			 				break;
			 		}
			};
		}
		$categoryjson = json_encode($categoryresult);
		$this -> assign('urlcode',$urlcode);
		$this -> assign('categoryword',$categoryword);
		$this -> assign('categoryresult',$categoryresult);
		$this -> assign('categoryjson',$categoryjson);


		$categories = $twocode;
		if(empty($twocode)){
			$categories = $firstcode;
		};
	  //商品
		//$span_str = $this->request->get('_span_str');
		$aa = $this->request->get('_span_str');
		$span_str = urldecode($aa);

		$spandata = '';
		if(!empty($span_str)){
			$spandata = explode(',',$span_str);
		};
		$this -> assign('firstcode',$firstcode);
		$this -> assign('twocode',$twocode);
		$keyword = $this->request->get('keyword');
		//$brand_id = $this->request->get('brand_id');
		$brand_code = $this->request->get('brand_id');
		$brandid = urldecode($brand_code);
		$brand_id = htmlspecialchars($brandid);
		$shop_id = $this->request->get('shop_id');
		$countries = $this->request->get('countries');
		$specs = $this->request->get('specs');
		$price_min = $this->request->get('_kai');
		$price_max = $this->request->get('_jie');
		$parms = array(
			//"categories"=> $categories,
			"category_id"=> $categories,
			"brand_code"=> $brand_id,
			"shop_id"=> $shop_id,
			"countries"=> $countries,
			"specs"=> $specs,
			"sort"=> "hot_desc",
			"keyword"=> $keyword,
			"price_min"=> $price_min,
  			"price_max"=> $price_max,
			"skip"=> 0,
			"take"=> 10
		);

		$csstag = $this->request->get('csstag');
		$goodsresult = $server->goodsdata($parms);

		$this -> assign('brand_id',$brand_id);
		$this -> assign('shop_id',$shop_id);
		$this -> assign('countries',$countries);
		$this -> assign('specs',$specs);
		$this -> assign('_kai',$price_min);
		$this -> assign('_jie',$price_max);
		$this -> assign('span_str',$span_str);
		$this -> assign('csstag',$csstag);
		$this -> assign('categories',$categories);
		$this -> assign('goodsresult',$goodsresult);
		$this -> assign('spandata',$spandata);
		$parms = json_encode($parms);
		$this -> assign('parms',$parms);
		//星主题
		$starthemeresult = $server->theme();
		$this -> assign('starthemeresult',$starthemeresult);
		//限时折扣
		$time = $server->time($timekey);
		$this -> assign('time',$time);
		$this -> assign('timekey',$timekey);
		//广告位
		$this -> assign('adv',$adv);

    	$this->pages->init('二级频道');
	}
	//ajax的删选商品（人气、销量。。。）
	public function goodsAjaxAction(){

		$parms = $this->request->getPost();
		// print_r($parms);exit;
		$server = new NewcategoryService();
		$goodsresult = $server->goodsdata($parms);
		$this -> success('success',$goodsresult);
	}
	//删选
	public function filterAction(){
		$firstcode =  $this->request->get('firstcode');
		$twocode =  $this->request->get('twocode');
		//$_span_str =  $this->request->get('_span_str');
		//$brand_id = $this->request->get('brand_id');
		$brand_code = $this->request->get('brand_id');
		$brandid = urldecode($brand_code);
		$brand_id = htmlspecialchars($brandid);

		$shop_id = $this->request->get('shop_id');
		$countries = $this->request->get('countries');
		$specs = $this->request->get('specs');
		$price_min = $this->request->get('_kai');
		$price_max = $this->request->get('_jie');
		//echo "<pre>";echo $_span_str;die;

		$aa = $this->request->get('_span_str');
		$_span_str = urldecode($aa);

		$span_arr = explode(",", $_span_str);
		$span_l =  count($span_arr);
		foreach ($span_arr as $key => $value) {
			if(strpos($value, '-')){
				array_splice($span_arr,$key,1);
			};
		}
		// print_r($span_arr);exit;
		$this -> assign('span_arr',$span_arr);
		$categories =  $this->request->get('categories');
		$parms = array(
			  //"categories"=> $categories,
			"category_id"=> $categories,
			  "sort"=> "",
			  "skip"=> 0,
			  "take"=> 10
		);
		$server = new NewcategoryService();
		$goodsresult = $server->goodsdata($parms);

//		 echo "<pre>";
//		 print_r($goodsresult);
//		 exit;
		
		$pieceArea = array();
		if($goodsresult){
			$min = $goodsresult['min_price'];
			$max = $goodsresult['max_price'];
			$area = ceil(($max-$min)/4);
			$pieceArea[0] = array(
					'min'=> $min,
					'max'=> ceil($min+$area)
				);
			$pieceArea[1] = array(
					'min'=> ceil($min+$area),
					'max'=> ceil($min+$area*2)
				);
			$pieceArea[2] = array(
					'min'=> ceil($min+$area*2),
					'max'=> ceil($min+$area*3)
				);
			$pieceArea[3] = array(
					'min'=> ceil($min+$area*2),
					'max'=> $max
				);
		};
		$this -> assign('pieceArea',$pieceArea);
		$catedata = array();
		// if(!empty($goodsresult['categories'])){
		// 	$catedata['categories'] = $goodsresult['categories'];
		// };
		if(!empty($goodsresult['brands'])){
			$catedata['品牌'] = $goodsresult['brands'];
			foreach ($catedata['品牌'] as $k_b => &$val_b) {
				$val_b['band_id'] = $val_b['id'];
			}
		};
		if(!empty($goodsresult['shops'])){
			$catedata['店铺'] = $goodsresult['shops'];
			foreach ($catedata['店铺'] as $k_s => &$val_s) {
				$val_s['shop_id'] = $val_s['id'];
			}
		};
		if(!empty($goodsresult['countries'])){
			$catedata['国家'] = $goodsresult['countries'];
		};
		if(!empty($goodsresult['specs'])){
			foreach ($goodsresult['specs'] as $key => &$value) {
				$name = $value["name"];
				$catedata[$name] = $value['values'];
			}
		};
		$this -> assign('brand_id',$brand_id);
		$this -> assign('shop_id',$shop_id);
		$this -> assign('countries',$countries);
		$this -> assign('specs',$specs);
		$this -> assign('_kai',$_kai);
		$this -> assign('_jie',$_jie);
		$this -> assign('catedata',$catedata);
		$this -> assign('firstcode',$firstcode);
		$this -> assign('twocode',$twocode);

    	$this->pages->init('筛选');
	}
	//限时折扣
	public function limitAction($timekey){
		$server = new SecondService();
		$param = array(
		    "type"=>"1",
		    "size"=>"10",
		    "index"=> "1"
		);
		$limitdata = $server->limitnext($timekey,$param);
		// echo '<pre>';
		// print_r($limitdata);exit;
		$this -> assign('limitdata',$limitdata);
		$this -> assign('timekey',$timekey);

		$this->pages->init('限时折扣');
	}
	// 下期预告
	public function nextAction($timekey){
		$server = new SecondService();
		$param = array(
		    "type"=>"2",
		    "size"=>"10",
		    "index"=>"1"
		);
		$nextdata = $server->limitnext($timekey,$param);
		// print_r($nextdata);exit;
		$this -> assign('nextdata',$nextdata);
		$this->pages->init('下期预告');
	}
	// 下期预告+限时折扣-> 下拉刷新
	public function getmoreAction(){
		$server = new SecondService();
		$param = $this->request->getPost();
		$nextdata = $server->limitnext($param['type'],$param['param']);
		// echo '<pre>';
		// print_r($nextdata);exit;

		$this -> success('success',$nextdata);
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
		$this -> success('yes',$nextdata);
	}
	 // 热门搜索自动补全
	 
	public function searchAutoAjaxAction(){
	    
	    $autoVal['keyword'] = $this ->request ->getPost("keyword");
	    $search_url = "/v2/goods/searchword";

	    $searchAutoVal = array();
	     $code = $this->curl->post_request($search_url,$autoVal,'java_api');
	    if($this->curl->post_request($search_url,$autoVal,'java_api') == 200){
	        $searchAutoVal = $this->curl->getArrayData();
	    }

	    // echo "<pre>";
	    // print_r($searchAutoVal);
	    // exit;

	    if($code != 200){
	        $this->failure('false',$searchAutoVal);
	    }else{
	        $this->success('success',$searchAutoVal);
	    }


	}


}
?>