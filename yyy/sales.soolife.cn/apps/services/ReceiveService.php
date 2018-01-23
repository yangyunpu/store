<?php
// +----------------------------------------------------------------------
// | 商品类控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:
// | Author: Jinlong_Xie <soosim@qq.com>
// | Created:2016-08-13 11:49:36
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;
use Soolife\Member\Librarys\Common;
use  Soolife\Member\Services\ReceiveService ;

class ReceiveService extends BaseService{
    /**
     *
     * 领取优惠券
     * @author Joke Gao 2016-09-14
     *  GET v1/member/coupon/gain/{couponNo}-{memberId}
     */
     private $api_gain_coupon = '/v1/member/coupon/gain/';
      
	 public function receive($id,$couponid){
	     //echo 'aaaa';exit;
         if(!$id || !$couponid)
		{
			return false;
		}else{

			$api = $this->api_gain_coupon.$couponid.'-'.$id;
            
			if($this-> curl->get_request($api) == 200)
			{
				$result = $this-> curl->getJsonData();
				return $result;
			}else{
				return $this-> curl->get_request($api);
			}

			return false;
		}
	}
}
?>