<?php
/**
*
* @return
* @param
* @author cunyang_liu@soolife.com.cn
* @date
*/
use Phalcon\Mvc\User\Component;
class SecondService extends BaseService {

    public function categorydata(){
        $url = "/v2/category/three/code";
        $categorydata = array();
        if($this->curl->get_request($url,'api') == 200){
            $categorydata = $this->curl->getArrayData();
            if(!empty($categorydata)){
                foreach ($categorydata as $key => &$value) {
                    $value['img']= Common::get_image_url($this -> config, $value['img'], '', '', 'others');
                };
                foreach ($categorydata as $key => &$value)
                    foreach ($value['items'] as $k => &$v)
                            $v['img'] = Common::get_image_url($this -> config, $v['img'], '', '', 'others');
                foreach ($categorydata as $key => &$value)
                    foreach ($value['items'] as $k => &$v)
                        foreach ($v['items'] as $_k => &$_v)
                            $_v['img'] = Common::get_image_url($this -> config, $_v['img'], '', '', 'img');
            }
        }
        return $categorydata;
    }
    public function goodsdata($parms){
        //$url = "/v2/goods/search2";
        $data = array();
        //if($this->curl->post_request($url,$parms,'v2_api') == 200){
        if($this->curl->post_request('/v2/goods/search',$parms,'java_api') == 200){
            $data = $this->curl->getArrayData();
            if(!empty($data)){
                foreach ($data['items'] as $key => &$value) {
                    $value['items'][0]['logo']= Common::get_image_url($this -> config, $value['items'][0]['logo'], '', '', 'images');
                    $value['items'][0]['promo']['price'] = number_format($value['items'][0]['promo']['price'],2);
                };
            }
        }
        //echo "<pre>";print_r($data);die;
        return $data;
    }
    //星主题
    public function theme(){
        $url = "/home/page/star";
        $data = array();
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            if(!empty($data)){
                foreach ($data as $k1 => &$v1) {
                    if(!empty($v1)){
                        $v1['banner'] = Common::get_image_url($this -> config, $v1['banner'], '', '', 'images');
                        foreach ($v1['goods'] as $k2 => &$v2) {
                            $v2['sku_img'] = Common::get_image_url($this -> config, $v2['sku_img'], '', '', 'images');
                            $v2['price'] = number_format($v2['price'], 2);
                        }
                    }
                }
            }
        }
        return $data;
    }

    //限时...首页
    public function time($timekey){
        $url = "/v2/category/{$timekey}";
        $data = array();
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            if(!empty($data)){
                foreach ($data as $k1 => &$v1) {
                    if(!empty($v1)){
                        $v1['good_logo'] = Common::get_image_url($this -> config, $v1['good_logo'], '', '', 'images');
                    }
                }
            }
        }
        return $data;
    }
    //限时折扣
    public function limitnext($timekey,$param){
        $url = "/v2/category/list/{$timekey}";
        $data = array();
        if($this->curl->post_request($url,$param,'api') == 200){
            $data = $this->curl->getArrayData();
            if(!empty($data)){
                foreach ($data['goods'] as $k1 => &$v1) {
                    foreach ($v1['details'] as $k2 => &$v2) {
                        $v2['good_logo'] = Common::get_image_url($this -> config, $v2['good_logo'], '', '', 'images');
                    }
                }
            }
        }
        return $data;
    }
    //加入购物车
    public function addcar($sessionId,$skuId,$qty){
        $url = "/v2/cart/{$sessionId}/goods/{$skuId}";
        $data = array();
        if($this->curl->post_request($url,$qty,'v2_api')){
            $data = $this->curl->getArrayData();
        }
        return $data;
    }
    //广告位接口
    public function adv($advurl){
        $data = array();
        $datall = array();
        $ads_url = $advurl;
        if($this->curl->get_request($ads_url,'api') == 200){
            $data = $this ->curl->getArrayData();
            if(!empty($data)){
                foreach ($data as $key => &$value) {
                    foreach ($value['items'] as $k => &$v) {
                            $v['picture'] = Common::get_image_url($this -> config, $v['picture'], '', '', 'img');
                    }
                }
                $i = 0;
                foreach ($data as $key => $val) {
                    $datall[$i] = $val;
                    $i++;
                }
            }

        }
        return $datall;
    }

    // 热门搜索
    public function search(){
        $search_url = "/goods/search/hottag/6";
        $search = array();
        if($this->curl->get_request($search_url,'api') == 200){
            $search = $this ->curl->getArrayData();
        }
        return $search;
    }
}
?>