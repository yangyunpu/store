<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  wentao_huang  Controller.php
// |
// | Author: 
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class NewController extends BaseController
{

    //新人专享页面
	public function peopleAction()
      {

        $url = "/v2/newspecial/index";
        $data = array();
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
        }

        $data['picture']['banner'] = Common::get_image_url($this->config,$data['picture']['banner'],'','','others');
        $data['picture']['ticket'] = Common::get_image_url($this->config,$data['picture']['ticket'],'','','others');
        if (!empty($data['sale'])) {
            foreach ($data['sale'] as $key => $value) {
                $data['sale'][$key]['picture'] = Common::get_image_url($this->config,$value['picture']);
                $data['title_a'] = $value['name'];
            }
        }

        if (!empty($data['discounts'])) {
            foreach ($data['discounts'] as $key => $value) {
                $data['discounts'][$key]['picture'] = Common::get_image_url($this->config,$value['picture']);
                $data['title_b'] = $value['name'];
            }
        }

        $this -> assign('data',$data);

    	$this->pages->init('星币说明');
	}
}