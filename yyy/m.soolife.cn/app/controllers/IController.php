<?php
// +----------------------------------------------------------------------
// | test 
// +----------------------------------------------------------------------
// | Copyright (c) 2016Äê Èç´ËÉú»î. All rights reserved.
// +----------------------------------------------------------------------
// | File:      Controller.php
// |
// | Author:    cunyang_liu
// | Created:   2017-03-17
// +----------------------------------------------------------------------


header("Content-Type: text/html; charset=utf-8");



class IController extends BaseController
{
    // ÏÂÔØÒ³Ãæ
    public function downloadAction()
    {

        $msg_txt = trim($this->request->get('msg_txt'));
        $this -> assign('msg_txt',$msg_txt);
        $this->display('i/show/download');
    }


    //ÅÐ¶ÏÊÇ·ñµÇÂ¼
    private function go_login($url=""){
        //ÅÐ¶ÏÊÇ·ñµÇÂ¼
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

    public function member()
    {
        $member_url = '/member';
        $member = array();
        if($this->curl->get_request($member_url,'api') == 200){
            $member = $this->curl->getArrayData();
            $member['avatar'] = Common::get_image_url($this -> config,$member['avatar'], '80', '80', 'avatar');
        }
        return $member;
        
    }
    //×¢²áËÍÀñ
    public function seed(){
        $seed_url = '/v2/member/registersource';

        $seed = array();
        if($this->curl->get_request($seed_url,'api') == 200){
            $seed = $this->curl->getArrayData(); 
        } 
        return $seed;
    }
    
    // ÎÒµÄÉú»î
    public function indexAction()
    {

        $url = $this->config->url;
        $url_order = $url->url_order;
        $this->assign('url_member',$url['url_m2']);
        $url = $url['url_m2'] . "/i/index/index.html";
        $this->go_login($url);
        
        $msg = $this ->request ->get("msg");
        if($msg == 'success'){
               $seed = $this->seed();
        }

        $member = $this->member(); 

        $this ->assign('seed',$seed);
        $this ->assign('member',$member);
        $this ->assign('url_order',$url_order);
        $this->display('i/index/index');
    }


    // ÏûÏ¢
    // route: i/msg/msgindex.html
    public function msgindexAction()
    {
        $msgIndex_url = '/v2/msglists/lists';
        $msgIndex = array();
        if($this->curl->get_request($msgIndex_url,'new_api') == 200){
            $msgIndex = $this->curl->getArrayData();
            if($msgIndex['systemmsg']['0']['createtime']){
                $msgIndex['systemmsg']['0']['createtime'] = date("m-d",$msgIndex['systemmsg']['0']['createtime']);
            }
            if($msgIndex['salesmsg']){
                $msgIndex['salesmsg']['0']['createtime'] = date("m-d",$msgIndex['salesmsg']['0']['createtime'] );
            }
            if($msgIndex['ordermsg']){
                $msgIndex['ordermsg']['0']['createtime'] = date("m-d",$msgIndex['ordermsg']['0']['createtime'] );
            }
            if($msgIndex['assetmsg']){
                $msgIndex['assetmsg']['0']['createtime'] = date("m-d",$msgIndex['assetmsg']['0']['createtime'] );
            }
            if($msgIndex['aftermsg']){
                $msgIndex['aftermsg']['0']['createtime'] = date("m-d",$msgIndex['aftermsg']['0']['createtime'] );
            }
        }
        $systemmsg = $msgIndex['systemmsg'];
        $salesmsg = $msgIndex['salesmsg'];
        $ordermsg = $msgIndex['ordermsg'];
        $assetmsg = $msgIndex['assetmsg'];
        $aftermsg = $msgIndex['aftermsg'];

        $this ->assign('systemmsg',$systemmsg);
        $this ->assign('salesmsg',$salesmsg);
        $this ->assign('ordermsg',$ordermsg);
        $this ->assign('assetmsg',$assetmsg);
        $this ->assign('aftermsg',$aftermsg);
        $this->display('i/msg/msgindex');
    }



    // ÏµÍ³ÏûÏ¢
    // route:i/msg/msgsystem.html
    public function msgsystemAction()
    {
        $system_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => "0",     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "system" // ÏûÏ¢ÀàÐÍ
        ];
        $system = array();
        if($this->curl->post_request($system_url,$data,'new_api') == 200){
            $system = $this->curl->getArrayData();
        }
        if($system){
            foreach ($system['data'] as $key => &$value) {
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
            }
        }
        $this ->assign('system',$system);
        $this->display('i/msg/msgsystem');
    }


    // ÏµÍ³ÏûÏ¢***ÏÂÀ­Ë¢ÐÂ
    // route:i/msg/msgsystem.html
    public function msgsystemAjaxAction()
    {
        $skip = $this ->request ->getPost("skip");
        $skip = $skip + 10;

        $system_url = '/v2/msglists/singlelists';

        $data = [
            'skip' => $skip,
            'take' => 10,
            "type" => "system" // ÏûÏ¢ÀàÐÍ
        ];
       
        $system = array();
        if($this->curl->post_request($system_url,$data,'new_api') == 200){
            $system = $this->curl->getArrayData();
        }
        if($system){
            foreach ($system['data'] as $key => &$value) {
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
            }
        }

        if(empty($system['data'])){
            $this->failure('false',$system);
        }else{
            $this->success('success',$system);
        }
    }


    // »î¶¯ÏûÏ¢
    public function msgactiveAction()
    {
        $this->display('i/msg/msgactive');
    }



    // ¶©µ¥ÎïÁ÷
    public function msgorderAction()
    {
        $url = $this->config->url;

        $order_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => "0",     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "order" // ÏûÏ¢ÀàÐÍ
        ];
        $order = array();
        if($this->curl->post_request($order_url,$data,'new_api') == 200){
            $order = $this->curl->getArrayData();
        }

        if($order){
            foreach ($order['data'] as $key => &$value) {
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
                $value['content']['logo'] = Common::get_image_url($this -> config, $value['content']['logo'], '', '', 'images');
            }
        }
        $this ->assign('order',$order);

        $this->display('i/msg/msgorder');
    }



    // ¶©µ¥ÎïÁ÷**ÏÂÀ­Ë¢ÐÂ
    public function msgorderAjaxAction()
    {
        $url = $this->config->url;
        $skip = $this ->request ->getPost("skip");
        $skip = $skip + 10;


        $order_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => $skip,     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "order" // ÏûÏ¢ÀàÐÍ
        ];
        $order = array();
        if($this->curl->post_request($order_url,$data,'new_api') == 200){
            $order = $this->curl->getArrayData();
        }

        if($order){
            foreach ($order['data'] as $key => &$value) {
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
                $value['content']['logo'] = Common::get_image_url($this -> config, $value['content']['logo'], '', '', 'images');
            }
        }

        if(empty($order['data'])){
            $this->failure('false',$order);
        }else{
            $this->success('success',$order);
        }

    }


    // ×Ê²úÏûÏ¢
    public function msgassetAction()
    {

        $asset_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => "0",     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "asset" // ÏûÏ¢ÀàÐÍ
        ];
        $asset = array();
        if($this->curl->post_request($asset_url,$data,'new_api') == 200){
            $asset = $this->curl->getArrayData();
        }
        if($asset){
            foreach ($asset['data'] as $key => &$value) {
                $value['url'] = '#';
                
                $match = $value['content']['type'];

                (preg_match("/money/i",$match)) && $value['url'] = '/i/money/wallet.html';
                (preg_match("/coupon/i",$match)) && $value['url'] = '/i/coupon/coupon.html';
                (preg_match("/cash/i",$match)) && $value['url'] = '/me/cash.html';
                (preg_match("/coin/i",$match)) && $value['url'] = '/i/money/coin.html';

                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
            }
        }

        $this ->assign('asset',$asset);
        $this->display('i/msg/msgasset');
    }



    // ×Ê²úÏûÏ¢**ÏÂÀ­Ë¢ÐÂ
    public function msgassetAjaxAction()
    {

        $skip = $this ->request ->getPost("skip");
        $skip = $skip + 10;


        $asset_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => $skip,     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "asset" // ÏûÏ¢ÀàÐÍ
        ];
        $asset = array();
        if($this->curl->post_request($asset_url,$data,'new_api') == 200){
            $asset = $this->curl->getArrayData();
        }
        if($asset){
            foreach ($asset['data'] as $key => &$value) {
                $value['url'] = '#';
                $match = $value['content']['type'];
                // (preg_match("/Ç®°ü/i",$match)) && $value['url'] = 'i/money/wallet.html';
                // (preg_match("/ÓÅ»ÝÈ¯/i",$match)) && $value['url'] = 'i/coupon/coupon.html';
                // (preg_match("/ÏÖ½ð/i",$match)) && $value['url'] = 'i/money/cash.html';
                // (preg_match("/ÐÇ±Ò/i",$match)) && $value['url'] = 'i/money/coin.html';

                (preg_match("/money/i",$match)) && $value['url'] = '/i/money/wallet.html';
                (preg_match("/coupon/i",$match)) && $value['url'] = '/i/coupon/coupon.html';
                (preg_match("/cash/i",$match)) && $value['url'] = '/i/money/cash.html';
                (preg_match("/coin/i",$match)) && $value['url'] = '/i/money/coin.html';
                
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
            }
        }
        

        if(empty($asset['data'])){
            $this->failure('false',$asset);
        }else{
            $this->success('success',$asset);
        }
    }


    // ÊÛºóÏûÏ¢
    public function msgserviceAction()
    {

        $service_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => "0",     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "after" // ÏûÏ¢ÀàÐÍ
        ];
        $service = array();
        if($this->curl->post_request($service_url,$data,'new_api') == 200){
            $service = $this->curl->getArrayData();
        }

        if($service){
            foreach ($service['data'] as $key => &$value) {
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
                $value['content']['logo'] = Common::get_image_url($this -> config, $value['content']['logo'], '', '', 'images');

            }
        }

        $this ->assign('service',$service);
        $this->display('i/msg/msgservice');
    }



    // ÊÛºóÏûÏ¢ÏÂÀ­Ë¢ÐÂ
    public function msgserviceAjaxAction()
    {
        $skip = $this ->request ->getPost("skip");
        $skip = $skip + 10;


        $service_url = '/v2/msglists/singlelists';
        $data = [
           "skip" => $skip,     // Ìø¹ýÌõÊý
           "take" => "10",    // ·ÖÒ³ÌõÊý
           "type" => "after" // ÏûÏ¢ÀàÐÍ
        ];
        $service = array();
        if($this->curl->post_request($service_url,$data,'new_api') == 200){
            $service = $this->curl->getArrayData();
        }

        if($service){
            foreach ($service['data'] as $key => &$value) {
                $value['createtime'] = date("Y-m-d H:i:s",$value['createtime']);
                $value['content']['logo'] = Common::get_image_url($this -> config, $value['content']['logo'], '', '', 'images');

            }
        }
        if(empty($service['data'])){
            $this->failure('false',$service);
        }else{
            $this->success('success',$service);
        }
      
    }

/**************************************×Ê²ú*****************************************************/
    // ÐÇ±Ò
    // route: i/money/coin.html
    public function coinAction()
    {
        $member = $this->member(); 


        $coin_url = '/member/record/3';
        $coin = array();
        if($this->curl->get_request($coin_url,'api') == 200){
            $coin = $this->curl->getArrayData();
        }

        $this -> assign("coin",$coin);
        $this -> assign("member",$member);
        $this->display('i/money/coin');
    }



    // Ç®°ü
    // route: i/money/wallet.html
    public function walletAction()
    {
        $member = $this->member(); 
        
        $money_url = '/member/record/1';
        $money = array();
        if($this->curl->get_request($money_url,'api') == 200){
            $money = $this->curl->getArrayData();
        }
        
        $this -> assign("money",$money);
        $this -> assign("member",$member);
        $this -> assign("nickname",$nickname);
        $this->display('i/money/wallet');
    }



    // ÐéÄâÉÌÆ·
    // route:i/money/rechargelist.html
    public function rechargelistAction()
    {
        $nickname  = $this ->request ->get("nickname");

        // ÐéÄâÉÌÆ·ÁÐ±í
        $recharglist_url = '/v2/goods/virtual/lists';
        $recharglist = array();
        if($this->curl->post_request($recharglist_url,'api') == 200){
            $recharglist = $this->curl->getArrayData();
        }
        //广告位
        $ad_url = '/ads/location/app.recharge';
        $adlist = array();
        $img_url = '';
        if($this->curl->post_request($ad_url,'api') == 200){
            $adlist = $this->curl->getArrayData();
            if($adlist){
                foreach ($adlist['app.recharge.index']['children']['app.recharge.index.banner']['items'] as $value) {
                    $img_url = Common::get_new_image_url($this -> config, $value['picture']);
                }
            }
        }
        $this -> assign("img_url",$img_url);
        $this -> assign("nickname",$nickname);
        $this -> assign("recharglist",$recharglist);
        $this->display('i/money/rechargelist');
    }



    // Ç®°ü³äÖµ
    // route:i/money/walletrecharge.html
    public function walletrechargeAction()
    {

        $vgood_id = $this ->request ->getPost("vgood_id");

        $recharge_url = '/v2/member/asset/wallet/recharge';
        $data = [
            'vgood_id' => $vgood_id,
        ];
        $recharge = array();

        if($this->curl->post_request($recharge_url,$data,'api') == 200){
            $recharge = $this->curl->getArrayData();
            $recharge['create_time'] = date("Y-m-d H:i:s",$recharge['create_time']);
        }else if($this->curl->post_request($recharge_url,$data,'api') == 400){
            $recharge =  $this->curl-> getArrayData();
        }

        if(empty($recharge)){
            $this->failure('false');
        }else{
            $this->success('success',$recharge);
        }

    }



    public function walletpayAction()
    {
        $pay_fee = $this ->request ->get("pay_fee");
        $create_time = $this ->request ->get("create_time");
        $orderNo = $this ->request ->get("orderNo");


        $ordersid = $this -> request -> get("orderid");
        $pay = $this -> request-> get("pay");
        //ÅÐ¶ÏÊÇ·ñÎªÎ¢ÐÅä¯ÀÀÆ÷
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') == true) {
            $code = $this->  request -> getQuery('code');     //ÅÐ¶ÏÊÇ·ñÊÚÈ¨»Øµ÷
            $oauthService = new ThirdLoginService();
            if($code==null){
                $data = $oauthService -> wechat($ordersid,$pay);   
            }else{
                $auth = $oauthService -> get_user_auth();
                //ÓÃ»§Î¢ÐÅÊÚÈ¨openid
                $openid = $auth['openid'];
            }
        }

        $this->assign('openid',$openid);
        $this -> assign("orderNo",$orderNo);
        $this -> assign("pay_fee",$pay_fee);
        $this -> assign("create_time",$create_time);
        $this->display('i/money/walletpay');
    }




    // Ö§¸¶ÖÐÐÄ
    // Ö§¸¶-Ö§¸¶·½Ê½
    public function paywayAction(){
        $ordersid = $this -> request -> get("orderid");
        $sid = $this -> request-> get("sid");
        $pay = $this -> request-> get("pay");
        //ÅÐ¶ÏÊÇ·ñÎªÎ¢ÐÅä¯ÀÀÆ÷
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') == true) {
            $code = $this->  request -> getQuery('code');     //ÅÐ¶ÏÊÇ·ñÊÚÈ¨»Øµ÷
            $oauthService = new ThirdLoginService();
            if($code==null){
                $data = $oauthService -> wechat($ordersid,$sid,$pay);   
            }else{
                $auth = $oauthService -> get_user_auth();
                //ÓÃ»§Î¢ÐÅÊÚÈ¨openid
                $openid = $auth['openid'];
            }
        }
        $this->assign('openid',$openid);
        $this->page->init('Ö§¸¶·½Ê½');
    }
    /**
     * Ö§¸¶±¦Ö§¸¶
     * @author miaolei 2017-04-26
     */
    public function alipayAction(){
        $orderid = $this -> request-> getPost("orderid");
        $data = $this -> config ->url;
        $url = $data['url_m2'];
        // echo "<pre>";print_r($orderid);die;
        $pay = new PayService;
        $result = $pay -> alipayweb($orderid,$url);
        return $this -> success($result);
    }
    /**
     * Î¢ÐÅÖ§¸¶
     * @author miaolei 2017-04-26
     */
     public function weixinpayAction() {
        $orderid = $this -> request-> getPost("orderid");
        $data = $this -> config ->url;
        $url = $data['url_m2'];
        // echo "<pre>";print_r($orderid);die;
        $openid = $this -> request -> getPost("openid");
        $ip = Common::get_client_address();
        //ÓÃ»§ip
        $pay = new PayService;
        $result = $pay -> wexinpayweb($orderid,$openid,$ip,$url);

        $jsApiObj['appId'] = $result -> appId;
        $jsApiObj['timeStamp'] = $result -> timeStamp;
        $jsApiObj['nonceStr'] = $result -> nonceStr;
        $jsApiObj['package'] = $result->package;
        $jsApiObj['signType'] = $result->signType;
        $jsApiObj["paySign"] = $result -> paySign;
        return $this -> success($jsApiObj);
    }
    /**
     * Ö§¸¶³É¹¦
     * @author 
     */
    //²ÂÄãÏ²»¶ i/money/paysuccess
    public function paysuccessAction(){
        //$guesslike_url="/goods/rank/guesslike";
        $guesslike_url="/v3/goods/guesslike";
        $guesslike = array();
        $data = [
            "index" => 1,
            "size"  =>10
        ];
        $token = $this->user->getToken();
        $history_id = $this -> cookies -> get('history_id');
        $data['session_id'] = md5($history_id);
        // if($this->curl->post_request($guesslike_url,$data,'api') == 200){
        $this->curl->set_token($token);
        if($this->curl->post_request($guesslike_url,$data,'java_api') == 200){
            $guesslike = $this->curl->getArrayData(); 

            if(!empty($guesslike['guess_list'])){
                foreach ($guesslike['guess_list'] as $key => &$value) {
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
                    $value['url'] =  $this->config->url->url_goods;
                } 
            }
        } 
        $this->assign('guesslike',$guesslike['guess_list']);
        $this->display('i/money/paysuccess');
    }




    // ÏÖ½ð
    // route: i/money/cash.html
    public function cashAction()
    {
        $member = $this->member(); 

        $cash_url = '/member/record/2';
        $cash = array();
        if($this->curl->get_request($cash_url,'api') == 200){
            $cash = $this->curl->getArrayData();
        }

        $this -> assign("cash",$cash);
        $this -> assign("member",$member);
        $this->display('i/money/cash');
    }



    // ÏÖ½ð³äÖµÇ®°ü
    // route: i/money/cashrecharge.html

    public function cashrechargeAction()
    {
        $member = $this->member(); 
        if (empty($_GET['type'])) {
            $type = 2;
        }else{
            $type = 1;
        }
        $cashTotal = $member['cash'] - $member['frozen_cash'];
        $cashTotal = sprintf("%.2f",$cashTotal);
        $this -> assign("cashTotal",$cashTotal);
        $this -> assign("type",$type);
        $this->display('i/money/cashrecharge');
    }

    // ÏÖ½ð³äÖµ½Ó¿Ú
    // route: 
    public function cashrechargeAjaxAction()
    {

        $tramount = $this ->request ->getPost("tramount");
        $paypsd  = (string)$this ->request ->getPost("paypsd");

        $paypsd = base64_encode($paypsd).rand(10,99);
        $cashrecharge_url = '/member/assets/cash/transfer';
        $cashrecharge = array();
        $data = [
            'tramount' =>$tramount,
            'paypsd'   =>$paypsd
        ];

        $this->curl->post_request($cashrecharge_url,$data,'api');
        $cashrecharge = $this->curl->getArrayData();

        $this->success('',$cashrecharge);
    }



    // ÓÅ»ÝÈ¯
    // route: i/coupon/coupon.html
    public function couponAction()
    {
          $coupon_url = '/member/coupon/0/10/0';
          $coupon = array();
          if($this->curl->post_request($coupon_url,'api') == 200){
              $coupon = $this->curl->getArrayData();
              if(!empty($coupon)){
                  foreach ($coupon['data'] as $key => &$value) {
                      $value['begin_date'] = date('m.d',$value['begin_date']);
                      $value['end_date'] = date('m.d',$value['end_date']);
                  }
              }
          }
        $this -> assign("coupon",$coupon);
        $this->display('i/coupon/coupon');

    }
    // ÓÅ»ÝÈ¯
    // route: i/coupon/coupon.html
    public function couponAjaxAction()
    {
        $skip = $this->request->getPost("skip");

        $take = $this->request->getPost("take");
        $status = $this->request->getPost("status");
        if(!isset($skip) || $skip < 0){
            $skip = 0;
        }
        if(!isset($take) || $take <= 0){
            $take = 10;
        }
        if(!isset($status) || !in_array($status, array(0,1,2))){
            $status = 0;
        }
        $coupon_url = '/member/coupon/'.$skip.'/'.$take.'/'.$status;
        $coupon = array();
        if($this->curl->post_request($coupon_url,'','api') == 200){
            $coupon = $this->curl->getArrayData();
            foreach ($coupon['data'] as $key => &$value) {
                $value['begin_date'] = date('m.d',$value['begin_date']);
                $value['end_date'] = date('m.d',$value['end_date']);
            }
        }
        if(empty($coupon)){
            $this->failure('false');
        }else{
            $this->success('success',$coupon);
        }

    }

    // ¼¤»îÓÅ»ÝÈ¯
    // route: i/coupon/active.html
    public function activeAction()
    {

        $this->display('i/coupon/active');
    }
    // ¼¤»îÓÅ»ÝÈ¯
    // route: 
    public function activeAjaxAction()
    {
        $serial_no = $this ->request ->getPost("serial_no");
        $password  = $this ->request ->getPost("password");

        $active_url = '/member/activatecoupon';
        $active = array();
        $data = [
            'serial_no' => $serial_no,
            'password'   => $password
        ];

        $this->curl->post_request($active_url,$data,'api');
        $active = $this->curl->getArrayData();

        $this->success('',$active);
    }
    


    // ÎÒµÄÐÇ·ÛÐã
    // route: i/show/show.html
    public function showAction()
    {
        $show_url='/starpink/my/0/10';
        $show = array();
        $data = [];
        if($this->curl->post_request($show_url,$data,'api') == 200){
            $show = $this->curl->getArrayData();
            if($show['data']){
                foreach ($show['data'] as $key => &$value) {
                    $value['photo'] = Common::get_image_url($this -> config, $value['photo'], '', '', 'fans');
                    $value['create_time'] = date("Y-m-d",$value['create_time'] );
                }
            }
        }
        $this -> assign('show',$show);
        $this->display('i/show/show');
    }

    // ¼ÓÔØ¸ü¶àÐÇ·ÛÐã
    // route: i/show/show.html
    public function showMoreAction()
    {
        $skip = $this ->request ->getPost("skip");
        $data = array();       
        $show = array();
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
        $show_url="/starpink/my/{$data['skip']}/{$data['take']}";

        if($this->curl->post_request($show_url,$data,'api') == 200){
            $show = $this->curl->getArrayData();
            if($show['data']){
                foreach ($show['data'] as $key => &$value) {
                    $value['photo'] = Common::get_image_url($this -> config, $value['photo'], '', '', 'fans');
                    $value['create_time'] = date("Y-m-d",$value['create_time'] );
                }
            }
        }

        $this->success('success',$show);
        $this->display('i/show/show');
    }

    
    // ÎÒµÄÑûÇë
    // route: i/record/invite.html
    public function inviteAction()
    {
        $invite_url='/member/inviterecode';
        $invite = array();
        $data = [
            'skip' => 0,
            'take' => 10
        ];
        if($this->curl->post_request($invite_url,$data,'api') == 200){
            $invite = $this->curl->getArrayData();
            if($invite['data']){
                foreach ($invite['data'] as $key => &$value) {
                    $value['accepter_avatar'] = Common::get_image_url($this -> config, $value['accepter_avatar'], '80', '80', 'avatar');
                }
            }
        }

        $this -> assign('invite',$invite);
        $this->display('i/record/invite');
    }
    // ÎÒµÄÑûÇë
    // route: i/record/invite.html
    public function inviteAjaxAction()
    {

        $skip = $this ->request ->getPost("skip");
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
        $invite_url='/member/inviterecode';
        $invite = array();
        if($this->curl->post_request($invite_url,$data,'api') == 200){
            $invite = $this->curl->getArrayData();
            if($invite['data']){
                foreach ($invite['data'] as $key => &$value) {
                    $value['accepter_avatar'] = Common::get_image_url($this -> config, $value['accepter_avatar'], '80', '80', 'avatar');
                }
            }
        }

        $this->success('success',$invite);
        $this->display('i/record/invite');
    }


    // ¹Ø×¢
    // route: i/record/attention.html
    public function attentionAction()
    {
        $url = $this->config->url;
        $data = [
            'skip' => 0,
            'take' => 10
        ];
        // ÉÌÆ·¹Ø×¢
        $goods_url='/member/focused/goods';
        $goods = array();
        if($this->curl->post_request($goods_url,$data,'api') == 200){
            $goods = $this->curl->getArrayData();
            if($goods['items']){
                foreach ($goods['items'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                    $value['url'] = $this->config->url->url_goods;
                }
            }
        }
        // µêÆÌ¹Ø×¢
        $shop_url='/member/focused/shop';
        $shop = array();
        if($this->curl->post_request($shop_url,$data,'api') == 200){
            $shop = $this->curl->getArrayData();
            if($shop['items']){
                foreach ($shop['items'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                    $value['url'] = $this->config->url->url_shop;
                }
            }
        }

        $this -> assign('shop',$shop);
        $this -> assign('goods',$goods);
        $this->display('i/record/attention');
    }



    // ÏÂÀ­Ë¢ÐÂÉÌÆ·
    public function attentionGoodsAction()
    {
        $skip = $this ->request ->getPost("skip");
        $url = $this->config->url;

        $goods_url='/member/focused/goods';
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
        $goods = array();
        if($this->curl->post_request($goods_url,$data,'api') == 200){
            $goods = $this->curl->getArrayData();
            if($goods['items']){
                foreach ($goods['items'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                    $value['url'] = $this->config->url->url_goods;
                }
            }
        }

        $this->success('success',$goods);
    }



    // ÏÂÀ­Ë¢ÐÂµêÆÌ
    public function attentionShopsAction()
    {

        $skip = $this ->request ->getPost("skip");
        $url = $this->config->url;
        // µêÆÌ¹Ø×¢
        $shop_url='/member/focused/shop';
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
        $shop = array();
        if($this->curl->post_request($shop_url,$data,'api') == 200){
            $shop = $this->curl->getArrayData();
            if($shop['items']){
                foreach ($shop['items'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                    $value['url'] = $this->config->url->url_shop;
                }
            }
        }

        $this->success('success',$shop);
    }



    // É¾³ý¹Ø×¢ÉÌÆ·
    // route: i/record/delgoods.html
    public function delgoodsAction()
    {
        $goodId = implode(",", $_POST['goodId']);

        $delgoods_url="/member/focused/goods/delete/".$goodId;
        $delgoods = array();
        if($this->curl->delete_request($delgoods_url,'api') == 200){
            $delgoods = $this->curl->getArrayData();
        }   
        if(!empty($delgoods)){
            return $this->json($delgoods);
        } else {
            $this->failure('ÍøÂç³ö´í',400,'',100);
        }
    }


    // É¾³ý¹Ø×¢µêÆÌ
    // route: i/record/delshop.html
    public function delshopAction()
    {
        $shopId = implode(",", $_POST['shopId']);
        $delshop_url="/member/focused/shops/delete/".$shopId;
        $delshop = array();
        if($this->curl->delete_request($delshop_url,'api') == 200){
            $delshop = $this->curl->getArrayData();
        }
        if(!empty($delshop)){
            return $this->json($delshop);
        } else {
            $this->failure('ÍøÂç³ö´í',400,'',100);
        }
    }


    // ×ã¼£
    // route: i/record/footprint.html
    public function footprintAction()
    {
        $history_url='/member/visit/history';
        $history = array();

        if($this->curl->post_request($history_url,'','api') == 200){
            $history = $this->curl->getArrayData();
            if($history['items']){
                foreach ($history['items'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                    $value['url'] = $this->config->url->url_goods;
                }
            }
        }


        $this -> assign('history',$history);
        $this->display('i/record/footprint');
    }



    // ÏÂÀ­Ë¢ÐÂ
    // route:i/record/footprint.html
    public function footprintAjaxAction()
    {

        $skip = $this->request->getPost('skip');
        
        $history_url='/member/visit/history';
        $history = array();
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
        if($this->curl->post_request($history_url,$data,'api') == 200){
            $history = $this->curl->getArrayData();
            if($history['items']){
                foreach ($history['items'] as $key => &$value) {
                    $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                    $value['url'] = $this->config->url->url_goods;
                }
            }
        }
        $this->success('success',$history);
    }


    // É¾³ý×ã¼£
    public function delFootPrintAction()
    {
        $id = implode(",", $_POST['skuid']);
        $delhistory_url='/member/visit/delhistory';
        $delhistory = array();
        $data=[
            "id" => $id
        ];
        if($this->curl->post_request($delhistory_url,$data,'api') == 200){
            $delhistory = $this->curl->getArrayData();
        }
        if(!empty($delhistory)){
            return $this->json($delhistory);
        } else {
            $this->failure('ÍøÂç³ö´í',400,'',100);
        }
    }

}