<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   huangluController.php
// |
// | Author: 
// | Created:   2016-05-10
// +----------------------------------------------------------------------
class CategoryController extends BaseController
{
	public function categoryAction()
    {
    	//$this->curl->get_request("/basic/category/mobile",'php_api');
        $this->curl->get_request("/basic/category/mobile",'php_api');
        $data= $this->curl->getArrayData();
        if (isset($data)){
            foreach ($data as $key => &$value) {
                foreach ($value['children'] as $key => &$v) {
                    $v['icon'] = Common::get_image_url($this -> config, $v['icon']);
                   
                }
            }
            
        }
        $this->assign('data',$data);


    	//购物车商品数量v2/cart/{sessionID}/summary
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        $this->curl->get_request("/v2/cart/{$sessionId}/summary","v2_api");
        $car= $this->curl->getArrayData();
        $num = isset($car['total_qty']) ? $car['total_qty'] : 0;
        $this -> assign('num',$num);
       
        //驱动
    	$this->pages->init('商品分类');
	}

}