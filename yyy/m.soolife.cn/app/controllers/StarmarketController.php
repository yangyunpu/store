<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  liucunayang  Controller.php
// |
// | Author: 
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class StarmarketController extends BaseController
{
	public function starmarketAction()
    {
        //该方法去token请求接口
        $this->curl->disable_token();
    	$this->curl->get_request('/ads/location/app.supermarket','new_api');
    	$data = $this->curl->getArrayData();
    	if(isset($data))
    	{
    		foreach($data as $key => &$value)
    		{
    			foreach($value['children'] as $key => &$v)
    			{
    				foreach($v['items'] as $key => &$s)
    				{
    					$s['picture'] = Common::get_new_image_url($this -> config, $s['picture']);
    				}
    			}
    		}
    	}
    	$this -> assign('data',$data);

        //分类
        $mata = $this->redis->read_menus("mobile");
        
        if (isset($mata)){
            foreach ($mata as $key => &$value) {

                foreach ($value['children'] as $k => &$v) {

                    $v['icon'] = Common::get_image_url($this -> config, $v['icon']);
                   
                }
            }
            
        }
        //print_r($mata);exit;
        $this->assign('mata',$mata);
        
        //分类商品
        $this->curl->post_request('/v1/goods/search/metadata',array("index"=>1,"size"=>6,"search"=>array("catalog"=>''),"source"=>3,"sorting"=>array("hot"=>'DESC')),'old_api');
        $hata = $this ->curl->getArrayData();
        $result = array();
        if($hata && $hata['success'] != false){
            for($i=0;$i<count($hata['result']);$i++) {
                $result[]= $hata['result'][$i];
            }
        }
        $wata = array();
        if($this->curl->post_request('/v1/goods',implode(",",$result)) == 200){
            $wata = $this ->curl->getArrayData();      
        }
        if (empty($wata)){
            foreach ($wata as $key => &$value) {
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);       
            }
            
        }
        $this->assign('wata',$wata);


    	$this->pages->init('星超市');
	}

        //分类js
        public function marketAction()
        {
            $index= $this ->request->getPost("index");
            $code = $this ->request->getPost("code");
            $this->curl->post_request('/v1/goods/search/metadata',array("index"=>$index,"size"=>6,"search"=>array("catalog"=>$code),"source"=>3,"sorting"=>array("hot"=>'DESC')),'old_api');
            $data = $this ->curl->getArrayData();
            $result = array();
            if(isset($data)){
                 for($i=0;$i<count($data['result']);$i++)
                 {
                    $result[]= $data['result'][$i];
                 }
                $this->curl->post_request('/v1/goods',implode(",",$result),'old_api');
                $kaka = $this ->curl->getArrayData();
                if (isset($kaka)){
                foreach ($kaka as $key => &$value) {
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);       
                       }
            
                }
                return $this -> success("成功!",$kaka,"");
            }
            return $this -> failure("失败!",$kaka,"");
        }

	
}