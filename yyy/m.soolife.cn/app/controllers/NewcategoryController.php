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
class NewcategoryController extends BaseController
{
	public function newcategoryAction(){
		$server = new NewcategoryService();

		$categoryresult = $server->categorydata();
		$categoryjson = json_encode($categoryresult);
		//echo "<pre>";print_r($categoryresult);die;
		$hot = $this->seek();
		$this -> assign('categoryresult',$categoryresult);
		$this -> assign('categoryjson',$categoryjson);
		$this -> assign('hot',$hot);
    	$this->pages->init('分类');
	}
	public function threecateAction(){
		// 二级+三级按钮
		$firstcode =  $this->request->get('firstcode');
		$twocode =  $this->request->get('twocode');
		$threecode =  $this->request->get('threecode');
		$urlcode['firstcode'] = $firstcode;
		$urlcode['twocode'] = $twocode;
		$urlcode['threecode'] = $threecode;
		$server = new NewcategoryService();

		$categoryresult = $server->categorydata();

		$categoryjson = json_encode($categoryresult);
		$this -> assign('urlcode',$urlcode);
		$this -> assign('categoryresult',$categoryresult);
		$this -> assign('categoryjson',$categoryjson);

		$categories = $threecode;
		if(empty($threecode)){
			$categories = $twocode;
		};
		if($twocode=="allcode"){
			$categories = $firstcode;
		};
		if(empty($twocode)){
			$categories = $firstcode;
		};
		//商品
		$aa = $this->request->get('_span_str');

		$span_str = urldecode($aa);

		if(!empty($span_str)){
			$spandata = explode(',',$span_str);
		};

		$keyword = $this->request->get('keyword');
		$brand_code = $this->request->get('brand_id');

		$brandid = urldecode($brand_code);
		$brand_id = htmlspecialchars($brandid);
		$shop_id = $this->request->get('shop_id');
		$countries = $this->request->get('countries');
		$specs = $this->request->get('specs');
		$price_min = $this->request->get('_kai');
		$price_max = $this->request->get('_jie');
		$csstag = $this->request->get('csstag');
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
			"take"=> 20
		);

		$goodsresult = $server->goodsdata($parms);
		//echo "<pre>";print_r($goodsresult);die;
		$this -> assign('keyword',$keyword);
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
		$hot = $this->seek();
		$this -> assign('hot',$hot);
		$this -> assign('firstcode',$firstcode);
		$this -> assign('twocode',$twocode);
		$this -> assign('threecode',$threecode);
    	$this->pages->init('三级分类');
	}
	//ajax的删选商品（人气、销量。。。）
	public function goodsAjaxAction(){

		$parms = $this->request->getPost();

		$server = new NewcategoryService();
		$parms['skip'] = (int)$parms['skip'];
		$parms['take'] = (int)$parms['take'];
		$goodsresult = $server->goodsdata($parms);
		//echo "<pre>";print_r($goodsresult);die;
		$this -> success('success',$goodsresult);
	}
	public function filterAction(){

		$firstcode =  $this->request->get('firstcode');
		$twocode =  $this->request->get('twocode');
		$threecode =  $this->request->get('threecode');
		$brand_code = $this->request->get('brand_id');
		$brandid = urldecode($brand_code);
		$brand_id = htmlspecialchars($brandid);
		$shop_id = $this->request->get('shop_id');
		$countries = $this->request->get('countries');
		$specs = $this->request->get('specs');
		$price_min = $this->request->get('_kai');
		$price_max = $this->request->get('_jie');

		//$_span_str =  $this->request->get('_span_str');
		$aa = $this->request->get('_span_str');
		$_span_str = urldecode($aa);

		$span_arr = explode(",", $_span_str);
		$span_l =  count($span_arr);
		foreach ($span_arr as $key => $value) {
			if(strpos($value, '-')){
				array_splice($span_arr,$key,1);
			};
		}
		$this -> assign('span_arr',$span_arr);

		//$categories =  $this->request->get('categories');
		$categories = $threecode;
		if(empty($threecode)){
			$categories = $twocode;
		};
		if($twocode=="allcode"){
			$categories = $firstcode;
		};
		if(empty($twocode)){
			$categories = $firstcode;
		};
		$keyword =  $this->request->get('keyword');
		$parms = array(
			  //"categories"=> $categories,
			  "category_id"=> $categories,
			  "keyword"=> $keyword,
			  "sort"=> "",
			  "skip"=> 0,
			  "take"=> 20
		);

		$server = new NewcategoryService();
		$goodsresult = $server->goodsdata($parms);
		//echo "<pre>";print_r($goodsresult);die;
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
					'min'=> ceil($min+$area*3),
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
				$val_b['band_id'] = $val_b['name'];
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
		//echo "<pre>";print_r($specs);die;
		$this -> assign('keyword',$keyword);
		$this -> assign('brand_id',$brand_id);
		$this -> assign('shop_id',$shop_id);
		$this -> assign('countries',$countries);
		$this -> assign('specs',$specs);
		$this -> assign('_kai',$_kai);
		$this -> assign('_jie',$_jie);
		$this -> assign('catedata',$catedata);
		$this -> assign('firstcode',$firstcode);
		$this -> assign('twocode',$twocode);
		$this -> assign('threecode',$threecode);
    	$this->pages->init('筛选');
	}

	//热首页搜索
    public function seek(){
        $this->curl->get_request('/goods/search/hottag/6');
        $hot= $this->curl->getArrayData();
        return $hot;
    }

    // 搜索
    public function searchAutoAjaxAction(){
    	$autoVal['keyword'] = $this ->request ->getPost("keyword");
    	// echo "<pre>";
    	// print_r($autoVal);
    	// exit;
    	$search_url = "/v2/goods/searchword";

    	$searchAutoVal = array();
    	$code = $this->curl->post_request($search_url,$autoVal,'java_api');
    	if($this->curl->post_request($search_url,$autoVal,'java_api') == 200){
    	    $searchAutoVal = $this->curl->getArrayData();
    	}


    	if($code != 200){
    	    $this->failure('false',$searchAutoVal);
    	}else{
    	    $this->success('success',$searchAutoVal);
    	}
    }

}
