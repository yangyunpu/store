<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class BrandhuiService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
   public function brandHui(){
        $data = array();
        $url = "/ads/location/app.brand_gratia";
        $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";

        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            $data = $data['app.brand_gratia.index']['children'];
            foreach ($data as $key => &$value) {
                foreach ($value['items'] as $k => &$v) {
                    $v['picture'] = Common::get_image_url($this -> config, $v['picture'],'','','img');
                    if (preg_match($urlReg,$v['mobile_link'])) {
                        $v['mobile_link'] = $v['mobile_link']; 
                    }else{
                        $v['mobile_link'] = '#';
                    }
                }
            }
        }
        return $data;
   }

}