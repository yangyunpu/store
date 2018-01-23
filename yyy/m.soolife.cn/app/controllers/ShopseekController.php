<?php
// +----------------------------------------------------------------------
// | test 
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-03-17
// +----------------------------------------------------------------------

//
class ShopseekController extends BaseController{
	//全民商探
	public function  shopseekAction(){ 
			$url = "/member/sign";
		   	$curl = $this -> curl;
		   	if($curl ->get_request($url,'api') == 200){
		   		$res = $curl -> getJsonData();
		   		 return;
		   	}
		   
		$this->pages->init('全民商探');
	}
	//商家报备选项
	public function  shopmodelAction(){
		$this->pages->init('商家报备选项');
	}
	//商家报备选项
	public function  shopreportAction(){

		if($this->request->isPost()){
			$data=[
				  "name"=> $_POST['gongsiname'], 
				  "supplier_industry"=> $_POST['industry'], 
				  "region_no"=>$_POST['area'], 
				  "address"=>$_POST['address'], 
				  "phone"=>$_POST['gongsiiphone'], 
				  "chargeman_name"=>$_POST['toppersoner'], 
				  "linkman_name"=>$_POST['linkname'], 
				  "linkman_phone"=>$_POST['linktel'], 
				  "supplier_visit_type"=>$_POST['lianxi'], 
				  "supplier_from"=>$_POST['fuzhi']  
				];
		   		$url = "/v2/member/supplierpply";
   		   		$curl = $this -> curl;
	        if($curl-> post_request($url,$data,'api') == 200){ 
	            $res = $curl -> getJsonData();
	            if($res->code == '200'){
                     return $this->success("报备成功");
	            }else{
	            	return;	            	
	            }
	        } 
		}else{ 
			$url = '/member';
			$res = array();
			if($this->curl->get_request($url,'api') == 200) {
				$res = $this->curl->getJsonData();
			}
			$this->assign('nickname',$res->nickname);
			$this->pages->init('商家报备');
		}

	}
 	 //商家签约
	public function  shopsignAction(){
		$this->pages->init('商家签约');
	}
	 //商家签约
	public function  shopincomeAction(){

		$url = "/member/settled/0/10"; 
		$curl = $this -> curl;
		$data=["type"=>1];//商家签约
		$res = ["type" =>10]; // 商家报备 
		// echo "<pre>";
		// print_r($curl -> post_request($url,$data,'new_api'));
		// exit;
		if($curl -> post_request($url,$data,'new_api') == 200){
			$data = $curl -> getArrayData();
		}
		if($curl -> post_request($url,$res,'new_api') == 200){
			$res = $curl -> getArrayData();
		}
		$this -> assign("result", $data); 
		$this -> assign('data',$res);
		// echo "<pre>";
		// print_r($data);
		// exit;

		$this->pages->init('商谈收入');

	}
}