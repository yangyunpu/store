<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: <zhichao_hu>
// | Created:   2017-04-06
// +----------------------------------------------------------------------
class MindexController extends BaseController
{

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


    public function indexAction()
    {

        $url = $this->config->url;
        $url_order = $url->url_order;
        $this->assign('url_m',$url['url_m2']);
        $url = $url['url_m2'] . "/mindex/index.html";
        $this->go_login($url);



        $futurestar_url = "/member/futurestar";
        $login_data = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $login_data = $this->curl->getArrayData();
            $login_data['avatar'] = Common::get_image_url($this -> config, $login_data['avatar'],'','','avatar');
        }
        $is_login = $login_data['is_login'];
        $is_get = $login_data['is_get'];
        $coin = $login_data['coin'];
        $get_state = $login_data['data'];
        // print_r($login_data);exit;
        $this -> assign('coin',$coin);
        $this -> assign('is_login',$is_login);
        $this -> assign('is_get',$is_get);
        $this -> assign('get_state',$get_state);


        // $member_url = '/member';
        // $member = array();
        // if($this->curl->get_request($member_url,'api') == 200){
        //     $member = $this->curl->getArrayData();
        //     $member['avatar'] = Common::get_image_url($this -> config,$member['avatar'], '80', '80', 'avatar');
        // }
        // // echo "<pre>";
        // // print_r($member);
        // // exit;
        // $coin = $member['coin'];
        // $this -> assign('coin',$coin);



        //////////////////////////
    	$model = new MindexService();
    	$data = $model->ads();
        $this->assign("data",$data['advertising']);
        $this->assign("star",$data['star_theme']);
        $this->guesslikeAction();
        $this->seekAction();
        //分类code码
        $server = new NewcategoryService();
        $categoryresult = $server->categorydata();
        $catedata = array();
        foreach ($categoryresult as $key => &$value) {
            //$catedata[$key] = $value['code'];
            $catedata[$key] = $value['id'];
        }
        $this->assign("catedata",$catedata);
        // $this->getCoinAction();

        // $this->getCoinAction();

        $this->pages->init('首页');

    }

    //2.3首页
    public function newIndexAction()
    {
        //搜索框词
        $word_url = "/v2/get/indexdefaultkeyword";
        $word = array();
        if($this->curl->get_request($word_url,'api') == 200){
            $word = $this->curl->getArrayData();
        }
        if (!empty($word) && $word['success'] == true && isset($word['data']) && !empty($word['data']['gtagname'])) {
            $word_hot = $word['data']['gtagname'];
        }else{
            $word_hot = ' ';
        }
        $this->assign('hot',$word_hot);

        //域名
        $url = $this->config->url;
        $url_order = $url->url_order;
        $this->assign('url_m',$url['url_m']);
        $this->assign('url_money',$url['url_money']);

        //登录返回码
        $url = $url['url_m2'] . "/newindex.html";
        $return_url = base64_encode($url);
        $this->assign('return_url',$return_url);

        //登录信息
        $futurestar_url = "/member/futurestar";
        $login_data = array();
        if($this->curl->get_request($futurestar_url,'api') == 200){
            $login_data = $this->curl->getArrayData();
            // $login_data['avatar'] = Common::get_image_url($this -> config, $login_data['avatar'],'','','avatar');
        }

        $this -> assign('login_data',$login_data);

        //所有广告位
        $ads_url = "/ads/location/app.home23";
        $ads_all = array();
        if($this->curl->get_request($ads_url,'api') == 200){
            $ads_all = $this->curl->getArrayData();
        }

        if (!empty($ads_all)) {
            //banner图
            $banner = array();
            if (!empty($ads_all['app.home23.banner']['children']['app.home23.banner.upbanner']['items'])) {
                foreach ($ads_all['app.home23.banner']['children']['app.home23.banner.upbanner']['items'] as $k => $v) {
                    $banner[$k] = $v;
                    $banner[$k]['picture'] = Common::get_image_url($this -> config, $v['picture'],'','','advert');
                }
            }
            $this->assign('banner',$banner);

            //banner图下第一个广告位
            $ads_one = !empty($ads_all['app.home23.banner']['children']['app.home23.banner.middlebanner']['items'][0])?$ads_all['app.home23.banner']['children']['app.home23.banner.middlebanner']['items'][0]:'';
            $ads_one['picture'] = !empty($ads_one)?Common::get_image_url($this -> config, $ads_one['picture'],'','','advert'):'';
            $this->assign('ads_one',$ads_one);

            //新品上部分广告位4个
            $ads_two = array();
            $ads_two[0] = !empty($ads_all['app.home23.banner']['children']['app.home23.lowerbanner.upleft']['items'][0])?$ads_all['app.home23.banner']['children']['app.home23.lowerbanner.upleft']['items'][0]:'';
            $ads_two[0]['picture'] = !empty($ads_two[0])?Common::get_image_url($this -> config, $ads_two[0]['picture'],'','','advert'):'';

            $ads_two[1] = !empty($ads_all['app.home23.banner']['children']['app.home23.lowerbanner.upright']['items'][0])?$ads_all['app.home23.banner']['children']['app.home23.lowerbanner.upright']['items'][0]:'';
            $ads_two[1]['picture'] = !empty($ads_two[1])?Common::get_image_url($this -> config, $ads_two[1]['picture'],'','','advert'):'';

            $ads_two[2] = !empty($ads_all['app.home23.banner']['children']['app.home23.lowerbanner.lowerleft']['items'][0])?$ads_all['app.home23.banner']['children']['app.home23.lowerbanner.lowerleft']['items'][0]:'';
            $ads_two[2]['picture'] = !empty($ads_two[2])?Common::get_image_url($this -> config, $ads_two[2]['picture'],'','','advert'):'';

            $ads_two[3] = !empty($ads_all['app.home23.banner']['children']['app.home23.lowerbanner.lowerright']['items'][0])?$ads_all['app.home23.banner']['children']['app.home23.lowerbanner.lowerright']['items'][0]:'';
            $ads_two[3]['picture'] = !empty($ads_two[3])?Common::get_image_url($this -> config, $ads_two[3]['picture'],'','','advert'):'';
            $this->assign('ads_two',$ads_two);

            //新品广告位
            $ads_new = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.newgoods']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.newgoods']['items'][0]:'';
            $ads_new['picture'] = !empty($ads_new)?Common::get_image_url($this -> config, $ads_new['picture'],'','','advert'):'';
            $this->assign('ads_new',$ads_new);


            //限时折扣广告位
            $ads_sale = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.discountgoods']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.discountgoods']['items'][0]:'';
            $ads_sale['picture'] = !empty($ads_sale)?Common::get_image_url($this -> config, $ads_sale['picture'],'','','advert'):'';
            $this->assign('ads_sale',$ads_sale);


            //爆款推荐广告位
            $ads_blast = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.explosiongoods']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.explosiongoods']['items'][0]:'';
            $ads_blast['picture'] = !empty($ads_blast)?Common::get_image_url($this -> config, $ads_blast['picture'],'','','advert'):'';
            $this->assign('ads_blast',$ads_blast);


            //最下方五个广告位
            //单--上
            $ads_bottom_one = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoods']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoods']['items'][0]:'';
            $ads_bottom_one['picture'] = !empty($ads_bottom_one)?Common::get_image_url($this -> config, $ads_bottom_one['picture'],'','','advert'):'';
            $this->assign('ads_bottom_one',$ads_bottom_one);

            //左上
            $ads_bottom_left = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinupleft']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinupleft']['items'][0]:'';
            $ads_bottom_left['picture'] = !empty($ads_bottom_left)?Common::get_image_url($this -> config, $ads_bottom_left['picture'],'','','advert'):'';
            $this->assign('ads_bottom_left',$ads_bottom_left);

            //右上
            $ads_bottom_up = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinupright']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinupright']['items'][0]:'';
            $ads_bottom_up['picture'] = !empty($ads_bottom_up)?Common::get_image_url($this -> config, $ads_bottom_up['picture'],'','','advert'):'';
            $this->assign('ads_bottom_up',$ads_bottom_up);

            //左下
            $ads_bottom_right = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinlowerleft']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinlowerleft']['items'][0]:'';
            $ads_bottom_right['picture'] = !empty($ads_bottom_right)?Common::get_image_url($this -> config, $ads_bottom_right['picture'],'','','advert'):'';
            $this->assign('ads_bottom_right',$ads_bottom_right);

            //右下
            $ads_bottom_down = !empty($ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinlowerright']['items'][0])?$ads_all['app.home23.middle']['children']['app.home23.middle.categorytopicsgoodsinlowerright']['items'][0]:'';
            $ads_bottom_down['picture'] = !empty($ads_bottom_down)?Common::get_image_url($this -> config, $ads_bottom_down['picture'],'','','advert'):'';
            $this->assign('ads_bottom_down',$ads_bottom_down);

        }else{
            $this->assign('ads_bottom_down','');
            $this->assign('ads_bottom_right','');
            $this->assign('ads_bottom_up','');
            $this->assign('ads_bottom_left','');
            $this->assign('ads_bottom_one','');
            $this->assign('ads_blast','');
            $this->assign('ads_sale','');
            $this->assign('ads_new','');
            $this->assign('ads_two','');
            $this->assign('ads_one','');
            $this->assign('banner','');
        }
        
        //商品
        $goods_url = "/v2/get/indexrecommend";
        $goods = array();
        if($this->curl->get_request($goods_url,'api') == 200){
            $goods = $this->curl->getArrayData();
        }
// echo "<pre>";
// print_r($goods);exit;
        if (!empty($goods) && $goods['success'] && !empty($goods['data'])) {
            //新品商品
            if (!empty($goods['data']['newgoods_result'] && $goods['data']['newgoods_result']['gstatus'] == 1 && !empty($goods['data']['newgoods_result']['sku_res']))) {
                $new_goods = $goods['data']['newgoods_result']['sku_res'];
                foreach ($new_goods as $key => $val) {
                    $val['slogo'] = Common::get_image_url($this -> config, $val['slogo'],'','','images');
                    switch ($key) {
                        case 0:
                            $goods_new_one = $val;
                            break;
                        case 1:
                            $goods_new_two = $val;
                            break;
                        case 2:
                            $goods_new_there = $val;
                            break;                        
                        default:
                            $goods_new[] = $val;
                            break;
                    }
                }

            }else{
                $goods_new_one = '';
                $goods_new_two = '';
                $goods_new_there = '';
                $goods_new = '';
            }

            $this->assign('goods_new_one',$goods_new_one);
            $this->assign('goods_new_two',$goods_new_two);
            $this->assign('goods_new_there',$goods_new_there);
            $this->assign('goods_new',$goods_new);

            //限时折扣
            if (!empty($goods['data']['discountgoods_result'] && $goods['data']['discountgoods_result']['gstatus'] == 1 && !empty($goods['data']['discountgoods_result']['sku_res']))) {
                $new_goods = $goods['data']['discountgoods_result']['sku_res'];
                foreach ($new_goods as $key => $val) {
                    $val['slogo'] = Common::get_image_url($this -> config, $val['slogo'],'','','images');
                    switch ($key) {
                        case 0:
                            $goods_sale_one = $val;
                            $goods_sale_one['atime'] = date("Y-m-d H:i:s",$val['atime']);
                            break;                      
                        default:
                            $goods_sale[] = $val;
                            break;
                    }
                }

            }else{
                $goods_sale_one = '';
                $goods_sale = '';
            }
            $this->assign('goods_sale_one',$goods_sale_one);
            $this->assign('goods_sale',$goods_sale);

            //爆款推荐
            if (!empty($goods['data']['ex_result'] && $goods['data']['ex_result']['estatus'] == 1 && !empty($goods['data']['ex_result']['left_sku_res']) && !empty($goods['data']['ex_result']['right_sku_res']))) {
                $goods_blast = $goods['data']['ex_result'];
                $goods_blast['left_sku_res']['slogo'] = Common::get_image_url($this -> config, $goods_blast['left_sku_res']['slogo'],'','','images');
                $goods_blast['right_sku_res']['slogo'] = Common::get_image_url($this -> config, $goods_blast['right_sku_res']['slogo'],'','','images');
                foreach ($goods_blast['elowersku_res'] as $key => $value) {
                    $goods_blast['elowersku_res'][$key]['slogo'] = Common::get_image_url($this -> config, $value['slogo'],'','','images');
                }
            }else{
                $goods_blast = '';
            }
            $this->assign('goods_blast',$goods_blast);

        }else{
            $goods = '';
        }
        // echo "<pre>";
        // print_r($goods['data']['newgoods_result']['gstatus']);exit;
        $this->assign('goods',$goods);
        
        //猜你喜欢
        $data['index'] = 1;
        $data['size'] = 64;
        $data['promo_flag'] = true;
        $data['comment_flag'] = true;
        $token = $this->user->getToken();
        $history_id = $this -> cookies -> get('history_id');
        $data['session_id'] = md5($history_id);
        $service = new MindexService();
        $result = $service->GuessLike($data,$token);

        foreach ($result['guess_list'] as &$value) {
            $value['url'] = $this->config->url->url_goods;
        }
        $guess_list = $result['guess_list'];
        $ads_like = $ads_all['app.home23.middle']['children']['app.home23.middle.guesslike']['items'];

        $num_like = count($guess_list);//商品个数
        $like = array_chunk($guess_list,ceil($num_like/2));//猜你喜欢数组拆分
        $left_like = $like[0];//左侧商品
        $right_like = $like[1];//右侧商品

        if (!empty($ads_like)) {
            foreach ($ads_like as $key => $pic) {
                $ads_like[$key]['picture'] = !empty($pic['picture'])?Common::get_image_url($this -> config, $pic['picture'],'','','advert'):'';
            }

            $ads_like = array_splice($ads_like,0,20);

            $num_ads = count($ads_like);//广告位个数
            $num = ceil($num_like/$num_ads);
            $like_ads = array_chunk($ads_like,ceil($num_ads/2));//广告位数组拆分
            $left_ads = $like_ads[0];//左侧广告位
            $right_ads = $like_ads[1];//右侧广告位

            //左侧数据处理(商品内插入广告位)
            $i = 0;
            foreach ($left_like as $left => $val) {
                $left_num = count($left_ads);
                if ($left % 2 == 1 && $i <= $left_num-1) {
                    array_splice($left_like,$left*($i+1),0,array($left_ads[$i]));
                $i++;
                }
            }

            //右侧数据处理(商品内插入广告位))
            $j = 0;
            foreach ($right_like as $right => $val) {
                $right_num = count($right_ads);
                if ($right % 2 == 0 && $j <= $right_num-1) {
                    array_splice($right_like,$j*($right_num+$right),0,array($right_ads[$j]));
                $j++;
                }
            }
        }

        // echo "<pre>";
        // print_r($right_like);exit;
        // array_splice($guess_list,2,0,array($ads_like[0]));
        // array_splice($guess_list,5,0,array($ads_like[1]));
        // array_splice($guess_list,20,0,array($ads_like[2]));
        // array_splice($guess_list,23,0,array($ads_like[3]));

        $this->assign("left_like",$left_like);
        $this->assign("right_like",$right_like);

        $this->pages->init('首页');

    }

     //2.3 首页搜索
    public function searchAction(){
        //热词
        $hot_url = "/v2/goods/search/hottag/20";
        $word_hot = array();
        if($this->curl->get_request($hot_url,'api') == 200){
            $word_hot = $this->curl->getArrayData();
        }
        $search = '';
        $hot = array();
        if (!empty($word_hot) && !empty($word_hot['search']['gtagname'])) {
            $search = $word_hot['search']['gtagname'];
        }
        if (!empty($word_hot) && !empty($word_hot['word']) && is_array($word_hot['word'])) {
            $hot = $word_hot['word'];
        }
        $this->assign('search',$search);
        $this->assign('hot',$hot);

        $this->pages->init('搜索');
    }


    //领星币
    // public function getCoinAction(){
    // 	$model = new MindexService();
    // 	$data = $model->index();
    // 	if(empty($data)){
    // 		return $this -> failure("失败!",$data);
    // 	}
    // 	return $this->success("成功!",$data);
    // }
    //猜你喜欢
      public function guesslikeAction(){
      	if($this->request->isPOST()){
	        $data['index'] = $this->request->getPost('index','int',1);
	        $data['size'] = $this->request->getPost('size','int',8);
            $token = $this->user->getToken();
            $history_id = $this -> cookies -> get('history_id');
            $data['session_id'] = md5($history_id);
	        $service = new MindexService();
	        $result = $service->GuessLike($data,$token);

	        foreach ($result['guess_list'] as &$value) {
	        	$value['url'] = $this->config->url->url_goods;
	        }
            // echo"<pre>";print_r($result);die;
	        return $this->success($result['guess_list']);

      	}else{
      		$data['index'] = $this->request->getPost('index','index',1);
	        $data['size'] = $this->request->getPost('size','int',8);
            $data['size'] = 64; //控制一次请求的数量
            $token = $this->user->getToken();
            $history_id = $this -> cookies -> get('history_id');
            $data['session_id'] = md5($history_id);
	        $service = new MindexService();
	        $result = $service->GuessLike($data,$token);

	        foreach ($result['guess_list'] as &$value) {
	        	$value['url'] = $this->config->url->url_goods;
	        }
            // var_dump($result);die;
			$this->assign("datalike",$result['guess_list'] );

      	}
        // echo"<pre>";print_r($result);die;
    }
     //热首页搜索
     
    public function seekAction(){
        $this->curl->get_request('/goods/search/hottag/6');
        $hot= $this->curl->getArrayData();
        $this -> assign('hot',$hot);
    }
     // 热门搜索自动补全
     
    public function searchAutoAjaxAction(){
        
        $autoVal['keyword'] = $this ->request ->getPost("keyword");
        $search_url = "/v2/goods/searchword";

        $searchAutoVal = array();
        $code = $this->curl->post_request($search_url,$autoVal,'java_api');
        if($this->curl->post_request($search_url,$autoVal,'java_api') == 200){
            $searchAutoVal = $this->curl->getArrayData();
        }

        // echo "<pre>";
        // print_r($searchAutoVal);
        // exit;

        if($code != 200){
            $this->failure('false',$searchAutoVal);
        }else{
            $this->success('success',$searchAutoVal);
        }


    }

    public function guessLikeAjaxAction(){
        $page = $_GET['page'] > 1 ?$_GET['page']:1;
        //所有广告位
        $ads_url = "/ads/location/app.home23";
        $ads_all = array();
        if($this->curl->get_request($ads_url,'api') == 200){
            $ads_all = $this->curl->getArrayData();
        }

        $left_like = array();
        $right_like = array();

        //猜你喜欢
        $data['index'] = ($page - 1) * 64;
        $data['size'] = 64;
        $data['promo_flag'] = true;
        $data['comment_flag'] = true;
        $token = $this->user->getToken();
        $history_id = $this -> cookies -> get('history_id');
        $data['session_id'] = md5($history_id);
        $service = new MindexService();

        $result = $service->GuessLike($data,$token);
        if (!empty($result['guess_list'])) {
            foreach ($result['guess_list'] as &$value) {
                $value['url'] = $this->config->url->url_goods;
            }

            $guess_list = $result['guess_list'];
            $num_like = count($guess_list);//商品个数
            $like = array_chunk($guess_list,ceil($num_like/2));//猜你喜欢数组拆分
            $left_like = $like[0];//左侧商品
            $right_like = $like[1];//右侧商品

            $ads_like = $ads_all['app.home23.middle']['children']['app.home23.middle.guesslike']['items'];
            if (!empty($ads_like)) {

                foreach ($ads_like as $key => $pic) {
                    $ads_like[$key]['picture'] = !empty($pic['picture'])?Common::get_image_url($this -> config, $pic['picture'],'','','advert'):'';
                }

                if (count($ads_like) < 20) {
                    $ads_like = array_splice($ads_like,0,20);
                }elseif (count($ads_like) < (20 * $page - 1)) {
                    $ads_like = array_splice($ads_like,(20 * $page - 2),20);
                }else{
                    $ads_like = array_splice($ads_like,(20 * $page - 1),20);
                }

                $num_ads = count($ads_like);//广告位个数
                $num = ceil($num_like/$num_ads);

                $like_ads = array_chunk($ads_like,ceil($num_ads/2));//广告位数组拆分

                $left_ads = $like_ads[0];//左侧广告位
                $right_ads = $like_ads[1];//右侧广告位

                //左侧数据处理(商品内插入广告位)
                $i = 0;
                foreach ($left_like as $left => $val) {
                    $left_num = count($left_ads);
                    if ($left % 2 == 1 && $i <= $left_num-1) {
                        array_splice($left_like,$left*($i+1),0,array($left_ads[$i]));
                    $i++;
                    }
                }

                //右侧数据处理(商品内插入广告位))
                $j = 0;
                foreach ($right_like as $right => $val) {
                    $right_num = count($right_ads);
                    if ($right % 2 == 0 && $j <= $right_num-1) {
                        array_splice($right_like,$j*($right_num+$right),0,array($right_ads[$j]));
                    $j++;
                    }
                }
            }
        }
        

        $res['left'] = $left_like;
        $res['right'] = $right_like;
        return json_encode($res);
    }

}