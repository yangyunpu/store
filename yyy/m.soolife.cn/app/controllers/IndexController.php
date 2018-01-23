<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: <zhichao_hu>
// | Created:   2016-07-27
// +----------------------------------------------------------------------
class IndexController extends BaseController
{
    public function indexAction()
    {
        //该方法去token请求接口
        $this->curl->disable_token();
        $this->curl->get_request('/ads/location/app.home','new_api');
        $mata= $this->curl->getArrayData();
        if(isset($mata))
        {
            foreach($mata as $ksy => &$value)
            {
                foreach($value['children'] as $ksy => &$v)
                {
                    foreach($v['items'] as $ksy => &$s)
                    {

                            $s['picture'] = Common::get_new_image_url($this -> config, $s['picture']);

                    }
                }
            }

        }
        $this -> assign('mata',$mata);

        $member_id = empty($member_id = $this -> user -> getId())? '' : $$member_id = $this -> user -> getId();
        //圈圈
        $nav = array(
            array("name"=>"商品分类","icon"=>"/public/img/minet/first－commodity@2x.png","url"=>"/category.html"),
            array("name"=>"星超市","icon"=>"/public/img/minet/first－market@2x.png","url"=>"/starmarket.html"),
            array("name"=>"惠赚钱","icon"=>"/public/img/minet/first－money@2x.png","url"=>$this->config->url->url_money."/index.html"),
            array("name"=>"全民商探","icon"=>"/public/img/minet/first－exploration@2x.png","url"=>"/business.html?member_id=$member_id"),
            array("name"=>"订单查询","icon"=>"/public/img/minet/5@2x.png","url"=>$this->config->url->url_member."/orders.html"),
            array("name"=>"海外精品","icon"=>"/public/img/minet/first－overseas@2x.png","url"=>"/seagood.html"),
            array("name"=>"星范儿","icon"=>"/public/img/minet/first－cloth@2x.png","url"=>"/starstyle.html"),
            array("name"=>"领星币","icon"=>"/public/img/minet/first－collar@2x.png","url"=>"/huilife/index.html"),
            array("name"=>"星粉联","icon"=>"/public/img/minet/first－star@2x.png","url"=>"/starfans/index.html"),
            array("name"=>"星集结","icon"=>"/public/img/minet/first－aggregation@2x.png","url"=>$this->config->url->url_sales."/m/lucky/index.html")
        );
        $this->assign('navs',$nav);

        //热搜
        $this->curl->get_request('/v1/goods/search/hottag/'.mt_rand(6,12),'old_api');
        $hot= $this->curl->getArrayData();
        if($hot['success'] == false)
            $hot = false;
        $this -> assign('hot',$hot);



        //购物车商品数量v2/cart/{sessionID}/summary
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        $res = $this->curl->get_request("/v2/cart/{$sessionId}/summary","v2_api");
        $car= $this->curl->getArrayData();

        $num = isset($car['total_qty']) ? $car['total_qty'] : 0;
        $this -> assign('num',$num);

        //token
        $token = empty($token = $this -> user -> getTOKEN())? 0 : $this -> user -> getTOKEN();
        $this -> assign('token',$token);

       //驱动
        $this->pages->init('首页');


    }
     //猜你喜欢downlading
    public function downladingAction()
    {
        #/goods/rank/guesslike  php 彩泥稀罕
        /*$index = $this ->request->getPost("index");
        $this->curl->post_request('/v1/goods/rank/guesslike',array("index"=>$index,"size"=>10),"old_api");
        $data = $this ->curl->getArrayData();
        if(isset($data)){
            foreach ($data['Data'] as $key => &$value) {
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
            }
            return $this -> success("成功!",$data,"");
        }
        return $this -> failure("失败!",$data,"");*/

        $like_data['index'] = $this ->request->getPost("index");
        $like_data['size']=10;
        if($this->user->getToken()){
            $like_data['session_id'] = $this->user->getToken();
        }else{
            $like_data['session_id'] = md5($this->history_id);
        }
        $url = '/v3/goods/guesslike';

        //"session_id":"dsad12313sdad", - "index":0, "size":64, "shop_id":"123" } (注：index结果集起始数, size返回结果集数量, shop_id店铺ID

        if($this->curl->post_request($url,$like_data,"java_api") == 200){
            $data = $this ->curl->getArrayData();
            if(isset($data)){
                foreach ($data as $key => &$value) {
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
                }
                //var_dump($data);die;
                return $this -> success("成功!",$data,"");
            }
        }

        return $this -> failure("失败!",$data,"");
    }


    //充值
    public function rechargeAction()
    {
        $this->curl->post_request('/v1/goods/virtual/lists',array("search"=>array("catagoryno"=>1982)));
        $data = $this ->curl->getArrayData();
        $token = empty($token = $this -> user -> getTOKEN())? 0 : $token = $this -> user -> getTOKEN();
        $nickname = empty($nickname = $this -> user -> getNICKNAME())? '小星星' : $this -> user -> getNICKNAME();
        $this -> assign('token',$token);
        $this -> assign('data',$data);
        $this -> assign('nickname',$nickname);

        $this ->pages -> init('充值');
    }
    //充值生成订单
    public function orderAction()
    {
        $vgood_id = $this ->request->getPost("virtualgoods_id");
        $org_no = 6010;
        $member_id = $this -> user -> getId();
        $vgood_qty = 1;
        $this->curl->post_request('/v1/member/asset/wallet/recharge',array("org_no"=>$org_no,"member_id"=>$member_id,"vgood_id"=>$vgood_id,"vgood_qty"=>$vgood_qty));
        $data = $this ->curl->getArrayData();

        if(isset($data)){
            return $this -> success("成功!",$data,"");
        }
        return $this -> failure("失败!",$data,"");
    }

    //星粉联
    public function starfansAction()
    {
        $member_id = empty($this -> user -> getId())? '' : $this -> user -> getId();
        if(empty($member_id)){
            $return_url = Common::base64url_encode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            $login_url = $this->config->application->default_login.'?return_url='.$return_url;
            header('location:'.$login_url);
        }

        $this -> assign('member_id',$member_id);
        $str = $this -> config -> url -> url_m . "/invite.html?member_id={$member_id}";

        $ims = $this-> config -> new_images -> toArray();
        $d = array_rand($ims);
        $url_images = $ims[$d];
        $img_url = $url_images.'/qrcode/'.Common::base64url_encode($str).'.jpg';
        $this -> assign('img_url',$img_url);
        $this -> assign('str',$str);

        $this->pages->init('星粉联');

    }

    //星粉联邀请记录
    public function recordAction()
    {
        $id = empty($member_id = $this -> user -> getId())? '' : $$member_id = $this -> user -> getId();
        $this -> curl ->post_request("/v1/member/invite/{$id}","old_api");
        $data = $this ->curl -> getArrayData();
        $this->assign('data',$data);
        $this->pages->init('星粉联邀请记录');
    }

     //全民星探
     public function businessAction()
    {
        $member_id =  $this -> request ->get('member_id');
        $token     = empty($token = $this -> user -> getTOKEN())? 0 : $this -> user -> getTOKEN();
        $this -> assign('token',$token);
        $id        = empty($id = $this -> user -> getId())? 0 :  $this -> user -> getId();
        $this -> assign('id',$id);
        $nickname  = empty($nickname = $this -> user -> getNickname())? 0 :  $this -> user -> getNickname();
        $this -> assign('nickname',$nickname);
        //是否显示我要签约
        $this->curl->get_request("/v1/member/{$id}","old_api");
        $mata = $this ->curl->getArrayData();
        $this -> assign('mata',$mata);
        //var_dump($mata);exit;
        $this->pages->init('全民星探');

    }
    //地址联动
    public function addressAction()
    {
        $id = $this ->request->getPost("id");
        $this->curl->get_request("/member/address/{$id}");
        $data = $this ->curl->getArrayData();
        return $this -> success("成功!",$data,"");

    }
    //supplierpply
    public function supplierpplyAction()
    {
        $this->curl->enable_token();
        //    {
        //        "creater": "申请人",
        //        "name": "公司名称",
        //        "supplier_industry": "供应商行业",
        //        "region_no": "供应商所在地",
        //        "address": "公司地址",
        //        "phone": "公司电话",
        //        "chargeman_name": "负责人姓名",
        //        "linkman_name": "联系人姓名",
        //        "linkman_phone": "联系人电话",
        //        "supplier_visit_type": 0, 供应商联系状态  1 已告知  2 已介绍如此生活  3 已介绍如此生活
        //        "supplier_from":  供应商信息来源说明
        //    }
        $creater             = $this -> user -> getId();
        $name                = $this ->request->getPost("b");
        $supplier_industry   = $this ->request->getPost("c");
        $region_no           = $this ->request->getPost("d");
        $address             = $this ->request->getPost("e");
        $phone               = $this ->request->getPost("f");
        $chargeman_name      = $this ->request->getPost("g");
        $linkman_name        = $this ->request->getPost("h");
        $linkman_phone       = $this ->request->getPost("i");
        $supplier_from       = $this ->request->getPost("h1_text");
        $supplier_visit_type = $this ->request->getPost("h2_text");
        if($supplier_visit_type == "已告知")
            $supplier_visit_type = 1;
        if($supplier_visit_type == "已介绍如此生活")
            $supplier_visit_type = 2;
        if($supplier_visit_type == "已介绍如此生活")
            $supplier_visit_type = 3;

        $mata = array("creater"=>$creater,"name"=>$name,"supplier_industry"=>$supplier_industry,"region_no"=>$region_no,"address"=>$address,"phone"=>$phone,"chargeman_name"=>$chargeman_name,"linkman_name"=>$linkman_name,"linkman_phone"=>$linkman_phone,"supplier_from"=>$supplier_from,"supplier_visit_type"=>$supplier_visit_type,"create_type"=>10);
        $data = $this->curl->post_request("/v1/settled/supplierpply",$mata,'old_api');
        $data = $this ->curl->getArrayData();
        //file_put_contents('1.php',var_export($data,TRUE));
        if($data){
        return $this -> success("成功!",$data,"");
        }else{
        return $this -> failure("失败!",$data,"");
        }

    }
   //全民商探协议显示
    public function isbusinessAction()
    {
         $this->curl->enable_token();
        $id   = $this ->request->getPost("id");
        $this->curl->get_request("/member/details","php_api");
        $mata = $this ->curl->getArrayData();
        if($mata){
        return $this -> success("成功!",$mata,"");
        }else{
        return $this -> failure("失败!",$mata,"");
        }

    }
    //全民商探协议是否阅读提交
    public function subbusinessAction()
    {
        $this->curl->enable_token();
        $id = $this ->request->getPost("id");
        $this->curl->get_request("/member/sign/{$id}","php_api");
        $mata = $this ->curl->getArrayData();
        if($mata){
        return $this -> success("成功!",$mata,"");
        }else{
        return $this -> failure("失败!",$mata,"");
        }

    }
    //海外精品
    public function seagoodAction()
    {
       //该方法去token请求接口
        $this->curl->disable_token();
        $this->curl->get_request('/ads/location/app.overseas','new_api');
        $data= $this->curl->getArrayData();
        if(isset($data))
        {
            foreach($data as $ksy => &$value)
            {
                foreach($value['children'] as $ksy => &$v)
                {
                    foreach($v['items'] as $ksy => &$s)
                    {

                            $s['picture'] = Common::get_new_image_url($this -> config, $s['picture']);

                    }
                }
            }

        }
        //print_r($data);exit;
        $this->assign("data",$data);

        //国家馆
        $this->curl->get_request("/v2/oversea/countries","v2_api");
        $mata = $this ->curl->getArrayData();
        foreach($mata['items']  as $ksy => &$value){

                $value['icon'] = str_replace("pc","m",$value['icon']);

        }
        $this->assign('mata',$mata);

        //限时快抢
        $this->curl->get_request("/v2/oversea/limitsale?take=20","v2_api");
        $shopping = $this ->curl->getArrayData();
        $this->assign('shopping',$shopping);

        $this->pages->init('海外精品');

    }
    //全球优品
    public function downloadAction(){
        $skip = $this ->request -> getPost('skip');
        $this->curl->post_request("/v2/goods/search",array("skip"=>$skip,"take"=>10),"v2_api");
        $boutique = $this ->curl->getArrayData();
        if(isset($boutique))
        {
            foreach($boutique['items']  as $ksy => &$value)
            {

                $value['logo'] = Common::get_image_url($this -> config, $value['logo']);

            }
             return $this -> success("成功!",$boutique,"");
        }else{
             return $this -> failure("失败!",$boutique,"");
        }

    }

    public function notfoundAction()
    {

        $this->pages->init('404 Not Found');

    }
}