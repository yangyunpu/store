<?php
/**
* 
* @return 
* @param 
* @author zhichao_hu@soolife.com.cn
* @date 
*/
use Phalcon\Mvc\User\Component;
class StarhuiService extends BaseService {
   
   /**
   * @param 
   * @author leijunjie
   */
    public function starHui(){
    	$data = array();
    	$url = "/ads/location/app.ex_gratia";
    	$curl = $this -> curl;
    	if($curl->get_request($url,'api') == 200){
    		$data = $curl->getJsonData();
    		$data = (array)$data;
    		foreach ($data['app.ex_gratia.banner']->children as $key => &$value) {
    		    $value = (array)$value;
    		    $value['items'] = (array)$value['items'];
    		    foreach ($value['items'] as $k => &$v) {
    		    	$v = (array)$v;
    		    	$v['picture'] = Common::get_image_url($this -> config, $v['picture'],'','','img');
    		    }
    		   return $value['items'];
    		}
    	}
		return $data;
	}
}