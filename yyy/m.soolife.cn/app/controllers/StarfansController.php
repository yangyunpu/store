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
class StarfansController extends BaseController
{
    public function indexAction()
    {
        //  /ads/location/app.link 广告
        $link_url = "/ads/location/app.link";
        $link = array();
        $urlReg = "/^((https?):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|loc|web|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/";

        if($this->curl->get_request($link_url,'php_api') == 200){
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
        }
        $this -> assign('link',$link);



        //award 奖励
        $award_url = "/app/register/award/new";
        $award = array();
        if($this->curl->get_request($award_url,'php_api') == 200){
            $award = $this->curl->getArrayData();
        }
        $this -> assign('award',$award);


        //分享记录 http://api.test.soolife.net/app/register/inviterecode
        $inviterecode_url = "/app/register/inviterecode";
        $data = array("skip"=> 0,"take"=> 5);
        $inviterecode = array();
        if($this->curl->post_request($inviterecode_url,$data,'php_api') == 200){
            $inviterecode = $this->curl->getArrayData();
            $inviterecode['num'] = 0;
            if($inviterecode['count'] > 5){
                $inviterecode['num'] = 1;
            }
            foreach ($inviterecode['data'] as $key => &$value)
                $value['accepter_avatar'] = Common::get_image_url($this -> config, $value['accepter_avatar'], '', '', 'avatar');
        }
        $this -> assign('inviterecode',$inviterecode);

        //top10 http://api.test.soolife.net/app/register/wealthtop
        $wealthtop_url = "/app/register/wealthtop";
        $data = array("skip"=> 0,"take"=> 10);
        $wealthtop = array();
        if($this->curl->post_request($wealthtop_url,$data,'php_api') == 200){
            $wealthtop = $this->curl->getArrayData();
            foreach ($wealthtop as $key => &$value)
                $value['avatar'] = Common::get_image_url($this -> config, $value['avatar'], '', '', 'avatar');
        }
        $this -> assign('wealthtop',$wealthtop);

        $this->pages->init('首页');
    }




    public function getpacketAction()
    {
        //分享 获取活动编号
        $sellhot_url = "/member/registersource";
        $sellhot = array();
        if($this->curl->get_request($sellhot_url,'php_api') == 200){
            $sellhot = $this->curl->getArrayData();
        }
        $source_no = $sellhot['source_no'];
        $id = $this->request->get('id');
        $member_id = $this->request->get('member_id');
        $sharepage_url = "/app/register/sharepage/{$member_id}/{$source_no}";
        $sharepage = array();
        if($this->curl->get_request($sharepage_url,'php_api') == 200){
            $sharepage = $this->curl->getArrayData();
            foreach ($sharepage['hot_goods'] as $key => &$value) {
                $value['S_Logo'] = Common::get_image_url($this -> config, $value['S_Logo'], '', '', 'images');
            }
        }
        $this -> assign('sharepage',$sharepage);
        $this -> assign('id',$id);
        $this->pages->init('首页');
    }
    public function activeAction()
    {
        //分享记录列表 http://api.test.soolife.net/app/register/inviterecode
        $inviterelist_url = "/app/register/inviterecode";
        $data = array("skip"=> 0,"take"=> 500);
        $inviterelist = array();
        if($this->curl->post_request($inviterelist_url,$data,'php_api') == 200){
            $inviterelist = $this->curl->getArrayData();
            foreach ($inviterelist['data'] as $key => &$value){
                if(empty($value['nick_name'])){
                    $value['nick_name']='匿名用户';
                }
                $value['accepter_avatar'] = Common::get_image_url($this -> config, $value['accepter_avatar'], '', '', 'avatar');
            }

        }
        $this -> assign('inviterelist',$inviterelist);
        $this->pages->init('首页');

    }
    public function shareAction()
    {
        //分享 获取活动编号
        $sellhot_url = "/member/registersource";
        $sellhot = array();

        if($this->curl->get_request($sellhot_url,'php_api') == 200){
            $sellhot = $this->curl->getArrayData();
        }
        // var_dump($this->curl->getResponseText());exit;
        if($sellhot){
            $source_no = $sellhot['source_no'];
            $member_id = trim($this->request->get('member_id'));

            $sharepage_url = "/app/register/sharepage/{$member_id}/{$source_no}";
            $sharepage = array();
            if($this->curl->get_request($sharepage_url,'php_api') == 200){
                $sharepage = $this->curl->getArrayData();
                $sharepage['avatar'] = Common::get_image_url($this -> config, $sharepage['avatar'], '', '', 'avatar');
                foreach ($sharepage['hot_goods'] as $key => &$value) {
                    $value['S_Logo'] = Common::get_image_url($this -> config, $value['S_Logo'], '', '', 'images');
                }
            }

            // 区分红包内容
            $award_url = "/app/register/award/new";
            $award = array();
            if($this->curl->get_request($award_url,'php_api') == 200){
                $award = $this->curl->getArrayData();
            }
            $this -> assign('award',$award['accepter']);

            $count = isset($sellhot['s_limit']) ? intval($sellhot['s_limit']) : 0;
            $this -> assign('count',$count);
            $this -> assign('sharepage',$sharepage);
            $this->assign('member_id',$member_id);
            $this->assign('source_no',$source_no);
        }else{
            //获取红包耗时
            /*$source_no = isset(current($reward_latest)['source_no']) ? current($reward_latest)['source_no'] : '';
            if($source_no){
                $used_time_url = "/member/awardcosttime/{$source_no}";
                if($this->curl->get_request($used_time_url,'php_api') == 200){
                    $res = $this->curl->getJsonData();
                    $this->assign('time',$res);
                }
            }*/
            $this->view->pick('reward/fulfill');
        };
        $this->pages->init('首页');
    }
     public function endAction()
    {
        //分享 获取活动编号
        $sellhot_url = "/member/registersource";
        $sellhot = array();
        if($this->curl->get_request($sellhot_url,'php_api') == 200){
            $sellhot = $this->curl->getArrayData();
        }
        $source_no = $sellhot['source_no'];
        $id = $this->request->get('id');
        $member_id = $this->request->get('member_id');
        $sharepage_url = "/app/register/sharepage/{$member_id}/{$source_no}";
        $sharepage_url = "/app/register/sharepage/{$member_id}/{$source_no}";
        $sharepage = array();
        if($this->curl->get_request($sharepage_url,'php_api') == 200){
            $sharepage = $this->curl->getArrayData();
            foreach ($sharepage['hot_goods'] as $key => &$value) {
                $value['S_Logo'] = Common::get_image_url($this -> config, $value['S_Logo'], '', '', 'images');
            }
        }
        $this -> assign('sharepage',$sharepage);
        $this -> assign('id',$id);
        $this->pages->init('首页');
    }

    //判断手机号是否注册
    function isRegionAction(){
        $phone = $this->request->getPost('phone');
        $region = false;
        $url = "/app/register/verifyphone/" . $phone;
        if($this->curl->get_request($url,'php_api') == 200){
            $region = $this->curl->getArrayData();
        }
        $this->success($region);
    }

    //判断图片验证码输入是否正确
    function imageCodeAction(){
        $image_val = $this->request->getPost('image_val');
        $vcode_key = $this->request->getPost('vcode_key');
        $verify = new Verify((array)$this->config);
        $a = 1;

        if(!$verify->check(strtolower($image_val),$vcode_key))
        {
            $a = 0;
        }
        $this->success($a);
    }

    //发送短信验证码
    function sendCodeAction(){
        $tele = $this->request->getPost('phone');
        $sms = new Sms();
        $res = $sms->send_msg($tele,'register');

        if(isset($res['success']) && $res['success'])
        {
            return $this->success('发送成功');
        }else{
            return $this->failure($res['msg']);
        }
    }

    //注册手机号
    function registerAction(){
        $data['phone'] = trim($this->request->getPost('phone'));
        $data['vcode'] = trim($this->request->getPost('num_code'));
        $data['referrer'] = trim($this->request->getPost('member_id'));
        $data['source'] = trim($this->request->getPost('source_no'));
        $url = "/app/register/verifyregister";

        $this->curl->post_request($url,$data,'php_api');
        $a = $this->curl->getArrayData();
        $this->json($a);
    }

    public function notFoundAction(){
        header('location:'.$this->config->url->url_m.'/index.html');
    }


}