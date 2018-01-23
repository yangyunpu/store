<?php
// +----------------------------------------------------------------------
// | 用户类
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Users.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
use Phalcon\Mvc\User\Component;
	
class Profile  extends Component {
	public $token;			// 当前会员登录令牌
    public $id;				// 当前会员编号
    public $name;      		// 当前会员登录名称
    public $nickname;  		// 当前会员姓名昵称
    public $coin;   		// 当前星币数
    public $type;   		// 会员类型
    public $shopid; 		// 如果是供应商，将会有店铺编号
    
    public $referer;    	// 推荐人
    public $from;          // 来源
    private $m_identifier = 'member_identifier';
    public function initialize() 
	{
		$member = $this->current();
		if (isset($member))
		{
			$this->token = $member['token'];
			$this->id = $member['id'];
			$this->name = $member['name'];
			$this->nickname = $member['nickname'];
			$this->coin = $member['coin'];
			$this->type = $member['type'];
			$this->shopid = $member['shopid'];
		}
	}	
	
	/**
	 * 读取当前的Token
	 */
	public function getCurrentToken()
	{
		//$this-> cookies->set($this->m_identifier, $data, $expire,"/",FALSE,$domain);
	}
	
	
	/**
	 * 获取当前会员信息
	 * @author tony wang  
	 * @return $data array 会员详细信息
	 */
	public function current()
	{
		
	}
}