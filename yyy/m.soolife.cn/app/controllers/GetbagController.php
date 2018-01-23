<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:  liucunyang  Controller.php
// |
// | Author: 
// | Created:   2016-07-19
// +----------------------------------------------------------------------
class GetbagController extends BaseController
{
	public function getbagAction()
    	{	
    		$member_id = $this->request->get('member_id');
            if(empty($member_id))
                $member_id = $this->request->get('memberid');
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
