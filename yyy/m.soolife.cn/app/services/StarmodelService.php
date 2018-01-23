<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class StarmodelService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
   public function starModel(){
   		$data = array();
   		$url = "/ads/location/app.starfans";
   		$curl = $this -> curl;
   		if($curl->get_request($url,'new_api') == 200){
   			$data = $curl -> getArrayData();
             foreach ($data as $k1 => &$v1) {
                foreach ($v1['children'] as $k2 => &$v2) {
                   foreach ($v2['items'] as $k3 => &$v3) {
                      $v3['picture'] =  Common::get_image_url($this -> config, $v3['picture'], '', '', 'img');
                   }
                }
             }
   		}
      // echo "<pre>";
      // print_r($data);
      // exit;
      return $data;

   }
   public function  themeModel(){
      $data = array();
      $url = "/startheme/starthemebycategory";
      $curl = $this -> curl;
      if($curl -> get_request($url,'new_api') == 200){
            $data = $curl->getArrayData();
            $data = (array)$data;
            //衣
            if ($data) {
              $data = $data['cloth'];
              foreach ($data as $k1 => &$v1) {
                $v1['sbanner'] = Common::get_image_url($this -> config, $v1['sbanner'],'','','images');
                foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
                  if($k2 > 2){
                    unset($v1['sstarthemesku_dels'][$k2]);
                  }else{
                    $v2['showimg'] = Common::get_image_url($this -> config, $v2['showimg'],'','','images');
                    $url = "/v2/promo/sku/{$v2['skuid']}/promos";
                    $v2['sprice'] = number_format($v2['sprice'], 2); 
                    if ($this->curl->get_request($url, 'v2_api') == 200) {
                        $promo = $this->curl->getArrayData();
                        $v2['sprice'] = number_format($promo['price'], 2);
                    }   
                  }
                }
              }
            }
     
      }
      // echo "<pre>";
      // print_r($data);
      // exit;
      return $data;
   }

   public function clothCode(){
    $date = array();
    $url = "/v2/category/three/code";
    $curl = $this -> curl; 
    if($curl->get_request($url,'new_api') == 200){
      $data = $curl->getArrayData();
      if(!empty($data)){
        foreach ($data as $key => $value) {

                if(!empty($value)) {
                    foreach ($value['items'] as $k_c => $v_c) {
                          if ($v_c['name'] == "服装鞋靴") {
                                        $data = $v_c['items'];
                          }
                    }
              }
        }
      }
    }

    return $data;
   }

    public function clothModel($arr){
       $result = array();
       $url = "/v2/goods/search";
       $curl = $this -> curl;
       //if($curl -> post_request($url,$arr,'v2_api') == 200){
        if($curl -> post_request($url,$arr,'java_api') == 200){
            $result = $curl->getArrayData();
            if(!empty($result)){
              foreach ($result['items'] as $key => &$value) {
                  $value = $value['items'][0]; //新加
                $value['market_price'] = number_format($value['market_price'],2);
                $value['price'] = number_format($value['price'],2);
                $value['logo'] = Common::get_image_url($this -> config, $value['logo'],'','','images');
              }
            }
       }
    return $result;
    }

}