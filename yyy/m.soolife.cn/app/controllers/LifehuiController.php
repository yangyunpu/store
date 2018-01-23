<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  zhichao_hu
// |
// | Author:    qingbo_li
// | Created:   2017-05-10
// +----------------------------------------------------------------------
class LifehuiController extends BaseController
{


    // //判断是否登录
    private function go_login($url=""){
        //判断是否登录
        $futurestar_url = "/member/futurestar";
        $login_data = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $login_data = $this->curl->getArrayData();
        }
        $is_login = $login_data['is_login'];
        $return_url = base64_encode($url);
        $this->assign("is_login",$is_login);
        $this->assign("return_url",$return_url);
    }

    //惠生活频道
    public function downloadAction()
    {
        $msg_txt = trim($this->request->get('msg_txt'));
        $this -> assign('msg_txt',$msg_txt);
        $this->pages->init('');
    }
	public function indexAction()
    {

        $url = $this->config->url;

        $url_order = $url->url_order;
        $this->assign('url_member',$url['url_m2']);
        $url = $url['url_m2'] . "/lifehui/index.html";
        $this->go_login($url);


        $this -> assign('url_order',$url_order);


        //广告位
        $link_url = "/ads/location/app.chlife";
        $link = array();
        $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";

        if($this->curl->get_request($link_url,'api') == 200){
            $link = $this->curl->getArrayData();
            foreach ($link as $key => &$value) {
                foreach ($value['children'] as $k => &$v) {
                    foreach ($v['items'] as $_k => &$_v){
                        $_v['picture'] = Common::get_image_url($this -> config, $_v['picture'], '', '', 'img');
                        if (preg_match($urlReg,$_v['mobile_link'])) {
                            $_v['mobile_link'] = $_v['mobile_link'];
                        }else{
                            $_v['mobile_link'] = '#';
                        }
                    }
                }
            }
        };
        $this -> assign('link',$link);


        // 快报
        $soo_url = '/v1/expressnews';
        $soo = array();
        if($this->curl->get_request($soo_url,'life_api') == 200){
            $soo = $this->curl->getArrayData();
        }
        $num = count($soo['data']);
        // echo "<pre>";
        // print_r($soo);
        // exit;
        $this -> assign('soo',$soo);
        $this -> assign('num',$num);


        // 免费兑换
        $shop_id = '';
        $store_url = '/v1/store/search';
        $store = array();
        if($this->curl->post_request($store_url,array(),'life_api') == 200){
            $store = $this->curl->getArrayData();
            foreach ($store['list'] as $key => &$value) {
                $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'life');
            }
            $shop_id = $store['list']['0']['store_id'];
        }
        $shop_url = "/v2/store/{$shop_id}";
        $shop = array();
        if($this->curl->get_request($shop_url,'life_api') == 200){
            $shop = $this->curl->getArrayData();
            foreach ($shop['service'] as $key => &$value) {
                $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'life');
            }
        }
        $count = count($shop['service']);
        $this -> assign('count',$count);
        // echo "<pre>";print_r($store);exit;
        $this -> assign('store',$store);
        $this -> assign('shop',$shop);


        // 星粉秀
        $fan_url = "/starpink/newstarpink/1/5";
        $fan = array();
        if($this->curl->get_request($fan_url,'api') == 200){
            $fan = $this->curl->getArrayData();
            if($fan['data']){
                foreach ($fan['data'] as $key => &$value) {
                    $value['photo']= Common::get_image_url($this -> config, $value['photo'], '', '', 'fans');
                }
            }
        }
        $this -> assign('fan',$fan);
    }


    //体验店列表
    public function storeAction()
    {
        $store_url = '/v1/store/search';
        $store = array();
        if($this->curl->post_request($store_url,array(),'life_api') == 200){
            $store = $this->curl->getArrayData();
            foreach ($store['list'] as $key => &$value) {
                $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'life');
            }
        }
        $this -> assign('store',$store);
        $this->pages->init('体验店列表');
    }



    //体验店详情
    public function storedetailAction()
    {
        $store_id = trim($this->request->get('store_id'));
        $shop_url = "/v2/store/{$store_id}";
        $shop = array();
        if($this->curl->get_request($shop_url,'life_api') == 200){
            $shop = $this->curl->getArrayData();
            if($shop['service']){
                foreach ($shop['service'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'life');
                    // $value['price'] = number_format($value['price'],2);
                    $value['market_price'] = number_format($value['market_price'],2);
                }
            }
            if($shop['albums']){
                foreach ($shop['albums'] as $key => &$value)
                    $value= Common::get_image_url($this -> config, $value, '', '', 'life');
            }
            if($shop['logo']){
                $shop['logo']= Common::get_image_url($this -> config, $shop['logo'], '', '', 'life');
            }
        }
        $this -> assign('shop',$shop);
        $this->pages->init('体验店详情');
    }


     // 星粉秀列表
     public function showAction(){
        // 星粉秀
        $data = array();       
        $fan = array();
        if(!isset($skip)){
            $data = [
                'skip' => 0,
                'take' => 10
            ];
        }
        $fan_url = "/v2/starpink/newstarpinkdo/1/{$data['skip']}/{$data['take']}";
        if($this->curl->get_request($fan_url,'api') == 200){
            $fan = $this->curl->getArrayData();
            if($fan['data']){
                foreach ($fan['data'] as $key => &$value) {
                    $value['photo']= Common::get_image_url($this -> config, $value['photo'], '', '', 'fans');
                    $value['time'] =  date("Y-m-d", $value['time']);

                    foreach ($value['photos'] as $key => &$val) {
                        $val['pic']= Common::get_image_url($this -> config, $val['pic'], '', '', 'fans');
                    }
                }
            }
            $fan['skip'] = $data['skip'] ;
            $fan['take'] = $data['take'] ;
            
        }
        $this -> assign('fan',$fan);
        $this->pages->init('星粉秀列表');
     }

     // 星粉秀列表加载更多
     public function showMoreAction(){
        // 星粉秀
        $skip = $this ->request ->getPost("skip");
        $data = array();       
        $fan = array();
        if(!isset($skip)){
            $data = [
                'skip' => 0,
                'take' => 10
            ];
        }else{
            $skip = $skip + 10;
            $data = [
                'skip' => $skip,
                'take' => 10
            ];
        }
        $fan_url = "/v2/starpink/newstarpinkdo/1/{$data['skip']}/{$data['take']}";
        if($this->curl->get_request($fan_url,'api') == 200){
            $fan = $this->curl->getArrayData();
            if($fan['data']){
                foreach ($fan['data'] as $key => &$value) {
                    $value['photo']= Common::get_image_url($this -> config, $value['photo'], '', '', 'fans');
                    $value['time'] =  date("Y-m-d", $value['time']);

                    foreach ($value['photos'] as $key => &$val) {
                        $val['pic']= Common::get_image_url($this -> config, $val['pic'], '', '', 'fans');
                    }
                }
            }
            $fan['skip'] = $data['skip'] ;
            $fan['take'] = $data['take'] ;
            
        }

        // echo "<pre>";
        // print_r($fan);
        // exit;
        $this->success('success',$fan);
     }






     // 星粉秀详情
     public function showdetailAction(){
        $fanshow_id = trim($this->request->get('fanshow_id'));
        $fandetail_url = "/starpink/details/{$fanshow_id}";
        $fandetail = array();
        if($this->curl->get_request($fandetail_url,'api') == 200){
            $fandetail  = $this->curl->getArrayData();
            if($fandetail['fans_show']['albums']){
                foreach ($fandetail['fans_show']['albums'] as $key1 => &$value1)
                    $value1['photo']= Common::get_image_url($this -> config, $value1['photo'], '', '', 'fans');
            }
            if($fandetail['fans_show']['time'] ){
                $fandetail['fans_show']['time'] =  date("Y-m-d", $fandetail['fans_show']['time']);
            }
            if($fandetail['fans_show']['praise_avatar']){
                foreach ($fandetail['fans_show']['praise_avatar'] as $key2 => &$value2)
                    $value2['avatar']= Common::get_image_url($this -> config, $value2['avatar'], '', '', 'avatar');
            }
            if($fandetail['fans_show']['comments']){
                foreach ($fandetail['fans_show']['comments'] as $key3 => &$value3){
                    $value3['avatar']= Common::get_image_url($this -> config, $value3['avatar'], '', '', 'avatar');
                    $value3['create_time'] = date("Y-m-d", $value3['create_time']);
                }
            }
            $fandetail['fans_show']['avatar'] = Common::get_image_url($this -> config, $fandetail['fans_show']['avatar'], '', '', 'avatar');
        }
        $this -> assign('fandetail',$fandetail);
        $this->pages->init('星粉秀详情');
     }

     #星粉秀点赞
    public function praiseAction()
    {
        $fanshow_id = $this->request->getPost('fanshow_id');
        $data = array(
            "fanshow_id"     => $fanshow_id,
            "comment"        => "",
            "praise"         => "1",
            "to_member_name" => ""
            );
        $url = "/starpink/comment";

        $result  = array();
        if($this->curl->post_request($url,$data,'api') == 200){
            $result  = $this->curl->getArrayData();
            return $this -> success("成功!",$result,"");
        }
        return $this -> failure("失败!",$result,"");
    }

}