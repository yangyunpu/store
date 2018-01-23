<?php
// +----------------------------------------------------------------------
// | 会员中心首页控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// |
// | Author: Gao Qi
// | Created:   2016-07-20
// +--------------------------      --------------------------------------------
namespace Soolife\Sales\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Models\IndexModel;
use  Soolife\Member\Services\ReceiveService;


class ReceiveController extends BaseController {
    private $member_id;
    private $m_token;
     /*
      *获取token
     */
  private $login;

    public function initialize(){
        parent::initialize();

        $this->m_token = $this->cookies->get('m_token');

        /**
        *如果浏览器传过来的  token 存在 说明用户曾经在该浏览器登陆过
        *   此时，通过加入购物车时返回信息，判断用户是否  离线  ；如离线，让用户登录
        *若无token值，说明用户未在该浏览器登录过，则加入临时购物车
        *$this->login 状态：1  登录过  ;  0 从未登录。
        */
        if($this->m_token){
            $this->login = 1;
            $this->member_id = $this-> user-> getId();
        }else{
            $this->login = 0;
        }
    }
    
                
    /*
     * 领取优惠券
     */
 public function receiveAction(){
        $id= $this->request->getPost('couponid');
        if($this-> login){
            if($this->member_id){
                $receive=new ReceiveService();
                $res = $receive ->receive($this ->member_id,$id);
                if($res =='200'){
                    $res = '1';
                }elseif($res =='400'){
                    $res = '0';
                }   
            }else{
                $res = '-1';
            }
        }else{
            $res = '-1';
        }
        die(json_encode($res));
    }
          
 }

 ?>