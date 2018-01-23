<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  liucunyang  Controller.php
// |
// | Author:
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class StarstyleController extends BaseController
{
	public function starstyleAction()
    {
        //该方法去token请求接口
        $this->curl->disable_token();
    	$this->curl->get_request('/ads/location/app.star','new_api');
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

        //驱动
        $this->display("starstyle/starstyle");
        $this->pages->init('星范');
    // echo "<pre>";
    // print_r($data);
    // exit;
    }

}