<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  zhichao_huController.php
// |
// | Author: 
// | Created:   2016-08-15
// +----------------------------------------------------------------------
class LifeController extends BaseController
{
	public function lifeAction()
    {
    	//导航
        $this->curl->get_request("/basic/category/mobile",'php_api');
        $koko= $this->curl->getArrayData();
        $this->assign('koko',$koko);

        //星币
        $token = empty($token = $this -> user -> getTOKEN())? 0 : $token = $this -> user -> getTOKEN();
        $id = $this -> user -> getId();
        $type= 6;
        $this->curl->get_request("/member/assets/coin",'php_api');
        $xingbi = $this->curl->getArrayData();
        $this -> assign('token',$token);
        $this -> assign('xingbi',$xingbi);
       


        //广告新街口
        $this->curl->get_request('/ads/location/app.lifestyle','new_api');
        $ads = $this->curl->getArrayData();
        if(isset($ads))
        {
            foreach($ads as $ksy => &$value)
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
        $this -> assign('ads',$ads);


       //星粉秀
        $this->curl->get_request('/starpink/starpink/1/6','php_api');
        $data= $this->curl->getArrayData();
        if (isset($data)){
            foreach ($data as $key => &$value) {
                 $value['photo'] = Common::get_fans_url($this -> config, $value['photo'],"fans");
            }
            
        }
        $this -> assign('data',$data);
        
             
        //最新
        $this->curl->get_request('/starpink/starpink/1/20','php_api');
        $mata = $this->curl->getArrayData();
        if (isset($mata)){
            foreach ($mata as $key => &$value) {
                 $value['photo'] = Common::get_fans_url($this -> config, $value['photo'],"fans");
            }
            
        }
        $this -> assign('mata',$mata);

        //最热
        $this->curl->get_request('/starpink/starpink/2/20','php_api');
        $faker = $this->curl->getArrayData();
         if (isset($faker)){
            foreach ($faker as $key => &$value) {
                 $value['photo'] = Common::get_fans_url($this -> config, $value['photo'],"fans");
            }
            
        }
        //print_r($faker);exit;
        $this -> assign('faker',$faker);

        //星换购
        $this->curl->disable_token();
        $price = "";
        //$this->curl->post_request('/v2/goods/search',array("is_coin"=>true,"coin_min"=>0,"coin_max"=>0,"skip"=>0,"take"=>10),'v2_api');
        $this->curl->post_request('/v2/goods/search',array("is_coin"=>true,"coin_min"=>0,"coin_max"=>0,"skip"=>0,"take"=>10),'java_api');
        $xingxingall = $this->curl->getArrayData();

         if (isset($xingxingall)){
            foreach ($xingxingall['items'] as $key => &$value) {
                $value = $value['items'][0]; //新加
                $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
            }
             //print_r($xingxingall);die;
        }
        $this->assign('xingxingall',$xingxingall);

        //购物车商品数量v2/cart/{sessionID}/summary
        $this->curl->enable_token();
        $sessionId = md5($this->history_id);
        $this->curl->get_request("/v2/cart/{$sessionId}/summary","v2_api");
        $car = $this->curl->getArrayData();
        $num = isset($car['total_qty']) ? $car['total_qty'] : 0;
        $this -> assign('num',$num);
       
    	$this->pages->init('惠生活');
	}


    //星换购js
    public function saleAction()
    {
        $post     = $this ->request-> getPost();
        $coin_min = $post['coin_min'];
        $coin_max = $post['coin_max'];
        $skip     = $post['skip'];
        $take     = $post['take'];
        //$this->curl->post_request('/v2/goods/search',array("is_coin"=>true,"coin_min"=>$coin_min,"coin_max"=>$coin_max,"skip"=>$skip ,"take"=>$take),'v2_api');
        $this->curl->post_request('/v2/goods/search',array("is_coin"=>true,"coin_min"=>$coin_min,"coin_max"=>$coin_max,"skip"=>$skip ,"take"=>$take),'java_api');
        $result = $this->curl->getArrayData();
        if (isset($result)){
            foreach ($result['items'] as $key => &$value) {
                $value = $value['items'][0]; //新加
                $value['logo'] = Common::get_image_url($this -> config, $value['logo']);
            }
            return $this -> success("成功!",$result,"");  
        }
        return $this -> failure("失败!",$result,"");
          
    }



    //星粉秀详情
	public function detailAction($id)
    {
        $id    = intval($id);
        $token = empty($_COOKIE['m_token'])? 0 : $_COOKIE['m_token'];
        $this->curl->get_request("/starpink/details/$id",'php_api');
        $mata  = $this->curl->getArrayData();
        if (isset($mata)){
            foreach ($mata['fans_show']['albums'] as $key => &$value) {
                 $value['photo'] = Common::get_fans_url($this -> config, $value['photo'],"fans");
            }
            foreach ($mata['fans_show']['comments'] as $key => &$value) {
                 $value['avatar'] = Common::get_fans_url($this -> config, $value['avatar']);
            } 
        }
        $this -> assign('token',$token);
        $this -> assign('mata',$mata);

        $this->pages->init('详情');
	}


     // 点赞或不点赞
     public function praiseAction(){
        $fanshow_id = $this ->request-> getPost("fanshow_id");
        $praise     = $this ->request-> getPost("praise");
        $praise     = intval($praise);
        $post       = array("fanshow_id" => $fanshow_id, "praise" => $praise, "comment"=>"","to_member_name"=>"");

        $this->curl->post_request('/starpink/comment',$post,'php_api');
        $result     = $this->curl->getArrayData();

        if(isset($result)){
            return $this -> success("成功!",$result,"");
        }
        return $this -> failure("失败!",$result,"");
     }


     //发表评论
     public function commentAction(){
        $fanshow_id = $this ->request-> getPost("fanshow_id");
        $comment    = $this ->request-> getPost("comment");
        $post       = array("fanshow_id" => $fanshow_id, "praise" =>"", "comment"=>$comment,"to_member_name"=>"");
        
        $this->curl->post_request('/starpink/comment',$post,'php_api');
        $result     = $this->curl->getArrayData();

        if(isset($result)){
            return $this -> success("发布成功!",$result,"");
        }
        return $this -> failure("提交失败!",$result,""); 
     }
    
    

}