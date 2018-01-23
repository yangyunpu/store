<?php
// +----------------------------------------------------------------------
// | 资源 控制器 静态资产文件加载
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   IndexController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2016-04-21
// +----------------------------------------------------------------------

/**
 * 资源 控制器
 */
class AssetsController extends BaseController
{
	private function getUsers(){
		$nickname = $this->user->getNickname();
		$memberid = $this->user->getId();
		$token = $this->user->getToken();
		$service = new MemberService();
		$asset = $service->Asset($token);
		$this -> assign("url_member", $this->config->url->url_member);
		$this -> assign("m_nickname", $nickname);
		$this -> assign("m_id", $memberid);
		$this -> assign("asset", $asset);
	}
	/**
	 * 头部脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function headerAction()
    {
    	$this->getUsers();
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
	 * 右侧边栏的脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function sidebarAction()
    {
    	$service = new MemberService();
    	$history_id = $this -> cookies -> get('history_id');
    	$sessionId = md5($history_id);
    	$token = $this->user->getToken();
    	$cartnum = $service -> GetCartNum($token,$sessionId);
    	$this->assign('cartnum',$cartnum);
    	$this->getUsers();
    	$this-> page->page_url();
	}

	/**
	 * 菜单内容
	 * @param $hide int 0 是否显示
	 */
	public function categoryAction()
	{
		$hide = $this->request->get('hide','int',0);
		$nav = $this->request->get('nav','string','home');
		$c_service = new CategoryService();
		$category = $c_service->Website();

		$a_service = new AdvertService();
		$ads = $a_service->Lively('pc.catgoods');

		$this -> assign("nav",$nav);
		$this -> assign('ads',$ads);
		$this -> assign("hide",$hide);
		$this -> assign("category",$category);
		$this-> page->page_url();
	}

	/**
	 * 标签
	 * @author tony wang 2016-09-14
	 * @return js
	 * @link /assets/tags.js?size=10
	 */
	public function tagsAction()
    {
    	$size = $this->request->get('size');
		$size = intval($size);
		if ($size<=0 || $size>=200) $size = 20;
		$tags = array();
		$service = new WebsiteService();
		$result = $service->Tags();
		foreach ($result as $k => $v) {
			$tags[] = array("name"=>$v['name'],"keywords"=>$this->utility->base64url_encode($v['name']));
		}
		$this->assign('tags',$tags);
    	$this->page->page_url();
	}

	/**
	 * 猜你喜欢
	 */
	public function hotAction($size)
    {
		$size = intval($size);
		if ($size<=0 || $size>=200) $size = 5;
    	$g_service = new GoodsService();

		$args['index'] = 0;
		$args['size'] = $size;
		$token = $this->user->getToken();
		$history_id = $this -> cookies -> get('history_id');
		$args['session_id'] = md5($history_id);
		$hot = $g_service->Hot($args,$token);
		$this -> assign("hot",$hot);
		$this->page->page_url();
	}

	/**
	 * 星币活动商品
	 */
	public function coinAction($size)
	{
		$size = intval($size);
		if ($size<=0 || $size>=200) $size = 20;
		$g_service = new GoodsService();
		$skus = $g_service->Coin($size);
		$this -> assign("skus",$skus);
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
	 * 流量统计脚本
	 * @author Tony Wang
	 * @return view
	 */
	public function analyticsAction(){
	}

	/**
	* Mobile analytics
	* @author Jinlong_Xie <soosim@qq.com>
	*/
	public function m_analyticsAction(){
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