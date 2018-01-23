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

//
class StarkillController extends BaseController
{
	// 引导页
	public function indexAction()
    {
    	
	}
    //判断是否登录
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

    //正在进行的数据
    private function starts()
    {
        $start_url = "/starkill/lists/1/0/10";
        $start = array();
        if($this->curl->get_request($start_url,'api') == 200){
            $start = $this->curl->getArrayData();
            if(!empty($start['data'])){
                foreach ($start['data']as $key => &$value) {
                    $value['details_pictures']= Common::get_image_url($this -> config, $value['details_pictures'], '', '', 'images');
                    // $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                }
            }
        }
        return $start;
    }
    //即将开始数据
    private function nostarts()
    {
        // 即将开始活动
        $nostart_url = "/starkill/lists/2/0/10";
        $nostart = array();
        if($this->curl->get_request($nostart_url,'api') == 200){
            $nostart = $this->curl->getArrayData();
            if(!empty($nostart['data'])){
                foreach ($nostart['data']as $key => &$value) {
                    $value['details_pictures']= Common::get_image_url($this -> config, $value['details_pictures'], '', '', 'images');
                    // $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
                }
            }
        }
        return $nostart;
    }
	// 正在进行
    public function startAction()
    {
        $url = $this->config->url;
        $this->assign('url_m',$url['url_m']);
        $url = $url['url_m'] . "/starkill/start.html";
        $this->go_login($url);
    	//广告位
		$link_url = "/ads/location/app.starkill";
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

    	// 正在进行活动
    	$start = $this->starts();

        // 即将开始活动
        $nostart = $this->nostarts();

        if(empty($nostart['data'])){
            $start['nopage'] = 1;
        }else{
            $start['nopage'] = 0;
        }

        if(empty($start['data'])){
            $nostart = $this->nostarts();
            $nostart['startpage']=1;
            $this -> assign('nostart',$nostart);
            $this -> display("starkill/nostart");
        }else{
        	$this -> assign('start',$start);
        }
	}
	// 即将开始
    public function nostartAction()
    {
        $url = $this->config->url; 
        $this->assign('url_m',$url['url_m']);
        $url = $url['url_m'] . "/starkill/nostart.html";
        $this->go_login($url);
        // 即将开始
    	// 活动
    	$nostart = $this->nostarts();

        //正在进行
        // 活动
       $start = $this->starts();
        if(empty($start['data'])){
            $nostart['startpage']=1;
        }else{
            $nostart['startpage']=0;
        }
    	$this -> assign('nostart',$nostart);

        
	}
	// 我的星星杀
    public function mystarAction()
    {

        $url = $this->config->url; 
        $this->assign('url_m',$url['url_m']);
        $url = $url['url_m'] . "/starkill/mystar.html";
        $this->go_login($url);

    	//token
        $token = empty($token = $this -> user -> getTOKEN())? 0 : $this -> user -> getTOKEN();
    	// 继续杀
    	$con_url = "/starkill/lists/3/0/10";
    	$con = array();
    	if($this->curl->get_request($con_url,'api') == 200){
    	    $con = $this->curl->getArrayData();
    	    foreach ($con['data'] as $key => &$value) {
                $value['details_pictures']= Common::get_image_url($this -> config, $value['details_pictures'], '', '', 'images');
                // $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
            }
    	}
        $start = $this->starts();
        if(empty($start['data'])){
            $con['startpage']=1;
        }else{
            $con['startpage']=0;
        }
        $nostart = $this->nostarts();

        if(empty($nostart['data'])){
            $con['nopage'] = 1;
        }else{
            $con['nopage'] = 0;
        }
        $this -> assign('con',$con);
        // 购买
        $buy_url = "/starkill/lists/4/0/10";
        $buy = array();
        if($this->curl->get_request($buy_url,'api') == 200){
            $buy = $this->curl->getArrayData();
            foreach ($buy['data'] as $key => &$value) {
                $value['details_pictures']= Common::get_image_url($this -> config, $value['details_pictures'], '', '', 'images');
                // $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
            }
        }
        $start = $this->starts();
        if(empty($start['data'])){
            $con['startpage']=1;
        }else{
            $con['startpage']=0;
        }
        $nostart = $this->nostarts();

        if(empty($nostart['data'])){
            $con['nopage'] = 1;
        }else{
            $con['nopage'] = 0;
        }
    	$this -> assign('buy',$buy);

	}
	// 正在进行的详情页面[状态]
    public function stateAction()
    {
        $starkill_id = trim($this->request->get('starkill_id'));
        if(!isset($_GET['starkill_id'])){
            return $this->dispatcher->forward( array(
                'controller'    => 'index',
                'action'        => 'notfound',
            ));
        }


        $url = $this->config->url; 
        $this->assign('url_member',$url['url_member']);
        $url = $url['url_m'] . "/starkill/state.html?starkill_id=" . $starkill_id;
        $this->go_login($url);

        $state_url = "/starkill/details/{$starkill_id}";
    	$state = array();
    	if($this->curl->get_request($state_url,'api') == 200){
    	    $state = $this->curl->getArrayData();
            // 处理logo图片
            $state['data']['logo']= Common::get_image_url($this -> config, $state['data']['logo'], '', '', 'images');
            $state['data']['details_pictures']= Common::get_image_url($this -> config, $state['data']['details_pictures'], '', '', 'images');
            // 处理详情列表
            $a = function($match){
                return  str_replace($match[2],Common::get_image_url($this->config,$match[2]),$match[0]);
            };
            if($state['data']['spu_pictures']){
                $state['data']['spu_pictures'] = preg_replace_callback('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$a,$state['data']['spu_pictures']);
            }
            // 跳转详情页面
            foreach ($state['data'] as &$value) {
                $state['data']['url'] = $this->config->url->url_goods;
            }
            if($state['data']['sku_album']){
                foreach ($state['data']['sku_album'] as $key => &$value) 
                    $value= Common::get_image_url($this -> config, $value, '', '', 'images');
            }

    	}
        // echo "<pre>";
        // print_r($state);exit;
    	$this -> assign('state',$state);
        // 会员星币数量
        //token
        $token = empty($token = $this -> user -> getTOKEN())? 0 : $this -> user -> getTOKEN();
        $coin_url = "/member/member_assets";
        $coin = array();
        if($this->curl->get_request($coin_url,'api') == 200){
             $coin = $this->curl->getArrayData();
        }
        // var_dump($coin);exit;
        $this -> assign('coin',$coin);
	}
	// 详情
    public function detailsAction()
    {
        $starkill_id = trim($this->request->get('starkill_id'));
        $details_url = "/starkill/details/{$starkill_id}";
        $details = array();
        if($this->curl->get_request($details_url,'api') == 200){
            $details = $this->curl->getArrayData();
            // 处理logo图片
            $details['data']['logo']= Common::get_image_url($this -> config, $details['data']['logo'], '', '', 'images');
            // 处理详情轮播图片
            $details_pic = explode(",", $details['data']['details_pictures']);
            foreach ($details_pic as $key => &$value) {
                $value= Common::get_image_url($this -> config, $value, '', '', 'images');
            }
            $details['data']['details_pictures'] = $details_pic;
            // 处理详情列表
            $a = function($match){
                return  str_replace($match[2],Common::get_image_url($this->config,$match[2]),$match[0]);
            };
            if($details['data']['spu_pictures']){
                $details['data']['spu_pictures'] = preg_replace_callback('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$a,$details['data']['spu_pictures']);
            }
            // 跳转详情页面
            foreach ($details['data'] as &$value) {
                $details['data']['url'] = $this->config->url->url_goods;
            }

            
            if($details['data']['sku_album']){
                foreach ($details['data']['sku_album'] as $key => &$value) 
                    $value= Common::get_image_url($this -> config, $value, '', '', 'images');
            }
        }
        $this -> assign('details',$details);
	}
	// 订单
    public function orderAction()
    {
        $starkill_id = trim($this->request->get('starkill_id'));
        $qty         = trim($this->request->get('qty'));
        $order_url = "/starkill/details/{$starkill_id}";
        $order = array();
        if($this->curl->get_request($order_url,'api') == 200){
            $order = $this->curl->getArrayData();
            $order['data']['logo']= Common::get_image_url($this -> config, $order['data']['logo'], '', '', 'images');
            $order['data']['qty'] = $qty;
        }
        $this -> assign('order',$order);
	}
    // 确认付款
    public function joinAction()
    {
        $post        = $this->request->getPost();
        $starkill_id = $post['starkill_id'];
        $qty         = $post['qty'];
        $suc_url = "/starkill/join";
        $data    = array("starkill_id"=>$starkill_id,"qty"=>$qty);
        $suc     = array();
        if($this->curl->post_request($suc_url,$data,'api') == 200){
            $suc = $this->curl->getArrayData();
        }else if($this->curl->post_request($suc_url,$data,'api') != 200){
            $suc = $this->curl->getArrayData();
        }
        if(empty($suc)){
            return $this -> failure("失败!",$suc);
        }else{

            return $this -> success("成功!",$suc);
        }
    }
	// 成功
    public function successAction()
    {
        // 活动商品
        $starkill_id = trim($this->request->get('starkill_id')); 
        $qty         = trim($this->request->get('qty'));
        $suc_url = "/starkill/details/{$starkill_id}";
        $suc = array();
        if($this->curl->get_request($suc_url,'api') == 200){
            $suc = $this->curl->getArrayData();
            $suc['data']['logo'] = Common::get_image_url($this -> config, $suc['data']['logo'], '', '', 'images');
            $suc['data']['qty'] = $qty;
        }
        $this -> assign('suc',$suc);
       
        // 猜你喜欢
        /*$like_url = "/goods/rank/guesslike";
        $data['size'] = 6;
        $like = array();
        if($this->curl->post_request($like_url,$data,'api') == 200){
            $like = $this->curl->getArrayData();
            foreach ($like as $key => &$value) {
                $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
            }
            foreach ($like as &$value) {
                $value['url'] = $this->config->url->url_goods;
            }
        } 
        $this -> assign('like',$like);*/
        $like_url = "/v3/goods/guesslike";
        $data['index'] = 1;
        $data['size'] = 6;
        $token = $this->user->getToken();
        $history_id = $this -> cookies -> get('history_id');
        $data['session_id'] = md5($history_id);
        $like = array();
        /*var_dump($this->curl->post_request($like_url,$data,'like_api'));
        echo"<pre>";print_r($this->curl->getResponseText());*/
        $this->curl->set_token($token);
        if($this->curl->post_request($like_url,$data,'java_api') == 200){
            $like = $this->curl->getArrayData();
            foreach ($like['guess_list'] as $key => &$value) {
                $value['logo']= Common::get_image_url($this -> config, $value['logo'], '', '', 'images');
            }
            foreach ($like['guess_list'] as &$value) {
                $value['url'] = $this->config->url->url_goods;
            }
        }
        $this -> assign('like',$like['guess_list']);
	}
	// 立即购买
    public function buyAction()
    {
        $starkill_id = trim($this->request->get('starkill_id'));
        $buy_url = "/starkill/details/{$starkill_id}";
        $buy = array();
        if($this->curl->get_request($buy_url,'api') == 200){
            $buy = $this->curl->getArrayData();
            // 处理logo图片
            $buy['data']['logo']= Common::get_image_url($this -> config, $buy['data']['logo'], '', '', 'images');
            // 处理详情轮播图片
            $details_pic = explode(",", $buy['data']['details_pictures']);
            foreach ($details_pic as $key => &$value) {
                $value= Common::get_image_url($this -> config, $value, '', '', 'images');
            }
            $buy['data']['details_pictures'] = $details_pic;
            // 处理详情列表
            $a = function($match){
                return  str_replace($match[2],Common::get_image_url($this->config,$match[2]),$match[0]);
            };
            if($buy['data']['spu_pictures']){
                $buy['data']['spu_pictures'] = preg_replace_callback('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$a,$buy['data']['spu_pictures']);
            }
            // 跳转详情页面
            foreach ($buy['data'] as &$value) {
                $buy['data']['url'] = $this->config->url->url_order;
            }
            if($buy['data']['sku_album']){
                foreach ($buy['data']['sku_album'] as $key => &$value) 
                    $value= Common::get_image_url($this -> config, $value, '', '', 'images');
            }
        }
        $this -> assign('buy',$buy);
	}
}