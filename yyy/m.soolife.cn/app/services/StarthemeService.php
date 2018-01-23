<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class StarthemeService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
   public function startheme(){
        $data = array();
        $url = "/startheme/starthemebycategory";
        $curl = $this -> curl; 

        if($curl->get_request($url,'api') == 200){
            $data = $curl->getArrayData();
            $data = (array)$data;
        //     echo "<pre>";
        //             print_r($data);
        // exit;
            //衣
            foreach ($data['cloth'] as $k1 => &$v1) {
                $v1['sbanner'] = Common::get_image_url($this -> config, $v1['sbanner'],'','','images');
               foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
                    $v2['showimg'] = Common::get_image_url($this -> config, $v2['showimg'],'','','images');
                     $url = "/v2/promo/sku/{$v2['skuid']}/promos";
                     $v2['sprice'] = number_format($v2['sprice'], 2);
                     if ($this->curl->get_request($url, 'v2_api') == 200) {
                        $promo = $this->curl->getArrayData();
                        $v2['sprice'] = number_format($promo['price'], 2);

                     }                     
               }
            }
            //食
            foreach ($data['foods'] as $k1 => &$v1) {
                $v1['sbanner'] = Common::get_image_url($this -> config, $v1['sbanner'],'','','images');
                foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
                    $v2['showimg'] = Common::get_image_url($this -> config, $v2['showimg'],'','','images');
                     $url = "/v2/promo/sku/{$v2['skuid']}/promos";
                     $v2['sprice'] = number_format($v2['sprice'], 2);
                     if ($this->curl->get_request($url, 'v2_api') == 200) {
                        $promo = $this->curl->getArrayData();
                        $v2['sprice'] = number_format($promo['price'], 2);
                     }                     
                }
            }
            //住
            foreach ($data['live'] as $k1 => &$v1) {
                $v1['sbanner'] = Common::get_image_url($this -> config, $v1['sbanner'],'','','images');
                foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
                    $v2['showimg'] = Common::get_image_url($this -> config, $v2['showimg'],'','','images');
                     $url = "/v2/promo/sku/{$v2['skuid']}/promos";
                     $v2['sprice'] = number_format($v2['sprice'], 2);
                     if ($this->curl->get_request($url, 'v2_api') == 200) {
                        $promo = $this->curl->getArrayData();
                        $v2['sprice'] = number_format($promo['price'], 2);
                     }                     
                }
            }
             //行
            foreach ($data['walk'] as $k1 => &$v1) {
                $v1['sbanner'] = Common::get_image_url($this -> config, $v1['sbanner'],'','','images');
                foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
                    $v2['showimg'] = Common::get_image_url($this -> config, $v2['showimg'],'','','images');
                     $url = "/v2/promo/sku/{$v2['skuid']}/promos";
                     $v2['sprice'] = number_format($v2['sprice'], 2);
                     if ($this->curl->get_request($url, 'v2_api') == 200) {
                        $promo = $this->curl->getArrayData();
                        $v2['sprice'] = number_format($promo['price'], 2);
                     }                     
                }
            }
            //娱
             foreach ($data['amusement'] as $k1 => &$v1) {
                $v1['sbanner'] = Common::get_image_url($this -> config, $v1['sbanner'],'','','images');
                foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
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
        // echo "<pre>";
        // print_r($data);
        // exit;
        return $data;  
   }

   public function themechild($id){
        // $id = 147;
        $datas = array();
        $url = "/startheme/starthemedetail/{$id}";
        $curl = $this -> curl; 
        if($curl->get_request($url,'api') == 200){
 
             $datas = $curl->getArrayData();
            if($datas){
               foreach ($datas['starthemestory'] as $k1 => &$v1) {
                 foreach ($v1['sstarthemesku_dels'] as $k2 => &$v2) {
                     $v2['showimg'] = Common::get_image_url($this -> config, $v2['showimg'],'','','images');
                     $url = "/v2/promo/sku/{$v2['skuid']}/promos";
                     $v2['sprice'] = number_format($v2['sprice'], 2);
                     if ($this->curl->get_request($url, 'v2_api') == 200) {
                        $promo = $this->curl->getArrayData();
                        $v2['sprice'] = number_format($promo['price'], 2);
                     }   
                 }
              }
             $datas['sbanner'] = Common::get_image_url($this -> config,$datas['sbanner'],'','','images');
            }         
        }
         return $datas;
   }

   //推荐
    public function GuessLike($data,$token){
        // $data['size'] = 6;
        //$guesslike_url="/goods/rank/guesslike";
        $guesslike_url="/v3/goods/guesslike";
        $guesslike = array();
        // if($this->curl->post_request($guesslike_url,$data,'php_api') == 200){
        $this->curl->set_token($token);
        if($this->curl->post_request($guesslike_url,$data,'java_api') == 200){
            $guesslike = $this->curl->getArrayData();
            foreach ($guesslike['guess_list'] as $key => &$value) {

                $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
            }
        }
        // echo "<pre>";
        //         print_r($guesslike);
        //         exit;
        return $guesslike;
    }
}