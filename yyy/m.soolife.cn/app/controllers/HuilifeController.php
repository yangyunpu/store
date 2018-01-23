<?php
// +----------------------------------------------------------------------
// | test
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-03-17
// +----------------------------------------------------------------------


//惠生活
class HuilifeController extends BaseController
{
    public function indexAction()
    {

        //个人信息（零星币首页）
        $futurestar_url = "/member/futurestar";
        $coinExplain = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $coinExplain = $this->curl->getArrayData();
            $coinExplain['avatar'] = Common::get_image_url($this -> config, $coinExplain['avatar'],'','','avatar');
        }
        $this -> assign('coinExplain',$coinExplain);


        //星币任务
        $starurrency_url = "/member/starcurrency";
        $coinTask     = array();
        if($this->curl->get_request($starurrency_url,'api') == 200){
            $coinTask = $this->curl->getArrayData();
            foreach ($coinTask['data'] as $key => &$value)
                 $value['image'] = Common::get_image_url($this -> config, $value['image'],'','','others');
        }
        $this -> assign('coinTask',$coinTask);


        //领星币 首页：
        $ads_location = "/ads/location/app.coin";
        $adscoin      = array();
        if($this->curl->get_request($ads_location,'api') == 200){
            $adscoin = $this->curl->getArrayData();
            foreach ($adscoin as $key => &$value)
                foreach ($value['children'] as $k => &$v)
                    foreach ($v['items'] as $_k => &$_v)
                        $_v['picture'] = Common::get_image_url($this -> config, $_v['picture'], '', '', 'img');

        }
        $app_coin_ex_buy = $adscoin['app.coin.ex_buy']['children'];
        $app_coin_exchange = $adscoin['app.coin.exchange']['children'];


        $this -> assign('app_coin_exchange',$app_coin_exchange);
        $this -> assign('app_coin_ex_buy',$app_coin_ex_buy);
        $this -> assign('adscoin',$adscoin);


        //购物车商品数量v2/cart/{sessionID}/summary
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        $this->curl->get_request("/v2/cart/{$sessionId}/summary","v2_api");
        $car = $this->curl->getArrayData();
        $num = isset($car['total_qty']) ? $car['total_qty'] : 0;
        $this -> assign('num',$num);

        $this->pages->init('领星币');
    }

	//领星币
	public function getcoinAction()
    {
		$url  = "/member/gaincoin";
    	$coin = array();
    	if($this->curl->get_request($url,'api') == 200){
    		$coin = $this->curl->getArrayData();
    		return $this -> success("成功!",$coin,"");
    	}
    	return $this -> failure("失败!",$coin,"");
	}

    //得到更多
	public function getmoreAction()
    {

        //是否登录
        $futurestar_url = "/member/futurestar";
        $login_data = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $login_data = $this->curl->getArrayData();
            $login_data['avatar'] = Common::get_image_url($this -> config, $login_data['avatar'],'','','avatar');
        }
        $is_login = $login_data['is_login'];
        $is_get = $login_data['is_get'];
        $get_state = $login_data['data'];
        // print_r($login_data['data'][0]['coin']);exit;
        $this -> assign('is_login',$is_login);
        $this -> assign('is_get',$is_get);
        $this -> assign('get_state',$get_state);
        //得到更多-广告位
        $coinTaskAd_url = "/ads/lively/app.gain_more.banner.001";
        $coinTaskAd     = array();
        if($this->curl->get_request($coinTaskAd_url,'api') == 200){
            $coinTaskAd = $this->curl->getArrayData();
            foreach ($coinTaskAd['app.gain_more.banner.001'] as $key => &$value)
                 $value['picture'] = Common::get_image_url($this -> config, $value['picture'], '', '','img');
        }
        $coinTaskAd_banner = $coinTaskAd['app.gain_more.banner.001'][0]['picture'] ;
        $this -> assign('coinTaskAd_banner',$coinTaskAd_banner);


        //得到更多-星币任务
        $starurrency_url = "/member/starcurrency";
        $coinTask     = array();
        if($this->curl->get_request($starurrency_url,'api') == 200){
            $coinTask = $this->curl->getArrayData();
            foreach ($coinTask['data'] as $key => &$value)
                 $value['image'] = Common::get_image_url($this -> config, $value['image'],'','','others');
        }
        $this -> assign('coinTask',$coinTask);

    	$this->pages->init('领取更多');
        //
	}
//星兑换
    public function starchangeAction()
    {

        $data = array(
            "skip"=>"0",
            "take"=>"10",
            "category"=>"",
            "just_coin"=>true,
            "coin_min"=>"",
            "coin_max"=>""
        );
        //星兑换-星币数
            $starchange_url = "/member/futurestar";
            $starchangeCoinNum = array();
            if($this->curl->get_request($starchange_url,'api') == 200){
                $starchangeCoinNum = $this->curl->getArrayData();
            }
            $coinNum = $starchangeCoinNum['coin'];
            $this -> assign('coinNum',$coinNum);
        //星兑换-广告位
            $starchangeAd_url = "/ads/lively/app.exchange.banner.001";
            $starchangeAd = array();
            if($this->curl->get_request($starchangeAd_url,'api') == 200){
                $starchangeAd = $this->curl->getArrayData();
                foreach ($starchangeAd['app.exchange.banner.001'] as $key => &$value)
                     $value['picture'] = Common::get_image_url($this -> config, $value['picture'], '', '', 'img');
            }
            $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";
            $starchangeAd_banner = $starchangeAd['app.exchange.banner.001'][0]['picture'];
            $starchangeAd_link_before = $starchangeAd['app.exchange.banner.001'][0]['mobile_link'];
            if (preg_match($urlReg,$starchangeAd_link_before)) {
                $starchangeAd_link = $starchangeAd_link_before;
            }else{
                $starchangeAd_link = '#';
            }
            $this -> assign('starchangeAd_banner',$starchangeAd_banner);
            $this -> assign('starchangeAd_link',$starchangeAd_link);
        //星兑换-（衣食住行）
            $starchangeBtn_url = "/category/code";
            $starchangeBtn = array();
            if($this->curl->get_request($starchangeBtn_url,'api') == 200){
                $starchangeBtn = $this->curl->getArrayData();
            }
            $this -> assign('starchangeBtn',$starchangeBtn);
        //星兑换-内容
        $starchangeM_url = "/v2/coin/activity";
        $starchangeM     = array();
        $this->curl->disable_token();
        if($this->curl->post_request($starchangeM_url,$data,'api') == 200){
            $starchangeM = $this->curl->getArrayData();
            foreach ($starchangeM['data'] as $key => &$value)
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
        }
        // print_r($starchangeM);exit;
        $starchangeM_data = $starchangeM['data'];
        $this -> assign('starchangeM_data',$starchangeM_data);

        $this->pages->init('星兑换');
    }

//星兑换ajax
    public function starchangeAjaxAction()
    {

        if(empty($_POST)){
            $this->failure("失败");
        }else{
            $data = $_POST;
        }
        //星兑换-内容
        $starchangeM_url = "/v2/coin/activity";
        $starchangeM     = array();
        $this->curl->disable_token();
        if($this->curl->post_request($starchangeM_url,$data,'api') == 200){
            $starchangeM = $this->curl->getArrayData();
            foreach ($starchangeM['data'] as $key => &$value)
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
        }

        $starchangeM_data = $starchangeM['data'];
        $this->success("成功",$starchangeM_data);
    }
//星换购
	public function starpurchaseAction()
    {
         $data = array(
              "categories"=> "",
              "brand_id"=> "",
              "price_min"=> 0,
              "price_max"=> 0,
              "specs"=> "",
              "is_oversea"=> 0,
              "just_coin"=>false,
              "is_coin"=> true,
              "countries"=> "",
              "keyword"=> "",
              "debug"=> false,
              "sort"=> "",
              "skip"=> 0,
              "take"=> 20
        );
        //星换购-星币数
        $starexBuy_url = "/member/futurestar";
        $starexBuyCoinNum = array();
        if($this->curl->get_request($starexBuy_url,'api') == 200){
            $starexBuyCoinNum = $this->curl->getArrayData();
        }
        $coinNum = $starexBuyCoinNum['coin'];
        $this -> assign('coinNum',$coinNum);
        //星换购-广告位
        $starexBuyAd_url = "/ads/lively/app.ex_buy.banner.001";
        $starexBuyAd = array();
        if($this->curl->get_request($starexBuyAd_url,'api') == 200){
            $starexBuyAd = $this->curl->getArrayData();
            foreach ($starexBuyAd['app.ex_buy.banner.001'] as $key => &$value)
                 $value['picture'] = Common::get_image_url($this -> config, $value['picture'], '', '', 'img');
        }
        $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";
        $starexBuyAd_banner = $starexBuyAd['app.exchange.banner.001'][0]['picture'];
        $starexBuyAd_link_before = $starexBuyAd['app.exchange.banner.001'][0]['mobile_link'];
        if (preg_match($urlReg,$starexBuyAd_link_before)) {
            $starexBuyAd_link = $starexBuyAd_link_before;
        }else{
            $starexBuyAd_link = '#';
        }
        $starexBuyAd_banner = $starexBuyAd['app.ex_buy.banner.001'][0]['picture'] ;
        $starexBuyAd_link = $starexBuyAd['app.ex_buy.banner.001'][0]['mobile_link'] ;
        $this -> assign('starexBuyAd_banner',$starexBuyAd_banner);
        $this -> assign('starexBuyAd_link',$starexBuyAd_link);
        $this->pages->init('星换购');
        //星换购-（衣食住行）
        $starexBuyBtn_url = "/category/code";
        $starexBuyBtn = array();
        if($this->curl->get_request($starexBuyBtn_url,'api') == 200){
            $starexBuyBtn = $this->curl->getArrayData();
        }
        $this -> assign('starexBuyBtn',$starexBuyBtn);
        //星换购-内容
        //$starexBuyM_url = "/v2/goods/search2";
        $starexBuyM_url = "/v2/goods/search";
        $starexBuyM     = array();
        $this->curl->disable_token();
        //if($this->curl->post_request($starexBuyM_url,$data,'v2_api') == 200){
        if($this->curl->post_request($starexBuyM_url,$data,'java_api') == 200){
            $starexBuyM = $this->curl->getArrayData();
            foreach ($starexBuyM['items'] as $key => &$value)
                foreach ($value['items'] as $k => &$v)
                    $v['logo'] = Common::get_image_url($this -> config, $v['logo']);
                    // foreach ($v['images'] as $_k => &$_v)
                        // $_v = Common::get_image_url($this -> config, $_v);
        } else {
            var_dump($this->curl->getResponseText());
            var_dump(123);exit;
        }
        $starexBuyM_data = $starexBuyM['items'];
        $this -> assign('starexBuyM_data',$starexBuyM_data);
	}

    //星换购ajax
    public function starexBuyAjaxAction()
    {

        if(empty($_POST)){
            $this->failure("失败");
        }else{
            $data = $_POST;
        }
        //星兑换-内容
        //$starchangeM_url = "/v2/goods/search2";
        $starexBuyM_url = "/v2/goods/search";
        $starchangeM     = array();
        $this->curl->disable_token();
        //print_r($data);
        //if($this->curl->post_request($starchangeM_url,$data,'v2_api') == 200){
        if($this->curl->post_request($starexBuyM_url,$data,'java_api') == 200){
            $res = $this->curl->getArrayData();
            $starchangeM = $this->curl->getArrayData();
            // echo "<pre>";print_r($res);echo 11;echo "<br/>";print_r($starchangeM);die;
            if(!empty($starchangeM['items'])){
                foreach ($starchangeM['items'] as $key => &$value)
                    foreach ($value['items'] as $k => &$v)
                        $v['logo'] = Common::get_image_url($this -> config, $v['logo']);
                        foreach ($v['images'] as $_k => &$_v)
                            $_v = Common::get_image_url($this -> config, $_v);
            }
        }
        //echo "<pre>";print_r($starchangeM);die;
        $starchangeM_data = $starchangeM['items'];

        $this->success("成功",$starchangeM_data);
    }
    //星币说明
    public function coinruleAction()
    {

       $this->pages->init('星币说明');
    }
    //2.2新增
   //领星币
   public function newcollarAction()
    {
        //个人信息（零星币首页）
        $futurestar_url = "/member/futurestar";
        $coinExplain = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $coinExplain = $this->curl->getArrayData();
            $coinExplain['avatar'] = Common::get_image_url($this -> config, $coinExplain['avatar'],'','','avatar');
        }
        $this -> assign('coinExplain',$coinExplain);
        //登入跳转
        $url = $this->config->url;
        $this->assign('url_login',$url['url_m']);
        $url = $url['url_m'] . "/huilife/newcollar.html";
        $rerurn_url = base64_encode($url);
        $this -> assign('rerurn_url',$rerurn_url);      
        //星币任务
        $starurrency_url = "/v2/member/starcurrency/index";
        $coinTask     = array();
        if($this->curl->get_request($starurrency_url,'api') == 200){
            $coinTask = $this->curl->getArrayData();
            // foreach ($coinTask['data'] as $key => &$val)
            //      $val['image'] = Common::get_image_url($this -> config, $val['image'],'','','others');
        }
        $this -> assign('coinTask',$coinTask);
//         echo "<pre>";
//         print_r($coinTask);exit;

        //领星币 首页：
        $ads_location = "/v2/ads/location/app.coin.collectibles";
        $adscoin      = array();
        $res      = array();
        $time = time();
        if($this->curl->get_request($ads_location,'api') == 200){
            $adscoin = $this->curl->getArrayData();
            foreach ($adscoin as $key => $value){
                if (!empty($value['items'][0])) {
                    $res[$value['location_no']]['picture'] = Common::get_image_url($this -> config, $value['items'][0]['picture'], '', '', 'advert');
                    $res[$value['location_no']]['mobile_link'] = $value['items'][0]['mobile_link'];
                    if ($value['items'][0]['start_date'] - $time > 60*60*24) {
                        $res[$value['location_no']]['use_time'] = date('m月d日',$value['items'][0]['start_date']).'开始';
                    }elseif ($value['items'][0]['start_date'] < $time && $time < $value['items'][0]['end_date']) {
                        $res[$value['location_no']]['use_time'] = '火热进行中';
                    }elseif ($value['items'][0]['end_date'] < $time) {
                        $res[$value['location_no']]['use_time'] = '期待下一期';
                    }elseif (0 < ($time - $value['items'][0]['start_date']) && ( $value['items'][0]['start_date']) - $time  < 60*60*24) {
                        $res[$value['location_no']]['use_time'] = date('Y-m-d H:i:s',$value['items'][0]['start_date']);
                    }else{
                        $res[$value['location_no']]['use_time'] = date('Y-m-d H:i:s',$value['items'][0]['start_date']);
                    }
                }else{
                    $res[$value['location_no']]['picture'] = '';
                    $res[$value['location_no']]['use_time'] = '';
                    $res[$value['location_no']]['mobile_link'] = '';
                }
            }

        }

        //星换购
        // $data = array(
        //     "skip"=>"0",
        //     "take"=>"10",
        //     "category"=>"",
        //     "just_coin"=>true,
        //     "coin_min"=>"",
        //     "coin_max"=>""
        // );
        // $goods_url = "/v2/coin/activity";
        // $goods = array();
        // if($this->curl->post_request($goods_url,$data,'api') == 200){
        //     $goods = $this->curl->getArrayData();
        // }else{
        //     $goods['data'] = '';
        // }
        $time = time();
        $sql = "SELECT sku.S_MarketPrice as marketprice,sku.S_Logo as logo,sku.Sku_ID as id,sku.S_Name as name,pg.G_ActPrice as price,pg.G_Coin as coin
                FROM SALE_Promo as po
                LEFT JOIN SALE_PromoGoods as pg
                ON pg.G_PromoID = po.Promotion_ID
                LEFT JOIN GM_Sku as sku
                ON pg.G_SkuID = sku.Sku_ID
                WHERE po.P_BeginTime < $time AND po.P_EndTime > $time AND po.P_Status = 1 AND pg.G_Coin >0 AND pg.G_ActPrice > 0";
        $goods = $this->db->fetchAll($sql);
        if (!empty($goods)) {
            foreach ($goods as $k => $v) {
                $goods[$k]['img_url'] = Common::get_image_url($this->config,$v['logo']);
            }
        }

        $this -> assign('coinExplain',$coinExplain);

        $this -> assign('adscoin',$res);
        $this -> assign('res',$res);
        $this -> assign('goods',$goods);

        //购物车商品数量v2/cart/{sessionID}/summary
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        $this->curl->get_request("/v2/cart/{$sessionId}/summary","v2_api");
        $car = $this->curl->getArrayData();
        $num = isset($car['total_qty']) ? $car['total_qty'] : 0;
        $this -> assign('num',$num);

        $this->pages->init('领星币');
    }
    //2.2星币说明
    public function newcoinruleAction()
    {

       $this->pages->init('星币说明');
    }
    //判断登入
    private function go_login($url=""){
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
}