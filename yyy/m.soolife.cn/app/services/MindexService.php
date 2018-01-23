<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class MindexService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
    public function index(){
  //   	$data = array();
  //       $url = "/member/gaincoin";
  //   	$curl = $this -> curl;

  //       if($curl->get_request($url,'api') == 200 || $curl->get_request($url,'api') == 403){
  //           $data = $curl->getArrayData();
  //       }

  //       // echo "<pre>";
  //       // print_r($data);
  //       // exit;
		// return $data;
	}

    //广告位接口
    public function ads(){
        $data = array();
        $ads_url ="/ads/location/app.index";
        // $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";
        $data['advertising'] = array();

                /*echo "<pre>";
                print_r($this->curl->get_request($ads_url,'api'));
                print_r($ads_url);
                exit;*/
        if($this->curl->get_request($ads_url,'api') == 200){
            $data['advertising'] = $this ->curl->getArrayData();
            foreach ($data['advertising'] as $key => &$value) {
                foreach ($value['children'] as $k => &$v) {
                    foreach ($v['items'] as $_k => &$_v){
                        $_v['picture'] = Common::get_image_url($this -> config, $_v['picture'], '', '', 'img');
                        if ($_v['mobile_link'] != "http://") {
                            $_v['mobile_link'] = $_v['mobile_link'];
                        }else{
                            $_v['mobile_link'] = '#';
                        }
                    }
                }

            }
        }
        $url = "/home/page/star";
        $data['star_theme'] = array();
        if($this->curl->get_request($url,'api') == 200){
            $data['star_theme'] = $this->curl->getArrayData();
                // echo "<pre>";
                // print_r($data['star_theme']);
                // exit;
            foreach ($data['star_theme'] as $k1 => &$v1) {
                if(!empty($v1)){
                    $v1['banner'] = Common::get_image_url($this -> config, $v1['banner'], '', '', 'images');
                    foreach ($v1['goods'] as $k2 => &$v2) {
                        $v2['sku_img'] = Common::get_image_url($this -> config, $v2['sku_img'], '', '', 'images');
                        $v2['price'] = number_format($v2['price'], 2);
                    }
                }
            }
        }

                // echo "<pre>";
                // print_r($data);
                // exit;


        return $data;
    }
     //猜你喜欢
    public function GuessLike($data,$token){
        
       /* $guesslike_url="/goods/rank/guesslike";
        $guesslike = array();
        if($this->curl->post_request($guesslike_url,$data,'php_api') == 200){
            $guesslike = $this->curl->getArrayData();
            foreach ($guesslike as $key => &$value) {
                $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
            }
        }
        // echo "<pre>";
        //         print_r($guesslike);
        //         exit;
        return $guesslike;*/

        // $data['size'] = 64; //控制一次请求的数量
        $guesslike_url="/v3/goods/guesslike";
        $guesslike = array();
        $this->curl->set_token($token);
        if($this->curl->post_request($guesslike_url,$data,'java_api') == 200){
            $guesslike = $this->curl->getArrayData();

            foreach ($guesslike['guess_list'] as $key => &$value) {
                $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
            }
        }
       // var_dump($guesslike);die;
        return $guesslike;
    }
   
}