<?php
/**
*
* @return
* @param
* @author cunyang_liu@soolife.com.cn
* @date
*/
use Phalcon\Mvc\User\Component;
class OverseagoodsService extends BaseService {
    // 海外精品
    public function overseaindex(){
        $url = "/v2/overseas/detail";
        $data = array();
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            foreach ($data as $key => &$value)
                foreach ($value as $k => &$v) {
                    if(count($v['details']) > 8){
                        $v['details'] = array_slice($v['details'],0,8);
                    }
                    foreach ($v['details'] as $_k => &$_v) {
                        $_v['good_logo'] = Common::get_image_url($this -> config, $_v['good_logo'], '', '', 'images');
                    }
                }
        }
        if($data['today']){
            $data['today'] = $data['today'][0];
        }
        if($data['tomorrow']){
            $data['tomorrow'] = $data['tomorrow'][0];
        }
        return $data;
    }
    public function hot($param){
        $url = "/v2/overseas/goods/list";
        $data = array();
        if($this->curl->post_request($url,$param,'api') == 200){
            $data = $this->curl->getArrayData();
            foreach ($data['goods'] as $key => &$value)
                $value['logo'] = Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
        }
        return $data;
    }
     // 今天+明天
    public function day($params){
        $url = "/v2/overseas/list";
        $data = array();
        if($this->curl->post_request($url,$params,'api') == 200){
            $data = $this->curl->getArrayData();
        // print_r($data);exit;
            if($data['goods']){
            foreach ($data['goods'] as $key => &$value)
                foreach ($value['details'] as $k => &$v)
                       $v['good_logo'] = Common::get_image_url($this -> config, $v['good_logo'], '', '', 'images');
            }
        }
        return $data;
    }


    public function more($params){
        $url = "/v2/overseas/goods/list";
        $data = array();
        if($this->curl->post_request($url,$params,'api') == 200){
            $data = $this->curl->getArrayData();
            if($data['goods']){
                foreach ($data['goods'] as $key => &$value)
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
            }
        }
        return $data;
    }





    //广告位接口
    public function adv(){
        $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";
        $data = array();
        $ads_url = "/ads/location/app.oversea";
        if($this->curl->get_request($ads_url,'api') == 200){
            $data = $this ->curl->getArrayData();
            foreach ($data['app.oversea.index']['children'] as $key => &$value) {
                foreach ($value['items'] as $k => &$v){
                        if (!preg_match($urlReg,$v['mobile_link'])) {
                            $v['mobile_link'] = '#';
                        }
                        $v['picture'] = Common::get_image_url($this -> config, $v['picture'], '', '', 'img');
                }
            }
            //处理数据
            $si = array();
            $si_banner = $data['app.oversea.index']['children']['app.oversea.index.banner']['items'];
            $si_lslide = $data['app.oversea.index']['children']['app.oversea.index.lslide']['items'];
            $si_mslide = $data['app.oversea.index']['children']['app.oversea.index.mslide']['items'];
            $si_rslide = $data['app.oversea.index']['children']['app.oversea.index.rslide']['items'];
            $len = max(count($si_banner),count($si_lslide),count($si_mslide),count($si_rslide));
            for ($x=0; $x<$len; $x++) {
                if (array_key_exists($x,$si_banner)) {$si[$x]['banner'] = $si_banner[$x];}else{$si[$x]['banner'] = array();};
                if (array_key_exists($x,$si_lslide)) {$si[$x]['lslide'] = $si_lslide[$x];}else{$si[$x]['lslide'] = array();};
                if (array_key_exists($x,$si_mslide)) {$si[$x]['mslide'] = $si_mslide[$x];}else{$si[$x]['mslide'] = array();};
                if (array_key_exists($x,$si_rslide)) {$si[$x]['rslide'] = $si_rslide[$x];}else{$si[$x]['rslide'] = array();};
            }
            $datall['carouselbanner'] = $data['app.oversea.index']['children']['app.oversea.index.carouselbanner']['items'];
            $datall['leftcolumn'] = $data['app.oversea.index']['children']['app.oversea.index.leftcolumn']['items'];
            $datall['rightcolumn'] = $data['app.oversea.index']['children']['app.oversea.index.rightcolumn']['items'];
            $datall['si'] = $si;
        }
        return $datall;
    }

}
?>