<?php
// +----------------------------------------------------------------------
// | 注册奖励
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// |
// | Author:
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class RewardController extends BaseController
{
	public function inviteAction()
	{
		$member_id = $this->request->get('member_id');
        if(empty($member_id)){
            $member_id = $this->request->get('memberid');
        }

        $res = array();
        $api = '/member/registersource';
        if($this->curl->get_request($api,'php_api') == 200){
        	$res = $this->curl->getArrayData();
            if(isset($res['source_no']) && $res['source_no'] != ''){
            	$this->assign('source_no',$res['source_no']);
            }
        }

    	//最近获取奖励的50个会员
    	$reward_latest_url = '/member/recentreward';
    	if($this->curl->get_request($reward_latest_url,'php_api') == 200){
    		$reward_latest = $this->curl->getArrayData();
    		$this->assign('latest',$reward_latest);
    	}

        //红包结束
        if(empty($res)){
            //获取红包耗时
            if(!empty($reward_latest)){
                $source_no = isset(current($reward_latest)['source_no']) ? current($reward_latest)['source_no'] : '';
                if($source_no){
                    $used_time_url = "/member/awardcosttime/{$source_no}";
                    if($this->curl->get_request($used_time_url,'php_api') == 200){
                        $res = $this->curl->getJsonData();
                        $this->assign('time',$res);
                    }
                }
                $this->view->pick('reward/fulfill');
            }
        }

		$this->assign('member_id',$member_id);
		$this->pages->init('领红包');
    }

	public function is_getbagAction()
	{
		$member_id = $this->request->get('member_id');
        if(empty($member_id))
            $member_id = $this->request->get('memberid');
		$this->assign('member_id',$member_id);
		$this->pages->init('领红包');
    }

	public function expoAction()
	{
		$member_id = $this->request->get('member_id');
        if(empty($member_id))
            $member_id = $this->request->get('memberid');
		$this->assign('member_id',$member_id);
		$this->pages->init('领红包');
    }

}
