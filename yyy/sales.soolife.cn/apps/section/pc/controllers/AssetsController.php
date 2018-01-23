<?php
// +----------------------------------------------------------------------
// | 配置文件 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------
class AssetsController extends BaseController
{
	/**
	 * 头部脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function headerAction()
    {
		$nickname = $this->user->getNickname();
		$memberid = $this->user->getId();
		$coin = $this->user->getCoin();

		$this -> assign("m_nickname", $nickname);
		$this -> assign("m_id", $memberid);
		$this -> assign("m_coin", $coin);
		$this->page->page_url();
	}

	/**
	 * 底部脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function footerAction()
    {
    	$this->page->page_url();
	}

	/**
	 * 购物车脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function cartsAction()
    {
    	$this->page->page_url();
	}

	/**
	 * 右侧边栏的脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function sidebarAction()
    {
    	$nickname = $this->user->getNickname();
		$memberid = $this->user->getId();
		$coin = $this->user->getCoin();

		$this -> assign("m_nickname", $nickname);
		$this -> assign("m_id", $memberid);
		$this -> assign("m_coin", $coin);

    	$this->page->page_url();
	}

	/**
	 * 菜单内容
	 * @param $hide int 0 是否显示
	 */
	public function categoryAction($hide=0)
	{
		$cat = $this->redis->read_menus('pc');
		if ($hide>0) $hide = 'hide';
		else  $hide = '';
		$nav_photo = array(
			'a'=>'http://a.soolife.cn/uploadimg/20150715/55a62e43a34f7.png',
			'b'=>'http://a.soolife.cn/uploadimg/20150715/55a62d0e15ca0.png',
			'c'=>'http://a.soolife.cn/uploadimg/20150715/55a62ce2e6688.png',
			'd'=>'http://a.soolife.cn/uploadimg/20150715/55a62e84a16b0.png',
			'e'=>'http://a.soolife.cn/uploadimg/20150715/55a62e1eefce3.png',
			'f'=>'http://a.soolife.cn/uploadimg/20150715/55a62d3650238.png',
			'g'=>'http://a.soolife.cn/uploadimg/20150715/55a62dbf08123.png',
			'h'=>'http://a.soolife.cn/uploadimg/20150715/55a62d6f59fa8.png',
			'i'=>'http://a.soolife.cn/uploadimg/20150715/55a62ca5ca128.png',
			'j'=>'http://a.soolife.cn/uploadimg/20150715/55a62dea6b7d2.png',
			'k'=>'http://a.soolife.cn/uploadimg/20150715/55a62e5baf60e.png'
		);
		$this->assign('hide',$hide);
		$this->assign('cats',$cat);
		$this->assign('nav_photo',$nav_photo);
		// file_put_contents('./category.php',var_export($cat,true));
	}

	/**
	 * 流量统计脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function analyticsAction()
    {

	}

	/**
	 * 广告统计脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function adsAction()
    {

	}
	/**
	 * 分享统计脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function shareAction()
    {

	}

}