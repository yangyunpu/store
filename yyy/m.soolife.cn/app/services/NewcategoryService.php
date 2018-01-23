<?php
/**
* 
* @return 
* @param 
* @author cunyang_liu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class NewcategoryService extends BaseService { 
    public function categorydata(){
        $url = "/v2/category/three/code";
        $categorydata = array();
        if($this->curl->get_request($url,'api') == 200){
            $categorydata = $this->curl->getArrayData();
            foreach ($categorydata as $key => &$value) {
                $value['img']= Common::get_image_url($this -> config, $value['img'], '', '', 'others'); 
            };
            foreach ($categorydata as $key => &$value) 
                foreach ($value['items'] as $k => &$v)   
                        $v['img'] = Common::get_image_url($this -> config, $v['img'], '', '', 'others'); 
            foreach ($categorydata as $key => &$value) 
                foreach ($value['items'] as $k => &$v) 
                    foreach ($v['items'] as $_k => &$_v) 
                        $_v['img'] = Common::get_image_url($this -> config, $_v['img'], '', '', 'others');  
        } 
        return $categorydata;
    } 
    public function goodsdata($parms){
        // $url = "/v2/goods/search2";
        $url = "/v2/goods/search";
        // echo "<pre>";print_r($this->curl->post_request($url,$parms,'v2_api'));
         //echo "<pre>";print_r($this->curl->post_request($url,$parms,'java_api'));
        $data = array();
        if($this->curl->post_request($url,$parms,'java_api') == 200){
        // if($this->curl->post_request($url,$parms,'v2_api') == 200){
            $data = $this->curl->getArrayData();
            //echo "<pre>";print_r($data);die;
            foreach ($data['items'] as $key => &$value) {
                $value['items'][0]['logo']= Common::get_image_url($this -> config, $value['items'][0]['logo'], '', '', 'images');
                $value['items'][0]['promo']['price'] = number_format($value['items'][0]['promo']['price'],2);  
            };  
        } 
        return $data;
    }   

  
}
?>