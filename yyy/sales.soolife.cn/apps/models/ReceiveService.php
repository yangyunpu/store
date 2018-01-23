<?php
// +----------------------------------------------------------------------
// |  广告位置服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   LocationService.php
// |
// | Author: Gao Qi
// | Created:2016-09-14
// +----------------------------------------------------------------------

class ReceiveService extends BaseService {

    /**
     *
     * 领取优惠券
     * @author Joke Gao 2016-09-14
     *  GET v1/member/coupon/gain/{couponNo}-{memberId}
     */

    function receive($member_id, $couponId) {
        $member_id = $this -> user -> getId();
        $url = "v1/member/coupon/gain/{$couponNo}-{$memberId}";
        if($curl -> get_request($url)=200){
            return $curl ->getJsonData();
        }

            return null;
    }

}
