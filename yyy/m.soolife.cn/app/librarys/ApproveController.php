<?php
// +----------------------------------------------------------------------
// | 需要验证的基类(mobile)控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   ApproveController.php
// |
// | Author: Luo Qing 
// | Created:   2016-05-24
// +----------------------------------------------------------------------
// namespace Soolife\Member\Librarys;
// use Soolife\Member\Librarys\BaseController;
/**
 * 需要验证的基类控制器
 */
class ApproveController extends BaseController {
	var $curl = null;
	var $member = null;
	/**
	 * 初始化控制器,自动加载
	 * @access public
	 * @author Luo Qing 2016-05-24
	 * @return void
	 */
	public function initialize() {
		// 改从缓存判断是否在线
		$token = $this->cookies->get('m_token')->getValue();
		//var_dump($token);exit;
		$this->member = $this->redis->read_token($token);
		//var_dump($this -> member);exit;
		
		if (!isset($this->member))
		{
			// 取不到任何数据，将跳转地址
			return $this->no_auth_redirect();
		}
	}

	/**
	 * 未登录跳转到默认地址
	 * @author Luo Qing 2016-05-24
	 */
	public function no_auth_redirect() {
		//var_dump("11111");exit;
		$return_url = $this->request_get_value('$return_url','string','');
		$login = $this -> config -> application->default_m_login;
		if (empty($return_url))
		{
			$url = $this -> config -> application -> default_m_index;
			$return_url = Common::base64url_encode($url);
		}
		return $this -> redirect("{$login}?return_url=$return_url");
	}


	// /**
	//  * 在每一个找到的动作前执行
	//  * @author Luo Qing
	//  */
	// public function beforeExecuteRoute($dispatcher) {

	// }

	/**
	 * 在每一个找到的动作后执行
	 * @author Luo Qing
	 */
	public function afterExecuteRoute($dispatcher) {
	}

}
