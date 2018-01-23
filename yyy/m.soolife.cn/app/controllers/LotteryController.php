<?php
// +----------------------------------------------------------------------
// | 分类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:    CategroyController.php
// |
// | Author: kailong_hu
// | Created:   2017-04-07
// +----------------------------------------------------------------------
class LotteryController extends BaseController
{
    private $db_identifier = 'session';


    //广告位
    public function ads(){
        $link_url = "/ads/location/app.fullaward.banner";
        $link = array();
        $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";

        if($this->curl->get_request($link_url,'api') == 200){
            $link = $this->curl->getArrayData();
            // if(count($link['app.fullaward.banner.001']['items']) > 6){
            //     $link['app.fullaward.banner.001']['items'] = array_slice($link['app.fullaward.banner.001']['items'],0,6);
            // }
            foreach ($link as $key => &$value) {
                foreach ($value['items'] as $_k => &$_v){
                    $_v['picture'] = Common::get_image_url($this -> config, $_v['picture'], '', '', 'img');
                    if (preg_match($urlReg,$_v['mobile_link'])) {
                        $_v['mobile_link'] = $_v['mobile_link'];
                    }else{
                        $_v['mobile_link'] = '#';
                    }
                }
            }
        }
        $this -> assign('link',$link);
    }

    public function indexAction($main_order)
    {
        //抽奖列表(抽奖时奖品的列表)
        $url = "/v2/fulldraw/lotterylist/{$main_order}";
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            if(!empty($data['award'])){
                foreach($data['award'] as $k=>&$v){
                    $v['S_Logo'] = Common::get_image_url($this -> config, $v['S_Logo'],'','','images');
                }
            }else{
                $data['award'] = array();
            }
        }else{
            $this->display("page/page");
        }
        $url_member = $this->config->url;
        $this -> assign('data',$data);
        $this -> assign('url_m',$url_member['url_m']);
        $this->pages->init('满额抽奖');
    }
    // 404页面
    public function pageAction()
    {
        $this->pages->init('满额抽奖');
    }
    public function expectAction()
    {
        $this->ads();
        $this->pages->init('满额抽奖');
    }
    public function regulationAction()
    {
        $this->pages->init('满额抽奖');
    }
    public function homepageAction()
    {
        $this->ads();
        //满额抽奖活动页
        $url = "/v2/fulldraw/activity";
        //print_r($this->curl->get_request($url,'api'));die;
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            foreach($data['award'] as $k=>&$v){
                $v['S_Logo'] = Common::get_image_url($this -> config, $v['S_Logo'],'','','images');
            }
            foreach($data['cate'] as $kk=>&$vv){
                $vv['FC_Logo'] = Common::get_image_url($this -> config, $vv['FC_Logo'],'','','others');
            }
        }else{
            $this->display("page/page");
        }
        // echo"<pre>";print_r($data);die;
        if($data['code']==102){
            $this->display('lottery/expect');
        }else{
            $this -> assign('data',$data);
            $this->pages->init('满额抽奖');
        }
    }
    public function interfaceAction()
    {
        $fullid = isset($_GET['fullid']) ? $_GET['fullid']:'';
        $fcid = isset($_GET['fcid']) ? $_GET['fcid']:'';
        //满额抽奖活动商品列表页
        $url = "/v2/fulldraw/fullgoods/$fullid/$fcid";
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            if(isset($data['goods'])){
                foreach($data['goods'] as $k=>&$v){
                    $v['S_Logo'] = Common::get_image_url($this -> config, $v['S_Logo'],'','','images');
                }
            }else{
                $data['goods'] = array();
            }
            $data['fc_album'] = Common::get_image_url($this -> config, $data['fc_album'],'','','others');
        }
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        //$urlc = "/v2/cart/$sessionId";
            //$this->logger->info($this->curl->get_request($urlc,'v2_api'));

        //if($this->curl->get_request($urlc,'v2_api') == 200){
            $urlb = "/v2/fulldraw/fullcart/$sessionId";
            if($this->curl->get_request($urlb,'api') == 200){
                $data_price = $this->curl->getArrayData();
            }else{
                $this->logger->info('调用/v2/fulldraw/fullcart/$sessionId出错');
                $this->display("page/page");
            }
        //}else{
        //    $this->logger->info("调用/v2/cart/".$sessionId."出错");
         //   $this->display("page/page");
        //}
        $data_price['price'] = intval($data_price['price']);
        $this -> assign('data',$data);
        $this -> assign('data_price',$data_price);
        $this->pages->init('满额抽奖');
    }
    public function winAction()
    {
        $main_order = $_GET['m'];
        $urla = "/v2/fulldraw/drawamount/$main_order";

        if($this->curl->get_request($urla,'api') == 200){
            $data = $this->curl->getArrayData();
            if($data['code']==100){//达到额度
                $data = 1;
            }else{
                $data = 0;
            }
            //推荐商品、
            // echo "<pre>";print_r($data);die;
            $result['size'] = 6;
            //$guesslike_url="/goods/rank/guesslike";
            $guesslike_url="/v3/goods/guesslike";
            $guesslike = array();
            $token = $this->user->getToken();
            $history_id = $this -> cookies -> get('history_id');
            $result['session_id'] = md5($history_id);
            //var_dump($result);die;
            //if($this->curl->post_request($guesslike_url,$result,'api') == 200){
            $this->curl->set_token($token);
            if($this->curl->post_request($guesslike_url,$result,'java_api') == 200){
                $guesslike = $this->curl->getArrayData();
                foreach ($guesslike['guess_list'] as $key => &$value) {
                    $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
                }
            }
        }else{
            $this->display("page/page");
        }
        //echo "<pre>";print_r($guesslike);die;
        $this->assign('data',$data);
        $this->assign('guesslike',$guesslike['guess_list']);
        $this->pages->init('满额抽奖');
    }


    public function drawAction()
    {
        $url = $this->config->url;
        $main_order = $_POST['main_order'];
        $url = $url['url_m2'] . "/lottery/index/{$main_order}.html";
        $is_login = $this->go_login();
        $return_url = base64_encode($url);
        if(!$is_login){
            return $this->failure("失败",$return_url);
        }
        $url = "/v2/fulldraw/lottery/$main_order";
        $data = array();
        // var_dump($main_order);die;
        // print_r($this->curl->get_request($url,'api'));die;
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
            if($data['code']==100) {
                $data['award']['S_Logo'] = Common::get_image_url($this->config, $data['award']['S_Logo'], '', '', 'images');
                $this->sendMessage($data['award']['S_Name']);
            }
        }else{
            $this->display("page/page");
        }
        $this->success('',$data);
        $this->pages->init('满额抽奖');
    }

//添加购物车
    public function addCartAction()
    {
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        //echo $sessionId;
        $skuid = $_POST['skuid'];
        $fullid = $_POST['fullid'];
        //$fcid = $_POST['fcid'];
        $url = "/v2/fulldraw/fullcart/$sessionId";
        $urla = "/v2/cart/$sessionId/goods/$skuid";
        $this->curl->post_request($urla,array("qty"=>1),'v2_api');
        if($this->curl->get_request($url,'api') == 200){
            $data = $this->curl->getArrayData();
        }else{
            $this->display("page/page");
        }
        //print_r($data['price']);die;
        $this->success('',$data);
    }

    //抽奖成功后，请求短信接口
    public function sendMessage($name){
        $cookie = $_COOKIE;
        $data['name'] = $name;
        if(!empty($cookie['m_token'])){
            $this->logger->info(var_export($cookie,TRUE));
            $keys = "member:token:{$cookie['m_token']}";
            $this->logger->info($keys);
            $member = $this->redis->read($keys, $this->db_identifier,1);
            $this->logger->info(var_export($member,TRUE));
            $url = "/sms/fulldraw/win/{$member['member_id']}";
            $this->logger->info($url);
            $this->curl->post_request($url,$data,'api');
        }
    }


    //判断是否登录
    private function go_login(){
        //判断是否登录
        $futurestar_url = "/member/futurestar";
        $login_data = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $login_data = $this->curl->getArrayData();
        }
        $is_login = $login_data['is_login'];
        if($is_login){
            return true;
        }else{
            return false;
        }
    }

}