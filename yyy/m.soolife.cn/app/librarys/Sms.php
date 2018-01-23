<?php
// +----------------------------------------------------------------------
// | 用户类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Sms.php
// |
// | Author: Luo Qing
// | Created:   2016-07-06
// +----------------------------------------------------------------------
/**
 * 发送短信类
 * register:星粉注册成功短信通知: 小星星，您已成为我们“如此生活”大家庭的一员了，还不快来与我们一起分享精彩生活瞬间，让美好生活，从此开始！【如此生活】
 * forget:忘记密码，发送找回密码短信 : 您的账户安全验证码为：{$verify_number}，请在验证页面输入，并及时修改密码。如有疑问，请致电：400-068-5151。【如此生活】
 * verify:发送验证码短信 : 您的手机验证码为{$verify_number}，请确认是由您本人发起，如有疑问，请致电“如此生活”全国服务热线：400-068-5151【如此生活】
 * pay_success:发送订单支付成功短信 : 您成功支付了订单.请您耐心等待，订购的商品马上就会送达。如有疑问，请致电：400-068-5151。【如此生活】
 * activity:参加活动短信通知 : 尊敬的星粉，恭喜您获得验证码{$verify_number}。庆祝“如此生活”一站式服务平台全面启航，如此生活，如您所愿！【如此生活】
 * **/
use Phalcon\Mvc\User\Component;

class Sms extends Component{


    /**
    * [php-api] 发送短信   $url = /sms/{type}/{phone}
    * @param telephone[手机号码] , type[类型] activitylogin/register/safety/forgot/success/pay/deliver/refund/afterSales
    * @author Jinlong_Xie <soosim@qq.com>
    * @date 2016-08-10 16:58:12
    */
    public function send_msg($tele, $type){
        $ip = Common::get_client_address();

        $check_ip = $this->check_send("sms:send_limit:{$ip}");
        $check_phone = $this->check_Send("sms:send_limit:{$tele}");

        if($check_ip || $check_phone){
            return array(
                'success'=>false,
                'msg' => '请稍后再尝试获取短信!'
            );
        }

        $limit_time = 1;

        $url = '/v2/sms/'.$type.'/'.$tele;
        $code = $this->curl->get_request($url,'api');

        if($code == 200){
            $this->limit_send($tele,60);
            $this->limit_send($ip,$limit_time);
            return array(
                'success'=>true,
                'msg' => '短信发送成功!'
            );
        }
        return $this->curl->getArrayData();
    }

    /**
    * Limit IP
    * @author Jinlong_Xie <soosim@qq.com>
    * @date 2016-10-21 13:09:06
    */
    private function limit_send($key,$lifetime){
        $limit_key = 'sms:send_limit:'.$key;
        $redis = $this-> redis;
        $redis->write_simple($limit_key,1,'sms',$lifetime);
    }

    /**
    * Check Limit
    * @return bool
    * @author Jinlong_Xie <soosim@qq.com>
    * @date 2016-10-21 13:20:35
    */
    private function check_send($key){
        $redis = $this-> redis;
        $res = $redis->read($key,'sms');
        if(isset($res)){
            return true;
        }
        return false;
    }

    /**
    * 检验手机验证码是否正确
    * @return boolen
    * @param tele  type  vcode
    * @author Jinlong_Xie <soosim@qq.com>
    * @date 2016-08-13 15:13:56
    */
    public function check_vcode($phone,$type,$vcode){
        $url = '/v2/sms/check/';
        $data = array(
            'phone' => $phone,
            'type'  => $type,
            'vcode' => $vcode
        );
        $this->curl->post_request($url,$data,'api');
        return $this->curl->getArrayData();
    }
}
